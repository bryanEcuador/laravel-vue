@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row" id="applicacion">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Compra de productos</div>

                    <div  class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <input type="text" placeholder="buscar producto" class="form-control" v-on:keyup.13="consultar" v-model="producto"><br>
                        <table CLASS=" table table-bordered">
                            <thead>
                                <th>ITEM</th>
                                <th>DESCRIPCION</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                            </thead>
                            <tbody>
                                <tr v-for="dato in cmbDatos">
                                    <td>@{{dato.item}}</td>
                                    <td>@{{dato.descripcion}}</td>
                                    <td>@{{dato.cantidad}}</td>
                                    <td>@{{dato.precio}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="text" v-model="total" readonly>
                        <button v-on:click="guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>

    <script>
        var app = new Vue({
            el:'#applicacion',

            data : {
                cmbDatos : [],
                producto : 0,
                total : 0,
                respuesta : false,
                items : [],
            },
            created : function() {

            },

            methods : {


                consultar : function(){
                    var url = '/ventas/consultar/'+this.producto;
                    axios.get(url).then( response => {

                        if(response.data[0].stock === response.data[0].stock_vendido){
                            alert("No existe mas productos en stock")
                        }else {


                        if(this.cmbDatos.length=== 0) {
                            var id = response.data[0].id;
                            var descripcion = response.data[0].descripcion;
                            var precio = response.data[0].precio;
                            var cantidad = 1;
                            var max = response.data[0].stock - response.data[0].stock_vendido;
                            var datos= new Object();
                            datos.item = id;
                            datos.descripcion = descripcion;
                            datos.precio = precio;
                            datos.cantidad = cantidad;
                            datos.max = max;

                            this.cmbDatos.push(datos);
                            this.items.push(id);
                            this.suma(response.data[0].precio);
                        } else {

                            var id = response.data[0].id;

                            if(this.items.indexOf(id) == -1){
                                var id = response.data[0].id;
                                var descripcion = response.data[0].descripcion;
                                var precio = response.data[0].precio;
                                var cantidad = 1;
                                var max = response.data[0].stock - response.data[0].stock_vendido;
                                var datos= new Object();
                                datos.item = id;
                                datos.descripcion = descripcion;
                                datos.precio = precio;
                                datos.cantidad = cantidad;
                                datos.max = max;
                                this.cmbDatos.push(datos);
                                this.items.push(id);
                                this.suma(response.data[0].precio);
                            }else{

                                this.aumentar(id,response.data[0].precio);
                            }
                        }




                    }
                }).catch(error => {

                    });
                },

                suma : function(valor) {
                   this.total = this.total +valor;
                },

                aumentar : function(id,precio){

                    for(var i = 0; i <= this.cmbDatos.length; i++){
                        if(this.cmbDatos[i].item == id) {
                           if(this.cmbDatos[i].max == this.cmbDatos[i].cantidad){
                               alert("No se puede agregar mas items a este producto")
                           }else{
                               this.cmbDatos[i].cantidad = this.cmbDatos[i].cantidad +1;
                               this.suma(precio);
                           }
                        }
                    }
                },

                guardar : function(){
                  axios.post('/ventas/guardar',{
                        total : this.total,
                        factura : this.cmbDatos,
                  }).then(response => {
                        this.cmbDatos = [];
                        this.producto = 0;
                        this.items = [];
                        this.total = 0;
                        alert('Compra realizada con exito');
                  }).catch(response => {

                    });
                }

            }
        });

    </script>
@endsection
