<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taskModel extends Model
{
    use HasFactory;
    protected $table = "tasks";

    protected $fillable = ['title','description','sDate','eDate','image','addedBy'];

    public $timestamps = false ;
}
