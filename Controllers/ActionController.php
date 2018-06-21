<?php

namespace Converter\Controllers;

class ActionController
{
    private $inputAction;
    private $outputAction;

    /**
     * @param $cliArg
     * @return string
     */
    private function checkAction($cliArg)
    {
        if(preg_match('/json/', $cliArg)) {
            return 'json';
        } elseif(preg_match('/xml/', $cliArg)) {
            return 'xml';
        } elseif(preg_match('/csv/', $cliArg)) {
            return 'csv';
        }
    }

    /**
     * @param $cliArgs
     * @return string
     */
    public function getInputAction($cliArgs)
    {
        $this->inputAction = $this->checkAction($cliArgs['input']);
        return $this->inputAction;
    }

    /**
     * @param $cliArgs
     * @return string
     */
    public function getOutputAction($cliArgs)
    {
        $this->outputAction = $this->checkAction($cliArgs['output']);
        return $this->outputAction;
    }
}