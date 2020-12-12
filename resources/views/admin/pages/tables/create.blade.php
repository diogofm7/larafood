@extends('adminlte::page')

@section('title', 'Cadastrar Nova Mesa')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tables.index') }}">Mesas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Nova Mesa</li>
        </ol>
    </nav>

    <h1>Cadastrar Nova Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.tables.store') }}" class="form" method="post">

                @include('admin.pages.tables._partials.form')

            </form>

        </div>
    </div>
@stop
