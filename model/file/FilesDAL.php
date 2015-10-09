<?php

namespace model;

class FilesDAL
{
    const SAVE_FILE_LOCATION = "./Data/files.data";

    private static $instance = null;

    private $files = array();

    /**
     * Do not call this method! Use getInstance() instead!
     */
    protected function __construct()
    {
        if (file_exists(self::SAVE_FILE_LOCATION) && is_file(self::SAVE_FILE_LOCATION))
            $this->readFile(self::SAVE_FILE_LOCATION);
    }

    /**
     * Reads files from a file
     * @param $fileName
     */
    private function readFile($fileName)
    {
        $file = fopen($fileName, "r");
        while (($line = fgets($file)) !== false) {
            $explodedLine = explode(';', trim($line));
            $this->files[$explodedLine[1]] = new File($explodedLine[0], $explodedLine[1], $explodedLine[2]);
        }
    }

    /**
     * Private clone method to prevent cloning of the instance to the singleton instance
     */
    private function __clone()
    {
    }

    /**
     *  Private unserialize method to prevent unserializing of the singleton instance
     */
    private function __wakeup()
    {
    }

    /**
     * This is to make FilesDAL singleton, if there is no instance of FilesDAL, make one,
     * else return the instance
     * @return FilesDAL
     */
    public static function getInstance()
    {
        if (static::$instance === null)
            static::$instance = new static();

        return static::$instance;
    }

    /**
     * Returns the array containing the files from the file
     * @return array
     */
    private function getFiles()
    {
        return $this->files;
    }

    /**
     * Saves a file to the file
     * @param RegistrationCredentials $fileToSave
     */
    /*function saveFile(RegistrationCredentials $fileToSave)
    {
        $this->files[] = new file($fileToSave->getfilename(), $fileToSave->getPassword());
        $this->writeFile($this->files);
    }*/

    /**
     * Writes all files to file
     * @param $files
     */
    private function writeFile($files)
    {
        $stringToWrite = "";
        foreach ($files as $files) {
            $stringToWrite .= $files . "\n";
        }

        file_put_contents(self::SAVE_FILE_LOCATION, $stringToWrite);
    }

    /**
     * Returns the file data, if file does not exist in list, return false
     * @param $fileName file to search for
     * @return bool|File Found file or false
     */
    function getFile($fileDataLocation)
    {
        if(array_key_exists($fileDataLocation, $this->files))
            return $this->files[$fileDataLocation];
        return false;
    }
}