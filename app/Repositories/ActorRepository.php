<?php

namespace App\Repositories;

use App\Models\Actor;

class ActorRepository
{
    protected $actor;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }
}