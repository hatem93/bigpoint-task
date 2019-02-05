<?php

namespace App\DomainModelLayer\Items;

use Analogue\ORM\EntityMap;

class ItemMap extends EntityMap
{

    protected $table = 'items';
    public $timestamps = true;
}