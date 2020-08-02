@extends('adminlte::page')

@section('title', 'Detalhes do Plano ' . $plan->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.plans.index') }}" class="active">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.plans.show', $plan->url) }}" class="active">{{ $plan->name }}</a></li>
    </ol>

    <h1>Detalhes do Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <ul>
                <li>
                    <strong>Nome: </strong>{{ $plan->name }}
                </li>
                <li>
                    <strong>URL: </strong>{{ $plan->url }}
                </li>
                <li>
                    <strong>Preço: </strong>R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $plan->description }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.plans.destroy', $plan->url) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o plano {{ $plan->name }}</button>
            </form>
        </div>
    </div>
@stop
