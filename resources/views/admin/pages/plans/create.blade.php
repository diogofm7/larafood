@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plans.index') }}">Planos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Plano</li>
        </ol>
    </nav>

    <h1>Cadastrar Novo Plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.plans.store') }}" class="form" method="post">

                @include('admin.pages.plans._partials.form')

            </form>

        </div>
    </div>
@stop
