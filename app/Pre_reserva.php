<?php

namespace ead;

use Illuminate\Database\Eloquent\Model;

class Pre_reserva extends Model
{
    //
    protected $table = "pre_reserva";
    
    protected $filable = ['nome','email','fone','professor','evento','obs'];
    protected $dates = ['deleted_at'];
    
    public function pre_reserva_datas()
    {
        return $this->hasMany('ead\Pre_reserva_datas');
    }        

}
