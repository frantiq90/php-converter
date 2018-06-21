<?php

namespace Converter\Handlers;

use SimpleXMLElement;

class XmlHandler implements HandlerInterface
{
    /**
     * Decode given XML data to multidimensional array
     * @param $data
     * @return mixed
     */
    public function decodeData($data)
    {
        if($rawData = simplexml_load_string($data)) {
            $array =  json_decode(json_encode((array)$rawData), TRUE);
            return $array;
        }
    }

    /**
     * Encode given data to XML file
     * @param $data
     * @param $filename
     * @return bool
     */
    public function encodeData($data, $filename)
    {
        $xml = new \SimpleXMLElement('<root/>');

        $this->array2xml($data, $xml);

        $xml->asXML($filename);

        return  true;
    }

    /**
     * @param $data
     * @param $xml
     * @return mixed
     */
    private function array2xml($data, $xml)
    {
        foreach ($data as $k => $v) {
            $k = (is_numeric($k)) ? 'item' : $k;

            is_array($v)
                ? $this->array2xml($v, $xml->addChild($k))
                : $xml->addChild($k, $v);
        }
        return $xml;
    }
}