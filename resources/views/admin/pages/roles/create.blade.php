@extends('adminlte::page')

@section('title', 'Cadastrar Novo Cargo')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Cargos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Cargo</li>
        </ol>
    </nav>

    <h1>Cadastrar Novo Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.roles.store') }}" class="form" method="post">

                @include('admin.pages.roles._partials.form')

            </form>

        </div>
    </div>
@stop
