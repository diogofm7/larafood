@extends('adminlte::page')

@section('title', 'Cargos do usuário ' . $user->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cargos</li>
        </ol>
    </nav>

    <h1>Cargos do usuário <strong>{{ $user->name }}</strong>
        <a href="{{ route('admin.users.roles.available', $user->id) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD Cargo</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.users.roles', $user->id) }}" class="form form-inline" method="post">
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
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('admin.users.roles.detach', [$user->id, $role->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $roles->appends($filters)->links() }}
            @else
                {{ $roles->links() }}
            @endif
        </div>
    </div>
@stop
