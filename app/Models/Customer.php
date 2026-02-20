<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $timestamps = false; // Désactive si tu n'as pas mis les timestamps dans le CSV
    protected $guarded = [];
}
