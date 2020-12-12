@extends('adminlte::page')

@section('title', 'Editar o Produto' . $product->title)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar o Produto {{ $product->title }}</li>
        </ol>
    </nav>

    <h1>Editar o Produto {{ $product->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.products.update', $product->id) }}" class="form" method="post" enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.products._partials.form')

            </form>

        </div>
    </div>
@stop
