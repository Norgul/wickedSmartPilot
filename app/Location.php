<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //region Properties
    protected $fillable = [
        'name',
    ];
    //endregion Properties

    //region Relationships

    public function invoicesFrom()
    {
        return $this->hasMany(Invoice::class, 'origin_id');
    }

    public function invoicesTo()
    {
        return $this->hasMany(Invoice::class, 'destination_id');
    }

    //endregion Relationships
}
