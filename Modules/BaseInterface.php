<?php

namespace Converter\Modules;

interface BaseInterface
{
    /**
     * @param $handler
     * @param $args
     * @param null $importedFile
     * @return mixed
     */
    public function sendFile($handler, $args, $importedFile = NULL)
}