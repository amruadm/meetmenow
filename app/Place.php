<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'main_places';
    /* Set table name for sql insert /
    Устанавливает имя для вставляемые в sql таблицу*/
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /* Set necessary Belongs to Category /
    Устанавливает обязательную принадлежность к категории*/
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
