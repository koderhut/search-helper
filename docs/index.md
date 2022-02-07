##Installation

```bash
composer require koderhut/search-helper
```

##Usage

The most common usage is to pass the query string from the request directly into a ```SearchQuery()``` object and pass 
that through the processor and data-store adapter to fetch the data.

```php
$query = new SearchQuery('users:%');
$context = new ContextBag([
    DataStoreAdapter::FIRST_RESULT  => $request->get('first'),
    DataStoreAdapter::LIMIT_RESULTS => $request->get('limit'),
]);

$allUsers = $this->search->search($query, $context);
```
