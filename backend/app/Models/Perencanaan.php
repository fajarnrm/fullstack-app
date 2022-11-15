<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perencanaan extends Model
{
    use HasFactory;
    //data yang diizinkan untuk diinputkan
    protected $fillable = ['rencana','deskripsi','status','target','syarat','biaya'];
}
