<?php

namespace controller;

class FileController implements ControllerInterface
{
    function __construct()
    {
        $filesDAL = \model\FilesDAL::getInstance();
        $this->fileView = new \view\FileView($filesDAL);
    }

    /**
     * Is the user looking at a file to download or trying to download a file, then return true.
     * @return bool
     */
    function shouldRender()
    {
        return $this->fileView->hasURL() || $this->fileView->wantsToDownload();
    }


    /**
     * Runs the FileController, returns fileView to render
     * @return \view\FileView
     */
    function run()
    {
        return $this->fileView;
    }
}