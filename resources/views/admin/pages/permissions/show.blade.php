@extends('adminlte::page')

@section('title', 'Detalhes da Permissão ' . $permission->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.permissions.index') }}" class="active">Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.permissions.show', $permission->id) }}" class="active">{{ $permission->name }}</a></li>
    </ol>

    <h1>Detalhes da Permissão {{ $permission->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li>
                    <strong>Nome: </strong>{{ $permission->name }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $permission->description }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a Permissão {{ $permission->name }}</button>
            </form>
        </div>
    </div>
@stop
