@extends('adminlte::page')

@section('title', 'Cadastrar Novo Produto')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Produto</li>
        </ol>
    </nav>

    <h1>Cadastrar Novo Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.products.store') }}" class="form" method="post" enctype="multipart/form-data">

                @include('admin.pages.products._partials.form')

            </form>

        </div>
    </div>
@stop
