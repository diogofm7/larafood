@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.permissions.index') }}" class="active">Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.permissions.create') }}" class="active">Cadastrar Nova Permissão</a></li>
    </ol>

    <h1>Cadastrar Nova Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.permissions.store') }}" class="form" method="post">

                @include('admin.pages.permissions._partials.form')

            </form>

        </div>
    </div>
@stop
