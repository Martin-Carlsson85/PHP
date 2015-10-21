<?php
/**
 * Created by IntelliJ IDEA.
 * User: lohnn
 * Date: 2015-10-20
 * Time: 20:57
 */

namespace view;


use model\File;

class EditFileView implements ViewInterface
{
    const TEXT_TOO_LONG = "The text needs to be 50 characters or less!";
    private static $updateFile = "EditFileView::UpdateFile";

    private $message = "";

    function __construct(File $file)
    {
        $this->file = $file;
    }

    function setMessage($message)
    {
        $this->message = $message;
    }

    function render()
    {
        return "<form method='post'>
                    <h2>" . $this->message . "</h2>
                    <label>
                        File description:
                        <input type='text' maxlength='50' name='" . self::$updateFile . "' placeholder='Description' value='" . $this->file->getDescription() . "' />
                    </label>
                    <p>" . $this->file->getFileName() . "</p>
                    <input type='submit' value='Update information' />
                    <a href='./'><input type='button' value='Cancel' /></a>
                </form>";
    }

    public function getDescription()
    {
        return $_POST[self::$updateFile];
    }

    public function triesToEdit()
    {
        return isset($_POST[self::$updateFile]);
    }

    public function goBackToMainPage()
    {
        header("location: ./");
    }
}