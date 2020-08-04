@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.index') }}">Perfis</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Perfil</li>
        </ol>
    </nav>

    <h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.profiles.store') }}" class="form" method="post">

                @include('admin.pages.profiles._partials.form')

            </form>

        </div>
    </div>
@stop
