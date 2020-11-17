@extends('adminlte::page')

@section('title', 'Detalhes do Usuário ' . $user->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>

    <h1>Detalhes do Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li>
                    <strong>Nome: </strong>{{ $user->name }}
                </li>
                <li>
                    <strong>Email: </strong>{{ $user->email }}
                </li>
                <li>
                    <strong>Empresa: </strong>{{ $user->tenant->name }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o usuário {{ $user->name }}</button>
            </form>
        </div>
    </div>
@stop
