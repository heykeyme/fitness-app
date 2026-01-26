<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusType extends Model
{
    // This allows the seeder to insert data into the 'name' column
    protected $fillable = ['name'];
}
