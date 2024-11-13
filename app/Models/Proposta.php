<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'valor',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function investimentos()
    {
        return $this->hasMany(Investimento::class);
    }
}
