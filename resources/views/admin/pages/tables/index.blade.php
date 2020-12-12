@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mesas</li>
        </ol>
    </nav>

    <h1>Mesas <a href="{{ route('admin.tables.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.tables.search') }}" class="form form-inline" method="post">
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
                        <th>Identificação</th>
                        <th>Descrição</th>
                        <th width="360">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{ $table->identify }}</td>
                            <td>{{ $table->description }}</td>
                            <td>
                                <a href="{{ route('admin.tables.edit', $table->id) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                                <a href="{{ route('admin.tables.show', $table->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $tables->appends($filters)->links() }}
            @else
                {{ $tables->links() }}
            @endif
        </div>
    </div>
@stop
