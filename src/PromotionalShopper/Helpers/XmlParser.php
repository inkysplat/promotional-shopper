<?php

namespace src\PromotionalShopper\Helpers;

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
            //HACK... sue me.
            $data =  json_decode(json_encode($xml), $toArray);
            if(!$data){
                throw new \Exception("Cannot Parse XML File.");
            }
            return $data;
        }

        return false;
    }

    /**
     * Will turn an array into an XML document and save it to the file system.
     *
     * @static
     * @param array $document
     * @param $filename
     */
    public static function save(Array $document, $filename)
    {
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><order></order>");
        self::array_to_xml($document,$xml);

        FileHelper::removeIfExists($filename);
        $xml->asXML($filename);
    }

    /**
     * Stolen from StackOverflow... #guilty.
     *
     * @see http://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
     * @param Array $document
     * @param SimpleXMLElement $xml
     */
    public static function array_to_xml($document, &$xml) {
        foreach($document as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml->addChild("$key");
                    self::array_to_xml($value, $subnode);
                }
                else{
                    $subnode = $xml->addChild("item$key");
                    self::array_to_xml($value, $subnode);
                }
            }
            else {
                $xml->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}