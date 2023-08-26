<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ["title", "content", "picture"];

    protected $table = "blog";
    
    //===import automatique des des colonnes de la table===
    /* use HasFactory; */
}
