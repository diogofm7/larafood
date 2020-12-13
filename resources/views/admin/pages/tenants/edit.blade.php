@extends('adminlte::page')

@section('title', 'Editar a Empresa' . $tenant->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tenants.index') }}">Empresas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar a Empresa {{ $tenant->name }}</li>
        </ol>
    </nav>

    <h1>Editar a Empresa {{ $tenant->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.tenants.update', $tenant->id) }}" class="form" method="post" enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.tenants._partials.form')

            </form>

        </div>
    </div>
@stop
