@extends('adminlte::page')

@section('title', 'Adicionar novo Detalhe ao Plano - ' . $plan->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.details.plan.index', $plan->url) }}">Detalhes {{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.details.plan.create', $plan->url) }}" class="active">Novo Detalhe</a></li>
    </ol>

    <h1>Adicionar novo Detalhe ao Plano - {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.details.plan.store', $plan->url) }}" method="post" class="form">

                @include('admin.pages.plans.details._partils.form')

            </form>
        </div>
    </div>
@stop
