@extends('adminlte::page')

@section('title', 'Detalhes do Perfil ' . $profile->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.profiles.index') }}" class="active">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.profiles.show', $profile->id) }}" class="active">{{ $profile->name }}</a></li>
    </ol>

    <h1>Detalhes do Perfil {{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li>
                    <strong>Nome: </strong>{{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $profile->description }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.profiles.destroy', $profile->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Perfil {{ $profile->name }}</button>
            </form>
        </div>
    </div>
@stop
