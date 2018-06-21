<?php

namespace Converter\Modules;

class Export extends BaseModule
{
    private $fileToSave;

    /**
     * Exporting file to the handler
     * @param $handler
     * @param $importedFile
     * @param $args
     * @return bool
     */
    public function sendFile($handler, $args, $importedFile)
    {
        $this->setFileName($args['output']);

        if($this->fileToSave = $handler->encodeData($importedFile, $this->getFileName())) {
            return true;
        }
    }
}