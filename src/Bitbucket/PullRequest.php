<?php

namespace Dbogdanoff\Bitbucket;

use Exception;

class PullRequest extends Base
{
    /** @var array */
    protected $pullRequest = [];

    /** @var array */
    protected $comment = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (strpos($_SERVER['HTTP_X_EVENT_KEY'], 'pullrequest:') === false) {
            throw new Exception('Invalid request type');
        }

        parent::__construct();

        if (array_key_exists('pullrequest', $this->rawData)) {
            $this->pullRequest = $this->rawData['pullrequest'];
        }

        if (array_key_exists('comment', $this->rawData)) {
            $this->comment = $this->rawData['comment'];
        }
    }

    public function getPullRequest(): array
    {
        return $this->pullRequest;
    }

    public function getLinks(): array
    {
        return $this->pullRequest['links'];
    }

    public function getLink(): string
    {
        return $this->pullRequest['links']['html']['href'];
    }

    public function getTitle(): string
    {
        return $this->pullRequest['title'] ?: '';
    }

    public function getAuthor(): array
    {
        return $this->getPullRequest()['author'];
    }

    public function getAuthorNickName(): string
    {
        return $this->getAuthor()['nickname'];
    }

    public function getCommentText(): string
    {
        return $this->comment['content']['raw'];
    }

    public function getCommentInlinePath(): string
    {
        return $this->comment['inline']['path'];
    }

    public function getCommentInlineNumber(): string
    {
        return $this->comment['inline']['from'] ?: $this->comment['inline']['to'];
    }
}
