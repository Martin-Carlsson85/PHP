<?php

namespace controller;

use model\FilesDAL;
use view\CookieView;
use view\DeleteFileView;
use view\LoggedInView;
use view\LoginView;
use view\SessionView;

class LoggedInController implements ControllerInterface
{
    private $filesDAL;

    function __construct()
    {
        $this->filesDAL = FilesDAL::getInstance();
        $this->loggedInView = new LoggedInView($this->filesDAL);
    }

    function run()
    {
        //Does the user want to log out, if so, do it!
        if ($this->loggedInView->wantsToLogOut()) {
            SessionView::killSession();
            CookieView::killCookies();
            $loginView = new LoginView();
            $loginView->setMessage(\view\LoginView::GOODBYE_MESSAGE);
            return $loginView;
        }
        //Does the user want to uplaoad
        if ($this->loggedInView->wantsToUpload()) {
            $this->filesDAL->saveFile($this->loggedInView->getUploadedFile(), $this->loggedInView->getDescription(), SessionView::tryGetLoginCredentials()->getUser());
            $this->loggedInView->setMessage(LoggedInView::UPLOAD_SUCCESS);
        } else if ($this->loggedInView->wantsToRemoveFile()) { //Does the user want to remove the file
            return new DeleteFileView($this->filesDAL->getFile($this->loggedInView->getIdToRemove()));
        }

        //Did the user want to remove file and then accepted it
        if (DeleteFileView::acceptedRemoveFile()) {
            $this->filesDAL->removeFile(DeleteFileView::fileToRemove());
            $this->loggedInView->setMessage(LoggedInView::DELETE_SUCCESS);
        }

        return $this->loggedInView;
    }

    public function wantsToEdit()
    {
        return $this->loggedInView->wantsToEdit();
    }

    public function getIdToEdit()
    {
        return $this->loggedInView->getIdToEdit();
    }
}