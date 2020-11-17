@extends('adminlte::page')

@section('title', 'Editar o Usuário' . $user->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar o Usuário {{ $user->name }}</li>
        </ol>
    </nav>

    <h1>Editar o Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.users.update', $user->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.users._partials.form')

            </form>

        </div>
    </div>
@stop
