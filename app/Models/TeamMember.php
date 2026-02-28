<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    //
    protected $fillable = [
        'name',
        'position',
        'department',
        'description',
        'image_path',
        'sort_order',
        'is_active',
    ];
}
