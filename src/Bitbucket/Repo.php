<?php

namespace Dbogdanoff\Bitbucket;

use Exception;

class Repo extends Base
{
    /** @var array */
    protected $push = [];

    /** @var array */
    protected $fork = [];

    /** @var array */
    protected $changes = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (strpos($_SERVER['HTTP_X_EVENT_KEY'], 'repo:') === false) {
            throw new Exception('Invalid request type');
        }

        parent::__construct();

        if (array_key_exists('push', $this->rawData)) {
            $this->push = $this->rawData['push'];
        }

        if (array_key_exists('fork', $this->rawData)) {
            $this->fork = $this->rawData['fork'];
        }
    }

    public function getPush(): array
    {
        return $this->push;
    }

    public function getFork(): array
    {
        return $this->fork;
    }

    public function getChanges(): array
    {
        if (array_key_exists('changes', $this->push)) {
            return $this->push['changes'][0]['new'] ?: $this->push['changes'][0]['old'];
        } else if (array_key_exists('changes', $this->rawData)) {
            return $this->rawData['changes'];
        }

        return $this->changes;
    }

    public function getCommits(): array
    {
        return $this->getPush()['changes'][0]['commits'];
    }

    public function getCommitComments(): array
    {
        $commits = [];
        foreach ($this->getCommits() as $commit) {
            $commits[$commit['hash']] = $commit['message'];
        }
        return $commits;
    }

    public function getBranch(): string
    {
        $changes = $this->getChanges();
        if (array_key_exists('name', $changes)) {
            return $changes['name'];
        }

        return '';
    }

    public function getAuthor(): array
    {
        return $this->getChanges()['target']['author'];
    }

    public function getAuthorNickName(): string
    {
        return $this->getAuthor()['user']['nickname'];
    }
}
