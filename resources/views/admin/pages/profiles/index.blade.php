@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.profiles.index') }}" class="active">Perfis</a></li>
    </ol>

    <h1>Perfis <a href="{{ route('admin.profiles.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.profiles.search') }}" class="form form-inline" method="post">
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
                    <th width="280">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($profiles as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td>
{{--                            <a href="{{ route('admin.details.plan.index', $profile->url) }}" class="btn btn-primary">Detalhes</a>--}}
                            <a href="{{ route('admin.profiles.edit', $profile->id) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                            <a href="{{ route('admin.profiles.show', $profile->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i> Ver</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            @if (isset($filters))
                {{ $profiles->appends($filters)->links() }}
            @else
                {{ $profiles->links() }}
            @endif
        </div>
    </div>
@stop
