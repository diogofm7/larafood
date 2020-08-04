@extends('adminlte::page')

@section('title', 'Perfis do plano ' . $plan->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">PLanos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.show', $plan->id) }}">{{ $plan->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perfis</li>
        </ol>
    </nav>

    <h1>Perfis do plano <strong>{{ $plan->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.plans.profiles', $plan->id) }}" class="form form-inline" method="post">
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
                @foreach($profiles as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td>
                            <a href="{{ route('admin.profiles.plans.detach', [$profile->id, $plan->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Desvincular</a>
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
