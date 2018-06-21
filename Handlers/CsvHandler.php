<?php

namespace Converter\Handlers;

class CsvHandler implements HandlerInterface
{

    public function encodeData($data, $filename)
    {
        $rawData = $this->array2csv($data);
        file_put_contents($filename, $rawData);
        return true;
    }

    public function decodeData($data)
    {
        $lines = explode("\n", $data);
        $head = str_getcsv(array_shift($lines));
        $rawData = array();
        foreach ($lines as $line) {
            $rawData[] = array_combine($head, str_getcsv($line));
        }

        if ($rawData) {
            return $rawData;
        }
    }

    private function array2csv($array)
    {
        $csv = array();

        foreach ($array as $item=>$val) {
            if (is_array($val)) {
                $csv[] = $this->array2csv($val);
                $csv[] = "\n";
            } else {
                $csv[] = $val;
            }
        }

        return implode(',', $csv);
    }
}