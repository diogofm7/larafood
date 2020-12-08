@extends('adminlte::page')

@section('title', 'Editar a Categoria' . $category->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar a Categoria {{ $category->name }}</li>
        </ol>
    </nav>

    <h1>Editar a Categoria {{ $category->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.categories.update', $category->id) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.categories._partials.form')

            </form>

        </div>
    </div>
@stop
