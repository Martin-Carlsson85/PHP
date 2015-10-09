<?php

namespace controller;

class FileController
{
    const URL_DOWNLOAD = "download";

    function __construct(){
        $filesDAL = \model\FilesDAL::getInstance();
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
        if ($this->wantsToDownload()) {
            header('Content-Disposition: attachment; filename="pizza4.jpg"');
            readfile("./Data/files/af3mpg4f");
        } else {
            echo "<form method='post'>
                    <input type='submit' value='Download' />
                    <input type='hidden' name='" . self::URL_DOWNLOAD . "' value='" . $this->getDownloadLink() . "' />
                  </form>";
        }
    }
}