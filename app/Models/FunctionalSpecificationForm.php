<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionalSpecificationForm extends Model
{
    use HasFactory;
    protected $table="functional_specification_form";
    protected $primaryKey="id";
}