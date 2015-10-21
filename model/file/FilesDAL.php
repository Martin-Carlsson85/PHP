<?php

namespace model;

use RuntimeException;

class FilesDAL
{
    const SAVE_FILE_LOCATION = "./Data/files.data";
    const DOWNLOAD_LOCATION = "./Data/files/";

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
            $this->files[$explodedLine[1]] = new File(
                $explodedLine[0],
                $explodedLine[1],
                $explodedLine[2],
                $explodedLine[3],
                $explodedLine[4]);
        }
    }

    /**
     * Reads a file and returns it's content
     * @param $file
     * @return string
     */
    public function readFileContent($file)
    {
        return file_get_contents(self::DOWNLOAD_LOCATION . $file->getDataLocation());
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
     * Removes the file from download location and removes it from the list
     * @param $fileToRemove String filename
     */
    public function removeFile($fileToRemove)
    {
        if (file_exists(self::DOWNLOAD_LOCATION . $fileToRemove) && is_file(self::DOWNLOAD_LOCATION . $fileToRemove))
            unlink(self::DOWNLOAD_LOCATION . $fileToRemove);
        unset($this->files[$fileToRemove]);
        $this->writeFileList($this->files);
    }

    /**
     * Saves a file to the database
     * @param $fileToSave
     * @param $description
     * @param User $user
     */
    function saveFile($fileToSave, $description, User $user)
    {
        $uid = uniqid();
        echo "<br>";

        if (!file_exists(self::DOWNLOAD_LOCATION)) {
            mkdir(self::DOWNLOAD_LOCATION);
        }
        if (!move_uploaded_file($fileToSave['tmp_name'], self::DOWNLOAD_LOCATION . $uid)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
        $file = new File($fileToSave["name"], $uid, $user->userName, $fileToSave["type"], $description);
        $this->files[] = $file;
        $this->writeFileList($this->files);
    }

    /**
     * Updates a file in the list with the new information. Data location needs to be the same as the old!
     * @param File $fileToUpdate
     */
    function updateFile(File $fileToUpdate)
    {
        //Check if file is in the array
        if ($this->getFile($fileToUpdate->getDataLocation())) {
            $this->files[$fileToUpdate->getDataLocation()] = $fileToUpdate;
        }
        $this->writeFileList($this->files);
    }

    /**
     * Writes all files to file list file
     * @param $files
     */
    private function writeFileList($files)
    {
        $stringToWrite = "";
        foreach ($files as $file) {
            $stringToWrite .= $file . "\n";
        }

        file_put_contents(self::SAVE_FILE_LOCATION, $stringToWrite);
    }

    /**
     * Returns the file data, if file does not exist in list, return false
     * @param $fileDataLocation
     * @return bool|File Found file or false
     */
    function getFile($fileDataLocation)
    {
        if (array_key_exists($fileDataLocation, $this->files))
            return $this->files[$fileDataLocation];
        return false;
    }

    /**
     * Gets an array containing all files the user owns
     * @param $user
     * @return array
     */
    function getFilesForUser($user)
    {
        $filesToReturn = array();
        foreach ($this->files as $file) {
            if ($file->getOwner() == $user)
                $filesToReturn[] = $file;
        }
        return $filesToReturn;
    }
}