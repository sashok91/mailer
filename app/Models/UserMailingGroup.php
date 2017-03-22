<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMailingGroup extends Model
{
    protected $table = 'user_mailing_group';

    protected $fillable = [
        'id_user',
        'id_mailing_group'
    ];

    public function scopeGetByIdUser($query, $idUser){
        return $query->where('id_user',$idUser);
    }

    public function scopeGetByIdUserAndIdMailingGroup($query, $idUser, $idMailingGroup){
        return $query->getByIdUser($idUser)
            ->where('id_mailing_group',$idMailingGroup);
    }
}
