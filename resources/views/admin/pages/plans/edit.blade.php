@extends('adminlte::page')

@section('title', 'Editar o Plano' . $plan->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.plans.index') }}" class="active">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.plans.edit', $plan->url) }}" class="active">Editar o Plano {{ $plan->name }}</a></li>
    </ol>

    <h1>Editar o Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.plans.update', $plan->url) }}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.plans._partials.form')

            </form>

        </div>
    </div>
@stop
