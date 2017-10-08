@extends('layouts.app')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" /> <!--Se necestia este metadato para poder hacer AJAX, se envia el csrf_token al server para validar que si existe la sesion -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
</style>
<div class="container">
<!--
    <div class="navar">
        <ul class="nav nav-pills"> 
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/login') }}">Alumnos</a></li>
            <li><a href="{{ url('/Admin/Profesores') }}">Profesores</a></li>
            <li><a href="{{ url('/login') }}">Comentarios</a></li>
        </ul>
    </div>
-->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Funciones Administrador Profesores</div>
                <div class="panel-body">
                    Aqui se llevan a cabo las funciones del administrador sobre los profesores.                    

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h1>HOOOOOLA</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection