<?php

namespace model;

class File
{
    private $fileName, $dataLocation, $owner, $contentType, $description;

    /**
     * Creates a file
     * @param $fileName
     * @param $dataLocation
     * @param $owner
     * @param $contentType
     * @param $description
     */
    function __construct($fileName, $dataLocation, $owner, $contentType, $description)
    {
        $this->fileName = $fileName;
        $this->dataLocation = $dataLocation;
        $this->owner = $owner;
        $this->contentType = $contentType;
        $this->description = $description;
    }

    /**
     * Gets the file description
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the file description
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Gets the file name
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Gets the data location (UID as filename in download location)
     * @return mixed
     */
    public function getDataLocation()
    {
        return $this->dataLocation;
    }

    /**
     * Gets the file owner
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Creates a string for easier use when saving the file to file list
     * @return string
     */
    public function __toString()
    {
        return $this->fileName . ";" . $this->dataLocation . ";" .
        $this->owner . ";" . $this->contentType . ";" . $this->description;
    }

    /**
     * Gets the content type of the file
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }
}