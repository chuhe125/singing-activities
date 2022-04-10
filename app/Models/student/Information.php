<?php


namespace App\Models\student;


use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected  $table = 'information';
    public $timestamps = true ;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
