<?php

namespace Converter\Controllers;

class MainController
{
    /**
     * Main init method (we can use constructor here as well)
     *
     */
    public function init()
    {
        // get the cli arguments provided by user
        $cliArguments = (new CliController())->getArguments();

        $prevent = new PreventController($cliArguments);
        list($inputAction, $outputAction) = $prevent->checkActions($cliArguments);

        //get  raw array from import module
        $rawArray = $this->prepareRawArray($inputAction, $cliArguments);
        // send this array to export module
        $this->prepareToExport($outputAction, $cliArguments, $rawArray);
    }

    /**
     * @param $inputAction
     * @param $cliArguments
     * @return array
     */
    private function callImport($inputAction, $cliArguments)
    {
        // Call Export object to convert array to requested format by specific handler
        // Create Import object
        $import = new \Converter\Modules\Import();

        // check what will be converted to the general structure - associative array
        // then prepare proper handler
        if($inputAction == 'json') {
            $handler = new \Converter\Handlers\JsonHandler();
        } elseif ($inputAction == 'xml') {
            $handler = new \Converter\Handlers\XmlHandler();
        } elseif ($inputAction == 'csv') {
            $handler = new \Converter\Handlers\CsvHandler();
        }

        // return file back after conversion to associative array
        return $import->sendFile($handler, $cliArguments);
    }

    /**
     * @param $outputAction
     * @param $cliArguments
     * @param $rawArray
     * @return bool
     */
    private function callExport($outputAction, $cliArguments, $rawArray)
    {
        // create Export object
        $export = new \Converter\Modules\Export();

        // check what is the final format and prepare proper handler for that
        if($outputAction == 'json') {
            $handler = new \Converter\Handlers\JsonHandler();
        } elseif ($outputAction == 'xml') {
            $handler = new \Converter\Handlers\XmlHandler();
        } elseif ($outputAction == 'csv') {
            $handler = new \Converter\Handlers\CsvHandler();
        }

        // if everything is ok the 'true' value will be provided
        return $export->sendFile($handler, $cliArguments, $rawArray);
    }

    /**
     * @param $inputAction
     * @param $cliArguments
     * @return array
     */
    private function prepareRawArray($inputAction, $cliArguments)
    {
        //prepare associative array in Import object
        $rawArray = $this->callImport($inputAction, $cliArguments);
        return $rawArray;
    }

    /**
     * @param $outputAction
     * @param $cliArguments
     * @param $rawArray
     */
    private function prepareToExport($outputAction, $cliArguments, $rawArray): void
    {
        if ($this->callExport($outputAction, $cliArguments, $rawArray)) {
            // give some info for user is successfull
            echo("File: " . $cliArguments['input'] . " converted to: " . $cliArguments['output'] . " successfully! \n");
        } else {
            echo('Unexpected error! Please try again.');
        }
    }
}