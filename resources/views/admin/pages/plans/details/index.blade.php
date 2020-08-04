@extends('adminlte::page')

@section('title', 'Detalhes do Plano - ' . $plan->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">Planos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
        </ol>
    </nav>

    <h1>Detalhes do Plano - {{ $plan->name }} <a href="{{ route('admin.details.plan.create', $plan->url) }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th width="200">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td>{{ $detail->name }}</td>
                        <td>
                            <a href="{{ route('admin.details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                            <a href="{{ route('admin.details.plan.show', [$plan->url, $detail->id]) }}" class="btn btn-warning"><i class="fas fa-eye"></i> Ver</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $details->links() }}
        </div>
    </div>
@stop
