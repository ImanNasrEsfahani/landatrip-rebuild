<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    // Define any methods or properties you want to be available to all models

    /**
     * Get Table name
     * @return string
     */
    public static function tableNameGetter(): string
    {
        return (new BaseModel)->getTable();
    }
}
