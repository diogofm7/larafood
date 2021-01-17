@extends('adminlte::page')

@section('title', 'Permissões do cargo ' . $role->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Cargos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.show', $role->id) }}">{{ $role->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissões</li>
        </ol>
    </nav>

    <h1>Permissões do cargo <strong>{{ $role->name }}</strong>
        <a href="{{ route('admin.roles.permissions.available', $role->id) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD Permissão</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.roles.permissions', $role->id) }}" class="form form-inline" method="post">
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
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ route('admin.roles.permissions.detach', [$role->id, $permission->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $permissions->appends($filters)->links() }}
            @else
                {{ $permissions->links() }}
            @endif
        </div>
    </div>
@stop
