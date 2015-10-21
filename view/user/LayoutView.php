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
          <title>I want to download a file</title>
        </head>
        <body>
          <h1>FileDownloader</h1>
          <div class="container">
              ' . $viewInterface->render() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
}