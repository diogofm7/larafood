@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empresas</li>
        </ol>
    </nav>

    <h1>Empresas {{--<a href="{{ route('admin.tenants.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a>--}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.tenants.search') }}" class="form form-inline" method="post">
                @csrf
                <div class="form-group mx-2">
                    <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters??'' }}">
                </div>
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i> Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="100">Logo</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th width="360">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr>
                            <td>
                                @if($tenant->logo)
                                    <img src="{{ asset('storage/'.$tenant->logo) }}" alt="Imagem da Empresa {{ $tenant->name }}" style="max-width: 90px">
                                @else
                                    #
                                @endif
                            </td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->cnpj }}</td>
                            <td>
                                <a href="{{ route('admin.tenants.edit', $tenant->id) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                                <a href="{{ route('admin.tenants.show', $tenant->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $tenants->appends($filters)->links() }}
            @else
                {{ $tenants->links() }}
            @endif
        </div>
    </div>
@stop
