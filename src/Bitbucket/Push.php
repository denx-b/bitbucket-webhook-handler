<?php

namespace Dbogdanoff\Bitbucket;

use Exception;

class Push extends Base
{
    /** @var array */
    protected $push = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if ($_SERVER['HTTP_X_EVENT_KEY'] !== 'repo:push') {
            throw new Exception('Invalid request type');
        }

        parent::__construct();

        if (array_key_exists('push', $this->rawData)) {
            $this->push = $this->rawData['push'];
        }
    }

    public function getPush(): array
    {
        return $this->push;
    }

    public function getChanges(): array
    {
        return $this->push['changes'][0]['old'] ?: $this->push['changes'][0]['new'];
    }

    public function getBranch(): string
    {
        return $this->getChanges()['name'];
    }
}
