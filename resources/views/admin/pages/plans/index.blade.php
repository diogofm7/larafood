@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.plans.index') }}" class="active">Planos</a></li>
    </ol>

    <h1>Planos <a href="{{ route('admin.plans.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.plans.search') }}" class="form form-inline" method="post">
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
                        <th>Preço</th>
                        <th width="280">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.details.plan.index', $plan->url) }}" class="btn btn-primary">Detalhes</a>
                                <a href="{{ route('admin.plans.edit', $plan->url) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                                <a href="{{ route('admin.plans.show', $plan->url) }}" class="btn btn-warning"><i class="fas fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
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
