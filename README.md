# Bitbucket - Webhook
The library makes it easy to handle bitbucket webhooks.

## Example
```php
use Dbogdanoff\Bitbucket;

// Pull request
$bitbucket = new Bitbucket\PullRequest();
$pullRequest = $bitbucket->getPullRequest();
$link = $bitbucket->getLink();

// Push/merge/commit
$bitbucket = new Bitbucket\Push();
$changes = $bitbucket->getChanges();
$branch = $bitbucket->getBranch();

// All objects extended from Bitbucket\Base()
$actor = $bitbucket->getActor();
$nickname = $bitbucket->getNickName();
$repository = $bitbucket->getRepository();
$projectName = $bitbucket->getProjectName();
```

### Exceptions
```php
// Bitbucket\PullRequest()
if ($_SERVER['HTTP_X_EVENT_KEY'] !== 'pullrequest:created') {
    throw new Exception('Invalid request type');
}

// Bitbucket\Push()
if ($_SERVER['HTTP_X_EVENT_KEY'] !== 'repo:push') {
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

