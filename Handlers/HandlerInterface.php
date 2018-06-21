<?php

namespace Converter\Handlers;

interface HandlerInterface
{
    /**
     * @param $data
     * @param $filename
     * @return mixed
     */
    public function encodeData($data, $filename);

    /**
     * @param $data
     * @return mixed
     */
    public function decodeData($data);
}