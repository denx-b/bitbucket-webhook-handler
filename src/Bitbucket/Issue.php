<?php

namespace Dbogdanoff\Bitbucket;

use Exception;

class Issue extends Base
{
    /** @var array */
    protected $issue = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (strpos($this->eventKey, 'issue:') === false) {
            throw new Exception('Invalid request type');
        }

        parent::__construct();

        if (array_key_exists('issue', $this->rawData)) {
            $this->issue = $this->rawData['issue'];
        }
    }

    public function getIssue(): array
    {
        return $this->issue;
    }
}
