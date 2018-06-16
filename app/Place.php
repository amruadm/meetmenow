<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model


{

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
