@extends('adminlte::page')

@section('title', 'Planos disponiveis para o perfil ' . $profile->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.index') }}">Perfis</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.show', $profile->id) }}">{{ $profile->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.profiles.plans', $profile->id) }}">Planos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
        </ol>
    </nav>

    <h1>Planos disponiveis para o perfil <strong>{{ $profile->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.profiles.plans.available', $profile->id) }}" class="form form-inline" method="post">
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
                    <form action="{{ route('admin.profiles.plans.attach', $profile->id) }}" method="post">
                        @csrf
                        @foreach($plans as $plan)
                            <tr>
                                <td>
                                    <input type="checkbox" name="plans[]" value="{{ $plan->id }}">
                                </td>
                                <td>{{ $plan->name }}</td>
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
                {{ $plans->appends($filters)->links() }}
            @else
                {{ $plans->links() }}
            @endif
        </div>
    </div>
@stop
