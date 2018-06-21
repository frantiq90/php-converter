<?php

namespace Converter\Controllers;

class PreventController
{
    /**
     * PreventController constructor.
     * @param $cliArguments
     */
    public function __construct($cliArguments)
    {
        $this->checkFile($cliArguments);
        list($inputAction, $outputAction) = $this->checkActions($cliArguments);
        $this->preventConversion($inputAction, $outputAction);
    }

    /**
     * @param $cliArguments
     */
    private function checkFile($cliArguments)
    {
        if (!file_exists($cliArguments['input'])) {
            die("File: " . $cliArguments['input'] . " does not exist! \n");
        }
    }

    /**
     * @param $cliArguments
     * @return array
     */
    public function checkActions($cliArguments)
    {
        $actionController = new ActionController();
        $inputAction = $actionController->getInputAction($cliArguments);
        $outputAction = $actionController->getOutputAction($cliArguments);

        return array($inputAction, $outputAction);
    }

    /**
     * @param $inputAction
     * @param $outputAction
     */
    private function preventConversion($inputAction, $outputAction)
    {
        if ($inputAction == $outputAction) {
            exit("Are you trying to convert " . $inputAction . " to " . $outputAction . " ? \n");
        }
    }
}