<?php

namespace Models;

use Core\Model;

class User extends Model
{
    public function getAll()
    {
        return ["John", "Jane"];
    }
}