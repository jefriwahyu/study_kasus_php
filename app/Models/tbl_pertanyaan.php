<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pertanyaan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbl_pertanyaan';
    protected $fillable = ['pertanyaan', 'jawaban'];
}
