@extends('adminlte::page')

@section('title', 'Editar o Cargo ' . $role->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Cargos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar o Cargo {{ $role->name }}</li>
        </ol>
    </nav>

    <h1>Editar o Cargo {{ $role->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.roles.update', $role->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.roles._partials.form')

            </form>

        </div>
    </div>
@stop
