<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
