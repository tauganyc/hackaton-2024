<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;
    protected $fillable = [
        'empresa_id',
        'investidor_id',
        'valor',
        'status',
    ];
}
