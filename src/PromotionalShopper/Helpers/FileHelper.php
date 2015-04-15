<?php

namespace src\PromotionalShopper\Helpers;

/**
 * Class FileHelper
 * @package src\PromotionalShopper\Helpers
 */
class FileHelper
{
    /**
     * Gets a File from the Filesystem.
     * @static
     * @param string $file
     * @return string
     * @throws Exception
     */
    public static function getFile($file)
    {
        $file = ROOT_PATH . $file;
        if (!file_exists($file)) {
            throw new \Exception("Cannot Find File.");
        }

        $file = file_get_contents($file);

        if (empty($file)) {
            throw new \Exception("Empty File Found.");
        }

        return $file;
    }

    /**
     * Removes a file if it exists on the Filesystem.
     * @param $file
     */
    public static function removeIfExists($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}