@extends('adminlte::page')

@section('title', 'Categorias disponiveis para o Produto ' . $product->title)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produtos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.categories', $product->id) }}">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
        </ol>
    </nav>

    <h1>Categorias disponiveis para o Produto <strong>{{ $product->title }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.products.categories.available', $product->id) }}" class="form form-inline" method="post">
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
                    <th width="50px">#</th>
                    <th>Nome</th>
                </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.products.categories.attach', $product->id) }}" method="post">
                        @csrf
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                </td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
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
