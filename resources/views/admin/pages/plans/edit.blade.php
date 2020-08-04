@extends('adminlte::page')

@section('title', 'Editar o Plano' . $plan->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">Planos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar o Plano {{ $plan->name }}</li>
        </ol>
    </nav>

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
