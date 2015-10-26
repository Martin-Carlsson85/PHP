<?php
/**
 * Created by IntelliJ IDEA.
 * User: lohnn
 * Date: 2015-10-12
 * Time: 15:02
 */

namespace view;


use model\FilesDAL;

class LoggedInView implements ViewInterface
{
    const DELETE_SUCCESS = "File deleted";
    const UPLOAD_SUCCESS = "Upload finished";

    private static $logout = 'LoggedInView::Logout';
    private static $upload = 'LoggedInView::Upload';
    private static $description = 'LoggedInView::Description';
    private static $deleteFile = "deleteFile";
    private static $editFile = "edit";

    private $message = "", $filesDAL;

    function __construct(FilesDAL $filesDAL)
    {
        $this->filesDAL = $filesDAL;
    }

    /**
     * Does the user want to log out?
     * @return bool
     */
    function wantsToLogOut()
    {
        return isset($_POST[self::$logout]);
    }

    /**
     * Does the user want to upload a file?
     * @return bool
     */
    function wantsToUpload()
    {
        return (isset($_FILES[self::$upload]) && file_exists($_FILES[self::$upload]['tmp_name']) && is_uploaded_file($_FILES[self::$upload]['tmp_name']));
    }

    /**
     * Gets the uploaded file
     * @return mixed
     */
    function getUploadedFile()
    {
        return $_FILES[self::$upload];
    }

    /**
     * Gets the form description text
     * @return mixed
     */
    function getDescription()
    {
        return $_POST[self::$description];
    }

    /**
     * Renders the list of files the user ownes
     * @return string
     */
    function renderFileList()
    {
        $toReturn = "";
        foreach ($this->filesDAL->getFilesForUser(SessionView::tryGetLoginCredentials()->getName()) as $file) {
             mb_strlen(trim($file->getDescription())) > 0 ? $file->getDescription() : "Description";
            $toReturn .= "<div>" .
                $file->getFileName()
                . " <a href='?" . FileView::URL_DOWNLOAD . "=" . $file->getDataLocation() . "'>Download</a> "
                . "<a href='?" . self::$editFile . "=" . $file->getDataLocation() . "'>Description</a> "
                . "<a href='?" . self::$deleteFile . "=" . $file->getDataLocation() . "'>Remove file</a> "
                . "</div>";
        }
        return $toReturn;
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @return string
     */
    function render()
    {
        return '
			<form  method="post" >
				<p>' . $this->message . '</p>
				<input id="logout" type="submit" name="' . self::$logout . '" value="Logout"/>
			</form>
			<form action="./" method="post" enctype="multipart/form-data">
			    <input class="brows" type="file" id="' . self::$upload . '" name="' . self::$upload . '"  />
			    <input class="description" type="text" name="' . self::$description . '" placeholder="Description" />
			    <input class="upload" type="submit" value="Upload" />
			</form>
			<div>
			    ' . $this->renderFileList() . '
			</div>
		';
    }

    /**
     * Does the user want to remove a file?
     * @return bool
     */
    public function wantsToRemoveFile()
    {
        return isset($_GET[self::$deleteFile]);
    }

    /**
     * Gets the id of the file to remove
     * @return string
     */
    public function getIdToRemove()
    {
        return isset($_GET[self::$deleteFile]) ? $_GET[self::$deleteFile] : "";
    }

    /**
     * Does the user want to edit the upload?
     * @return bool
     */
    public function wantsToEdit()
    {
        return isset($_GET[self::$editFile]);
    }

    public function getIdToEdit()
    {
        return $_GET[self::$editFile];
    }

    /**
     * Sets the message to show on the page.
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}