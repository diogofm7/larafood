@extends('adminlte::page')

@section('title', 'Editar a Mesa' . $table->identify)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tables.index') }}">Mesas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar a Mesa {{ $table->identify }}</li>
        </ol>
    </nav>

    <h1>Editar a Mesa {{ $table->identify }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.tables.update', $table->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tables._partials.form')

            </form>

        </div>
    </div>
@stop
