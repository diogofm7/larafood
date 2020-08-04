@extends('adminlte::page')

@section('title', 'Editar a Permissão ' . $permission->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissões</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar a Permissão {{ $permission->name }}</li>
        </ol>
    </nav>

    <h1>Editar a Permissão {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.permissions.update', $permission->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.permissions._partials.form')

            </form>

        </div>
    </div>
@stop
