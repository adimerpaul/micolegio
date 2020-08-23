@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Unidad Educativa Jose Ignacio de Sanjines</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <center><img src="img/logo.png" alt=""></center>
                            <br>
                            Dirección: Velasco Galvarro, Oruro <br>
                        Porfavor iniciar session
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
