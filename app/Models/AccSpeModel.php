<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccSpeModel extends Model
{
    protected $table = 'pers_ext';
    protected $primaryKey = 'ext_code';
    protected $fillable = [
        'extNom',
        'extPrenom',
        'extEmail',
        'extFonc',
        'extTel'
    ];
}
