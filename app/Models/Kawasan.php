<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    use HasFactory;

    protected $table = 'kawasan';
    protected $primaryKey = 'id_kawasan';
    protected $fillable = [
        'nama_kawasan',
        'id_direktorat',
        'created_at',
        'updated_at',
    ];

    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'id_direktorat');
    }

    public function negara()
    {
        return $this->hasMany(Negara::class, 'id_kawasan');
    }
   
}
