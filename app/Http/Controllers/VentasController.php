<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Ventas;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    protected $Ventas;
    public function __construct( Ventas $ventas)
    {
        $this->Ventas = $ventas;
    }

    public function index(){
        return view('modulos.ventas.index');
    }

    public function consultarProductos($id){
       return $this->Ventas->consultarPRoductos($id);
    }

    public function guardar(Request $request){
        //dd($request);
       $id = DB::table('tb_cod_cab_factura')->insertGetID(['total_factura' => $request->input('total')]);

       $factura = (object) $request->input('factura') ;
       foreach ( $factura as $arreglo){
                $arreglo = (object) $arreglo;
                DB::table('tb_cod_det_factura')->
                insert([
                    'cod_cab_factura' => $id,
                    'cod_producto' => $arreglo->item,
                    'cant_vendida' => $arreglo->cantidad,
                    'descripcion' => $arreglo->descripcion,
                    'precio' => $arreglo->precio,
                ]);
                $vendidos = DB::table('tb_productos')->select('stock_vendido')
                    ->where('id',$arreglo->item)
                    ->get();
                $vendidos = $vendidos->toArray();
                $vendidos = $vendidos[0]->stock_vendido + $arreglo->cantidad;
                DB::table('tb_productos')->where('id',$arreglo->item)->update([
                    'stock_vendido' => $vendidos
           ]);
        }

    }
}
