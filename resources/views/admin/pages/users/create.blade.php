@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Usuário</li>
        </ol>
    </nav>

    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.users.store') }}" class="form" method="post">

                @include('admin.pages.users._partials.form')

            </form>

        </div>
    </div>
@stop
