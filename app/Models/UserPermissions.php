<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    protected $table = 'user_permissions';

    protected $fillable = [
        'id_user',
        'id_permissions'
    ];

    public function scopeGetByIdUser($query, $idUser){
        return $query->where('id_user',$idUser);
    }

    public function scopeGetByIdUserAndIdPermissions($query, $idUser, $idPermissions){
        return $query->where('id_user',$idUser)
            ->where('id_permissions',$idPermissions);
    }
}
