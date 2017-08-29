<?php

namespace ead;

use Illuminate\Database\Eloquent\Model;

class Pre_reserva extends Model
{
    //
    protected $table = "pre_reserva";
    
    protected $filable = ['nome','email','fone','professor','instituicao','evento','obs','created_at'];
    protected $dates = ['deleted_at'];
    
    public function pre_reserva_datas()
    {
        return $this->hasMany('ead\Pre_reserva_datas');
    }        

}
