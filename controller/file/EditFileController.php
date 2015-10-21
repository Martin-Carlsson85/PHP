<?php
/**
 * Created by IntelliJ IDEA.
 * User: lohnn
 * Date: 2015-10-20
 * Time: 20:55
 */

namespace controller;


use model\FilesDAL;
use view\EditFileView;

class EditFileController implements ControllerInterface
{
    function __construct($uid)
    {
        $this->filesDAL = FilesDAL::getInstance();
        $this->file = $this->filesDAL->getFile($uid);
        $this->view = new EditFileView($this->file);
    }

    function run()
    {
        if ($this->view->triesToEdit()) {
            $description = $this->view->getDescription();
            if (mb_strlen($description) <= 50) {
                $this->file->setDescription($this->view->getDescription());
                $this->filesDAL->updateFile($this->file);
                $this->view->goBackToMainPage();
            } else {
                $this->view->setMessage(EditFileView::TEXT_TOO_LONG);
            }
        }
        return $this->view;
    }
}