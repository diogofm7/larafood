@extends('adminlte::page')

@section('title', 'Detalhe - ' . $detail->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">Planos</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.details.plan.index', $plan->url) }}">Detalhes</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $detail->name }}</li>
        </ol>
    </nav>

    <h1>Detalhe - {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $detail->name }}
                </li>
            </ul>
        </div>

        <div class="card-footer">
            <form action="{{ route('admin.details.plan.destroy', [$plan->url, $detail->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Detalhe {{ $detail->name }}</button>
            </form>
        </div>
    </div>
@stop
