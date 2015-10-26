<?php

namespace view;

class LayoutView {

    /**
     * Base render function, renders the skeleton of the page and calls other render function
     * for meat
     * @param ViewInterface $viewInterface
     * @param DateTimeView $dtv
     */
  public function render(ViewInterface $viewInterface, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Download a file</title>
           <link rel="stylesheet" type="text/css" href="Css/style.css">
        </head>
        <body>
          <h1>FileDownloader</h1>
          <div id="container">
              ' . $viewInterface->render() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
}