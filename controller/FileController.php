<?php

namespace controller;

class FileController {
    const URL_DOWNLOAD = "download";

    function hasURL(){
        return isset($_GET[self::URL_DOWNLOAD]);
    }
}