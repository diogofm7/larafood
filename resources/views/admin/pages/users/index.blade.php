@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
    </nav>

    <h1>Usuários <a href="{{ route('admin.users.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.users.search') }}" class="form form-inline" method="post">
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
                        <th>E-mail</th>
                        <th width="360">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $users->appends($filters)->links() }}
            @else
                {{ $users->links() }}
            @endif
        </div>
    </div>
@stop
