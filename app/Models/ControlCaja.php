<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlCaja extends Model
{
    use HasFactory;
    
    protected $table = 'control_caja';
    protected $fillable = ['estatus'];
}
