<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $table = "reset_passwords";

    protected $fillable = [
        'id_user',
        'hash_code',
        'verify_code',
        'estado',
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}