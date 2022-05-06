<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','categorie','video'
    ];

    public function categorie()
    {
        return $this->belongsTo('App\Models\CategorieEducation');
    }
}
