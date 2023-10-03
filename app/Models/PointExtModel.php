<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointExtModel extends Model
{
    use HasFactory;
    protected $table = 'pointage_os_as';
    protected $primaryKey = 'pointID';
    protected $fillable = [
        'pointCodeExt'
    ];
}
