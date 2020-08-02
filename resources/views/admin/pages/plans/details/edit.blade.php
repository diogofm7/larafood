@extends('adminlte::page')

@section('title', 'Editar o Detalhe - ' . $detail->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.details.plan.index', $plan->url) }}">Detalhes {{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.details.plan.edit', [$plan->url, $detail->id]) }}" class="active">Editar Detalhe</a></li>
    </ol>

    <h1>Editar o Detalhe - {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.details.plan.update', [$plan->url, $detail->id]) }}" method="post" class="form">
                @method('PUT')

                @include('admin.pages.plans.details._partils.form')

            </form>
        </div>
    </div>
@stop
