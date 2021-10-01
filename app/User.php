<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

   protected $table = "usuarios";

    protected $fillable = [
        'id_pessoa',
        'username',
        'password',
        'email',
        'estado',
        'nivel_acesso',
        'code_verification',
        'isVerified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
    }

    public function pagamento(){
        return $this->hasMany(Pagamento::class, 'id_usuario', 'id');
    }

    public function pagamento_pai(){
        return $this->hasMany(PagamentoPai::class, 'id_usuario', 'id');
    }
}