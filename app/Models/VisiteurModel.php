<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiteurModel extends Model
{
    use HasFactory;
    protected $table = 'visiteur';
    protected $primaryKey = 'visiID';
    protected $fillable = [
        'visiNom',
        'visiPrenom',
        'visiCIN',
        'visiTel',
        'visiPers'
    ];
}
