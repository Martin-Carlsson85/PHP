<?php

namespace view;


class FileView implements ViewInterface
{
    const URL_DOWNLOAD = "download";
    const WARNING_FILE_NO_EXIST = "The file you are looking for does not exist!";

    function __construct(\model\FilesDAL $filesDAL)
    {
        $this->filesDAL = $filesDAL;
        $this->file = $filesDAL->getFile($this->getDownloadLink());
    }

    /**
     * Is URL Set? Do we want to see download page for a file?
     * @return bool
     */
    function hasURL()
    {
        return isset($_GET[self::URL_DOWNLOAD]);
    }

    /**
     * Have we pressed the download button?
     * @return bool
     */
    function wantsToDownload()
    {
        return isset($_POST[self::URL_DOWNLOAD]);
    }

    /**
     * Gets the file data location (UID) from the file we are trying to download
     * @return string
     */
    private function getDownloadLink()
    {
        return $this->hasURL() ? $_GET[self::URL_DOWNLOAD] : "";
    }

    /**
     * Renders the page
     * @return string
     */
    function render()
    {
        //If there is a file to show (exists)
        if ($this->file) {
            //Are we trying to download it?
            if ($this->wantsToDownload()) {
                header('Content-Disposition: attachment; filename="' . $this->file->getFileName() . '"');
                header('Content-Type: ' . $this->file->getContentType());
                //Echoes the file content for download
                echo $this->filesDAL->readFileContent($this->file);
            } else { //Show download page
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                return "<form method='post'>
                            <p class='link'>Copy the link and send it to your friend!</p>
                            " . $actual_link . "
                            <h3>" . $this->file->getDescription() . "</h3>
                            <h5>" . $this->file->getFileName() . " uploaded by " . $this->file->getOwner() . "</h5>
                            <input type='submit' value='Download' />
                            <input type='hidden' name='" . self::URL_DOWNLOAD . "' value='" . $this->getDownloadLink() . "' />
                        </form>
                     <a href='./'>Back to start</a>";
            }
        } else { //File does not exist
            return "<p>" . self::WARNING_FILE_NO_EXIST . "</p>
            <a href='./'>Back to start</a>";
        }
    }
}