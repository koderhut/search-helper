<?php

/*
 * This file is part of the KoderHut/SearchModel package.
 *
 *  (c)Denis-Florin Rendler (connect@rendler.me)
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace KoderHut\SearchHelper\Processor\Worker;

use KoderHut\SearchHelper\Model\Collection\Terms as TermsCollection;
use KoderHut\SearchHelper\Exceptions\InvalidTermsStringException;
use KoderHut\SearchHelper\Model\NullTerm;
use KoderHut\SearchHelper\Model\SearchQuery;
use KoderHut\SearchHelper\Model\Term;
use KoderHut\SearchHelper\Model\TermInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Terms implements WorkerInterface
{
    private const TERMS_REGEX        = '/(?!.*:)(?>"|\')(?P<mterm>[\w\d\s]+)(?>"|\')|(?!.*:)(?P<sterm>\w+)(?=\s)?|(?!.*:)(?P<allterm>\%{1}$)(?=\s)?/';
    private const TERM_ALL           = 'allterm';
    private const TERM_SINGLE_WORD   = 'sterm';
    private const TERM_MULTIPLE_WORD = 'mterm';

    public function handle(SearchQuery $items): void
    {
        $found = [];
        $terms = new TermsCollection();

        if (!preg_match_all(self::TERMS_REGEX, $items->toString(), $found, PREG_SET_ORDER | PREG_UNMATCHED_AS_NULL) || empty($found)) {
            throw new InvalidTermsStringException($items->toString());
        }

        if (!($allTerm = $this->retrieveTerm(current($found), self::TERM_ALL)) instanceof NullTerm) {
            $terms->add($allTerm);
            $items->setTerms($terms);

            return;
        }

        foreach ($found as $itemFound) {
            $terms->add($this->retrieveTerm($itemFound, self::TERM_SINGLE_WORD));
            $terms->add($this->retrieveTerm($itemFound, self::TERM_MULTIPLE_WORD));
        }

        $items->setTerms($terms);
    }

    private function retrieveTerm(array $itemFound, string $type): TermInterface
    {
        if (isset($itemFound[$type]) && !empty($itemFound[$type])) {
            return new Term((string)$itemFound[$type]);
        }

        return new NullTerm();
    }

    public function supports(SearchQuery $searchQuery): bool
    {
        return (bool)method_exists($searchQuery, 'setTerms') && !empty($searchQuery->toString());
    }

    public function name(): string
    {
        return 'terms';
    }
}
