<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rawlogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'request', 'response'
    ];    
}
