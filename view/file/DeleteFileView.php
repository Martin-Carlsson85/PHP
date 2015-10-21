<?php
/**
 * Created by IntelliJ IDEA.
 * User: info_000
 * Date: 2015-10-16
 * Time: 12:24
 */

namespace view;


use model\File;

class DeleteFileView implements ViewInterface
{
    private static $deleteFile = "DeleteFileView::DeleteFile";
    private $fileToRemove;

    function __construct(File $fileToRemove)
    {
        $this->fileToRemove = $fileToRemove;
    }

    /**
     * Did the user accept to remove the file?
     * @return bool
     */
    public static function acceptedRemoveFile()
    {
        return isset($_POST[self::$deleteFile]);
    }

    /**
     * What file did the user want to remove?
     * @return mixed
     */
    public static function fileToRemove()
    {
        return $_POST[self::$deleteFile];
    }

    function render()
    {
        return "<div>Delete " . $this->fileToRemove->getFileName() . "?</div>
        <form method='post' action='./'>
            <input type='submit' value='Yes' />
            <input type='hidden' name='" . self::$deleteFile . "' value='" . $this->fileToRemove->getDataLocation() . "' />
            <a href='./'><input type='button' value='No' /></a>
        </form>
        ";
    }
}