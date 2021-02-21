# Bitbucket - Webhook
The library makes it easy to handle [bitbucket webhooks](https://support.atlassian.com/bitbucket-cloud/docs/manage-webhooks/#Trigger-webhooks).

## Example
```php
use Dbogdanoff\Bitbucket;

// Repository events (Push, Fork, Updated, Commit, ...) 
$bitbucket = new Bitbucket\Repo();
$push = $bitbucket->getPush(); // array
$fork = $bitbucket->getFork(); // array
$branch = $bitbucket->getBranch(); // string
$changes = $bitbucket->getChanges(); // array — 'changes' from root or 'changes' key from 'push'

// Issue events (Created, Updated, Comment created)
$bitbucket = new Bitbucket\Issue();
$issue = $bitbucket->getIssue(); // array

// Pull request events (Created, Updated, Change, ...)
$bitbucket = new Bitbucket\PullRequest();
$pullRequest = $bitbucket->getPullRequest(); // array
$link = $bitbucket->getLink(); // string — pull request link

// All objects extended from Bitbucket\Base()
$actor = $bitbucket->getActor(); // array
$nickname = $bitbucket->getNickName(); // string
$repository = $bitbucket->getRepository(); // array
$projectName = $bitbucket->getProjectName(); // string
$rawData = $bitbucket->getRawData(); // array — full data
```

### Exceptions
```php
// Bitbucket\Repo::__construct()
if (strpos($_SERVER['HTTP_X_EVENT_KEY'], 'repo:') === false) {
    throw new Exception('Invalid request type');
}

// Bitbucket\Issue::__construct()
if (strpos($_SERVER['HTTP_X_EVENT_KEY'], 'issue:') === false) {
    throw new Exception('Invalid request type');
}

// Bitbucket\PullRequest::__construct()
if (strpos($_SERVER['HTTP_X_EVENT_KEY'], 'pullrequest:') === false) {
    throw new Exception('Invalid request type');
}
```

## Requirements

Bitbucket - Webhook requires the following:

- PHP 7.0.0+

## Installation

Bitbucket - Webhook is installed via [Composer](https://getcomposer.org/).
To [add a dependency](https://getcomposer.org/doc/04-schema.md#package-links>) to bitbucket-webhook in your project, either

Run the following to use the latest stable version
```sh
    composer require denx-b/bitbucket-webhook
```
or if you want the latest master version
```sh
    composer require denx-b/bitbucket-webhook:dev-master
```

You can of course also manually edit your composer.json file
```json
{
    "require": {
       "denx-b/bitbucket-webhook": "0.*"
    }
}
```

# Documentation

## Manage webhooks

https://support.atlassian.com/bitbucket-cloud/docs/manage-webhooks/

## Events

https://support.atlassian.com/bitbucket-cloud/docs/event-payloads/

