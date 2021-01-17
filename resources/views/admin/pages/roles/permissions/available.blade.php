@extends('adminlte::page')

@section('title', 'Permissões disponiveis para o cargo ' . $role->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Cargos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.show', $role->id) }}">{{ $role->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.permissions', $role->id) }}">Permissões</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
        </ol>
    </nav>

    <h1>Permissões disponiveis para o cargo <strong>{{ $role->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.roles.permissions.available', $role->id) }}" class="form form-inline" method="post">
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
                    <form action="{{ route('admin.roles.permissions.attach', $role->id) }}" method="post">
                        @csrf
                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                </td>
                                <td>{{ $permission->name }}</td>
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
                {{ $permissions->appends($filters)->links() }}
            @else
                {{ $permissions->links() }}
            @endif
        </div>
    </div>
@stop
