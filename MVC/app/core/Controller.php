<?php

namespace Core;

class Controller
{
    public function model($model)
    {
        $class = "Models\\" . $model;
        return new $class();
    }

    public function view($view, $data = [])
    {
        extract($data);
        require "../app/views/" . $view . ".php";
    }
}