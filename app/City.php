<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "ciudad";

    /**
     * This method will be related with the model BranchOffice
     * @return HasMany
     */
    public function branchOffices()
    {
        return $this->hasMany(BranchOffice::class, 'ciudad_id');
    }
}
