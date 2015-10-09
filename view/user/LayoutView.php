<?php

namespace view;

class LayoutView {

    /**
     * Base render function, renders the skeleton of the page and calls other render function
     * for meat
     * @param $isLoggedIn
     * @param ViewInterface $viewInterface
     * @param DateTimeView $dtv
     */
  public function render($isLoggedIn, ViewInterface $viewInterface, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $viewInterface->render() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

    /**
     * Returns one string if logged in, and another if not
     * @param $isLoggedIn
     * @return string
     */
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}