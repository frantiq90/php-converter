<?php

namespace Converter\Modules;

class Import extends BaseModule
{
    public $fileRawData;
    public $fileArray = [];

    /**
     * @param $handler
     * @param $args
     * @return array
     */
    public function sendFile($handler, $args)
    {
        $this->setFileName($args['input']);

        $this->fileRawData = file_get_contents($this->getFileName());
        $this->fileArray = $handler->decodeData($this->fileRawData);
        return $this->fileArray;
    }
}