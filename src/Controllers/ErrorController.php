<?php

namespace App\Controllers;

class ErrorController{
    public function display(){
        $template = 'error';
        require_once '../src/views/layout.phtml';
    }
}