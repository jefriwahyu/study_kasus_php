<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_user extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_user';
    protected $fillable = ['name', 'username', 'password'];
}
