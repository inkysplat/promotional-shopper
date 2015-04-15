<?php

namespace src\PromotionalShopper\Services;

/**
 * Class XmlParser
 * @package src\PromotionalShopper\Services
 */
class XmlParser
{
    /**
     * Will parse a XML String and turn it into a stdClass or Array
     *
     * @static
     * @param $document
     * @param bool $toArray
     * @return bool|mixed
     */
    public static function parse($document, $toArray = false)
    {
        if($xml = simplexml_load_string($document)){
            //HACK...
            $json = json_encode($xml);
            return json_decode($json, $toArray);
        }

        return false;
    }
}