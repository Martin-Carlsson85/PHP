<?php

namespace controller;

class FileController
{
    const URL_DOWNLOAD = "download";
    const WARNING_FILE_NO_EXIST = "FILEN FINNS INTE!... typ";
    const DOWNLOAD_LOCATION = "./Data/files/";

    function __construct()
    {
    }

    function hasURL()
    {
        return isset($_GET[self::URL_DOWNLOAD]);
    }

    function wantsToDownload()
    {
        return isset($_POST[self::URL_DOWNLOAD]);
    }

    private function getDownloadLink()
    {
        return $this->hasURL() ? $_GET[self::URL_DOWNLOAD] : "";
    }

    function renderDownloadPage()
    {
        $filesDAL = \model\FilesDAL::getInstance();
        $file = $filesDAL->getFile($this->getDownloadLink());

        if ($file) {
            if ($this->wantsToDownload()) {
                header('Content-Disposition: attachment; filename="' . $file->getFileName() . '"');
                readfile(self::DOWNLOAD_LOCATION . $file->getDataLocation());
            } else {
                echo "<form method='post'>
                        <p>" . $file->getFileName() . " uploaded by " . $file->getOwner() . "</p>
                        <input type='submit' value='Download' />
                        <input type='hidden' name='" . self::URL_DOWNLOAD . "' value='" . $this->getDownloadLink() . "' />
                      </form>";
            }
        } else {
            echo self::WARNING_FILE_NO_EXIST;
        }
    }
}