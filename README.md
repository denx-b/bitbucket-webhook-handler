# Bitbucket - Webhook
The library makes it easy to handle [bitbucket webhooks](https://support.atlassian.com/bitbucket-cloud/docs/manage-webhooks/#Trigger-webhooks).

## Example
```php
use Dbogdanoff\Bitbucket;

// Repository events (Push, Fork, Updated, Commit, ...) 
$repo = new Bitbucket\Repo();
$push = $repo->getPush(); // array
$fork = $repo->getFork(); // array
$branch = $repo->getBranch(); // string
$changes = $repo->getChanges(); // array — 'changes' from root or 'changes' key from 'push'
$authorNickName = $repo->getAuthorNickName(); // string

// Issue events (Created, Updated, Comment created)
$issue = new Bitbucket\Issue();
$issue = $issue->getIssue(); // array

// Pull request events (Created, Updated, Change, ...)
$pullRequest = new Bitbucket\PullRequest();
$title = $pullRequest->getTitle(); // string
$link = $pullRequest->getLink(); // string
$data = $pullRequest->getPullRequest(); // array
$author = $pullRequest->getAuthor(); // array
$authorNickName = $pullRequest->getAuthorNickName(); // string
$commentText = $pullRequest->getCommentText(); // string
$commentInlinePath = $pullRequest->getCommentInlinePath(); // string
$commentInlineNumber = $pullRequest->getCommentInlineNumber(); // string

// All objects extended from Bitbucket\Base()
$actor = $repo->getActor(); // array
$nickname = $repo->getNickName(); // string
$repository = $repo->getRepository(); // array
$projectName = $repo->getProjectName(); // string
$eventType = $repo->getEventKey(); // string — repo:push, repo:updated, pullrequest:created, ...
$rawData = $repo->getRawData(); // array — full data
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
