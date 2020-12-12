@extends('adminlte::page')

@section('title', 'Detalhes do Produto ' . $product->title)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
        </ol>
    </nav>

    <h1>Detalhes do Produto {{ $product->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <img src="{{ asset('storage/'.$product->image) }}" alt="Imagem do Produto {{ $product->title }}" style="max-width: 90px">

            <ul>
                <li>
                    <strong>Titulo: </strong>{{ $product->title }}
                </li>
                <li>
                    <strong>Preço: </strong>R${{ number_format($product->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Flag: </strong>{{ $product->flag }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $product->description }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Produto {{ $product->title }}</button>
            </form>
        </div>
    </div>
@stop
