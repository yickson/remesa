@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Crear cuenta bancaria</h3>
                </div>
                <div class="card-body">
                    <form role="form" id="crear_cuenta">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Ingresa nombre del titular de cuenta">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Cédula de identidad</label>
                                <input type="text" class="form-control" name="identification" placeholder="12890233">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Banco</label>
                                <select id="bancos" name="bank_id" class="form-control">
                                    <option>Seleccione el banco</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Número de cuenta bancaria</label>
                                <div class="input-group">
                                    <input aria-describedby="basic-addon1" class="form-control" id="prefix" maxlength="4" name="prefix" pattern="[0-9]" placeholder="Código banco" type="text" disabled>
                                    <span class="input-group-addon" id="basic-addon1"></span>
                                    <input aria-describedby="basic-addon1" class="form-control" id="number" maxlength="16" pattern="[0-9]" name="number" placeholder="Número de cuenta" type="text">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
           $("#bancos").change(function(){
               let id = $("#bancos").val();
               axios.post('/admin/bank/search', {id})
               .then(function(response){
                   console.log(response.data);
                   $("#prefix").val(response.data.prefix);
               }).catch(function (error) {
                   console.log(error);
               });
           });

           $("#crear_cuenta").submit(function(){
               let form = new FormData(document.getElementById('crear_cuenta'));
           });
        });
    </script>
@endsection
