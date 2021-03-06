@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Nova Categoria</li>
        </ol>
    </nav>

    <h1>Cadastrar Nova Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.categories.store') }}" class="form" method="post">

                @include('admin.pages.categories._partials.form')

            </form>

        </div>
    </div>
@stop
