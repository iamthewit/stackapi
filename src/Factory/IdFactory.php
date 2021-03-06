<?php

namespace App\Factory;

use App\Stack\Id;

class IdFactory
{
    public static function generateFromRandom(): Id
    {
        return Id::buildFromValue(uniqid());
    }
}