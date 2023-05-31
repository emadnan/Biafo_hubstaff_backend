<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunctionalSpecificationForm extends Model
{
    use HasFactory;
    protected $table="functional_specification_form";
    protected $primaryKey="id";

    function function_lead_name(){
        return $this->BelongsTo('App\Models\User','id','functional_lead_id');
    }
    function getFsfParameter(){
        return $this->hasMany('App\Models\FsfHasParameter', 'fsf_id', 'id');
    }
}
