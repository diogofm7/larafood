@extends('adminlte::page')

@section('title', 'Categorias do Produto ' . $product->title)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produtos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categorias</li>
        </ol>
    </nav>

    <h1>Categorias do Produto <strong>{{ $product->title }}</strong>
        <a href="{{ route('admin.products.categories.available', $product->id) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD Categoria</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.products.categories', $product->id) }}" class="form form-inline" method="post">
                @csrf
                <div class="form-group mx-2">
                    <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter']??'' }}">
                </div>
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i> Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th width="150">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('admin.products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $categories->appends($filters)->links() }}
            @else
                {{ $categories->links() }}
            @endif
        </div>
    </div>
@stop
