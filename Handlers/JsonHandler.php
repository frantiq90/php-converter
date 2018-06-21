<?php

namespace Converter\Handlers;

class JsonHandler implements HandlerInterface
{
    /**
     * Decode given JSON to array
     * @param $data
     * @return mixed
     */
    public function decodeData($data)
    {
        $data = json_decode($data, true);
        return $data;
    }

    /**
     * Encode given array to JSON
     * @param $data
     * @param $filename
     * @return bool
     */
    public function encodeData($data, $filename)
    {
        if (file_put_contents($filename, json_encode($data))) {
            return true;
        }

    }
}