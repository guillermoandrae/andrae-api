<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;

interface ModelInterface extends Arrayable
{
    /**
     * @return \DateTime
     */
    public function getCreatedAt();
}
