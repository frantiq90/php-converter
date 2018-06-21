<?php

namespace Converter\Controllers;

class CliController
{
    private $orderedArguments = [];

    /**
     * CliController constructor.
     */
    public function __construct()
    {
        $this->orderedArguments['input'] = $_SERVER['argv'][2];
        $this->orderedArguments['output'] = $_SERVER['argv'][4];
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->orderedArguments;

    }
}