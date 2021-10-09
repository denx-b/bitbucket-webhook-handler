<?php

namespace Dbogdanoff\Bitbucket;

use Exception;

class Base
{
    /** @var array */
    protected $rawData = [];

    /** @var array */
    protected $repository = [];

    /** @var array user who triggered the event */
    protected $actor = [];

    /** @var string webhook type */
    protected $eventKey = '';

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->rawData = json_decode(file_get_contents('php://input'), true);
        if (!is_array($this->rawData)) {
            throw new Exception('Incorrect webhook response');
        }

        if (array_key_exists('actor', $this->rawData) && is_array($this->rawData['actor'])) {
            $this->actor = $this->rawData['actor'];
        }

        if (array_key_exists('repository', $this->rawData) && is_array($this->rawData['repository'])) {
            $this->repository = $this->rawData['repository'];
        }

        $this->eventKey = $_SERVER['HTTP_X_EVENT_KEY'];
    }

    public function getRawData(): array
    {
        return $this->rawData;
    }

    public function getActor(): array
    {
        return $this->actor;
    }

    public function getNickName(): string
    {
        return $this->actor['nickname'];
    }

    public function getRepository(): array
    {
        return $this->repository;
    }

    public function getProjectName(): string
    {
        return $this->repository['full_name'];
    }

    public function getEventKey(): string
    {
        return $this->eventKey;
    }

    public function getAuthor(): array
    {
        return [];
    }

    public function getAuthorNickName(): string
    {
        return '';
    }
}
