<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdministradorController extends Controller
{
    public function index(){
       $datos = DB::table('tb_productos')->select('descripcion','stock','stock_vendido')->get();
       return view('modulos.administrador.index',compact('datos'));
    }
}
