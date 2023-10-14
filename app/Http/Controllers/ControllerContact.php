<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerContact extends Controller {
    public function contact(){
        return view("home.contact");
    }
}