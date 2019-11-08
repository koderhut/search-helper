<?php declare(strict_types=1);

namespace App\Domain\Search\Processor\Worker;

use App\Domain\Search\Collection\Terms as TermsCollection;
use App\Domain\Search\Model\SearchQuery;
use App\Domain\Search\Exceptions\InvalidTermsStringException;
use App\Domain\Search\Model\NullTerm;
use App\Domain\Search\Model\Term;
use App\Domain\Search\Model\TermInterface;

/**
 * @author Denis-Florin Rendler <connect@rendler.me>
 */
class Terms implements WorkerInterface
{
    private const TERMS_REGEX = '/(?!.*:)(?>"|\')(?P<mterm>.*?)(?>"|\')|(?!.*:)(?P<sterm>\w+)(?=\s)?/';

    public function handle(SearchQuery $query)
    {
        $found = [];
        $terms = new TermsCollection();

        if (!preg_match_all(self::TERMS_REGEX, $query->toString(), $found, PREG_SET_ORDER | PREG_UNMATCHED_AS_NULL, 0) || empty($found)) {
            throw new InvalidTermsStringException($query->toString());
        }

        foreach ($found as $itemFound) {
            $terms->add($this->retrieveTerm($itemFound, 'sterm'));
            $terms->add($this->retrieveTerm($itemFound, 'mterm'));
        }

        $query->setTerms($terms);
    }

    public function supports(SearchQuery $searchQuery)
    {
        return (bool) method_exists($searchQuery, 'setTerms');
    }

    public function name(): string
    {
        return 'terms';
    }

    private function retrieveTerm(array $itemFound, string $type): TermInterface
    {
        if (isset($itemFound[$type]) && !empty($itemFound[$type])) {
            return new Term((string)$itemFound[$type]);
        }

        return new NullTerm();
    }
}
