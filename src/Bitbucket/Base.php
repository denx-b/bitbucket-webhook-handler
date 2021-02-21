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
        $rawData = json_decode(file_get_contents('php://input'), true);

        if (is_array($rawData)) {
            $this->rawData = $rawData;

            if (array_key_exists('actor', $this->rawData)) {
                $this->actor = $this->rawData['actor'];
            }

            if (array_key_exists('repository', $this->rawData)) {
                $this->repository = $this->rawData['repository'];
            }
        } else {
            throw new Exception('Incorrect webhook response');
        }
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
}
