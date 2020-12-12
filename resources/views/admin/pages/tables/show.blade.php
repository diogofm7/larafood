@extends('adminlte::page')

@section('title', 'Detalhes da Mesa ' . $table->identify)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tables.index') }}">Mesas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $table->identify }}</li>
        </ol>
    </nav>

    <h1>Detalhes da Mesa {{ $table->identify }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li>
                    <strong>Identificação: </strong>{{ $table->identify }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $table->description }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.tables.destroy', $table->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a Mesa {{ $table->name }}</button>
            </form>
        </div>
    </div>
@stop
