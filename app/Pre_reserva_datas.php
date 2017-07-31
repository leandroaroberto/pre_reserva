<?php

namespace ead;

use Illuminate\Database\Eloquent\Model;

class Pre_reserva_datas extends Model
{
    //
    protected $table = "pre_reserva_datas";
    protected $filable = ['pre_reserva_id','data_reserva','status','gid'];
    protected $dates = ['deleted_at'];
    
    function Pre_reserva(){
        return $this->belongsTo('ead\Pre_reserva');
    }
    
}
