<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getFormatedRate(){
        return $this->rate/2;
    }
}
