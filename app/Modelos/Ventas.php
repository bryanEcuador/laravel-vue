<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Ventas extends Model
{
    public function consultarPRoductos($id){
       return DB::table('tb_productos')->where('id',$id)->get();
      // return DB::select('CALL consultarProductos(?)',array($id));
    }
}
