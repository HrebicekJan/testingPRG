<?php

namespace Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo "Home page";
    }

    public function hello($name = "Guest")
    {
        echo "Hello, " . htmlspecialchars($name);
    }
}