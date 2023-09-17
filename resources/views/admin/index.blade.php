@extends('adminlte::page')

@section('title', 'Panel')

@section('content_header')
    <h1>PFJ Lima Norte 2024</h1>
@stop

@section('content')
    <p>Bienvenido al Panel Administrativo del <strong>{{ config('app.name') }}</strong></p>
    <div>
        <div class="contimg">
            <img src="{{ config('app.url', 'http://localhost/pfj/public').'/img/banner2024.png' }}" alt="">
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="">
    <style type="text/css">
        .contimg{
            text-align: center;   
        }
        .contimg>img{
            width:100%!important;
            opacity: 1;
            border:  0px!important;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop