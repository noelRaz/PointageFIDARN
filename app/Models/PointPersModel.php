<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointPersModel extends Model
{
    use HasFactory;
    protected $table = 'pointage_pers';
    protected $primaryKey = 'pointID';
    protected $fillable = [
        'pointCodePers'
    ];
}
