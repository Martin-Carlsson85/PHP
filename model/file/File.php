<?php

namespace model;

class File
{
    private $fileName, $dataLocation, $owner;

    function __construct($fileName, $dataLocation, $owner)
    {
        $this->fileName = $fileName;
        $this->dataLocation = $dataLocation;
        $this->owner = $owner;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getDataLocation()
    {
        return $this->dataLocation;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function __toString()
    {
        return $this->fileName . ";" . $this->dataLocation . ";" . $this->owner;
    }
}