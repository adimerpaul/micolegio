@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('importmateria') }}" method="POST" class="form-inline" enctype="multipart/form-data">
                    @csrf
{{--                    <label class="sr-only" >Importar profesores</label>--}}
                    <input type="file" name="file" class="form-control mb-2 mr-sm-2"  required>
                    <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Importar datos materia</button>
                    {{--        <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}
                </form>
            </div>
        </div>
    </div>

    <materia-component></materia-component>
@endsection
