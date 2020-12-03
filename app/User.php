<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use Notifiable;

    protected $table = "usuario";
    protected $primaryKey = 'Id';
    public $timestamps = false;
    public $remember_token = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nombre', 'Correo', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];    

    public function TipoUsuario()
    {
        return $this->belongsTo('App\Models\TipoUsuario', 'TipoUsuarioId');
    }
}
