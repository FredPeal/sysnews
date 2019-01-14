<?php 

namespace App\Core;

class Api 
{
    private static $timelife = 720;

    public function static lifetime()
    {
        return $this->lifetime;
    }
}