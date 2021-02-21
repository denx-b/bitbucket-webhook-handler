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

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->rawData = json_decode(file_get_contents('php://input'), true);
        if (!is_array($this->rawData)) {
            throw new Exception('Incorrect webhook response');
        }

        if (array_key_exists('actor', $this->rawData)) {
            $this->actor = $this->rawData['actor'];
        }

        if (array_key_exists('repository', $this->rawData)) {
            $this->repository = $this->rawData['repository'];
        }
    }

    public function getRawData(): array
    {
        return (array)$this->rawData;
    }

    public function getActor(): array
    {
        return (array)$this->actor;
    }

    public function getNickName(): string
    {
        return (string)$this->actor['nickname'];
    }

    public function getRepository(): array
    {
        return (array)$this->repository;
    }

    public function getProjectName(): string
    {
        return (string)$this->repository['full_name'];
    }
}
