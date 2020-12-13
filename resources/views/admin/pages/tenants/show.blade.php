@extends('adminlte::page')

@section('title', 'Detalhes da Empresa ' . $tenant->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tenants.index') }}">Empresas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $tenant->name }}</li>
        </ol>
    </nav>

    <h1>Detalhes da Empresa {{ $tenant->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            @if($tenant->logo)
                <img src="{{ asset('storage/'.$tenant->logo) }}" alt="Imagem da Empresa {{ $tenant->name }}" style="max-width: 90px">
            @endif

            <ul>
                <li>
                    <strong>Plano: </strong>{{ $tenant->plan->name }}
                </li>
                <li>
                    <strong>Nome: </strong>{{ $tenant->name }}
                </li>
                <li>
                    <strong>CNPJ: </strong>{{ $tenant->cnpj }}
                </li>
                <li>
                    <strong>Email: </strong>{{ $tenant->email }}
                </li>
                <li>
                    <strong>URL: </strong>{{ $tenant->url }}
                </li>
                <li>
                    <strong>Ativa: </strong>{{ $tenant->active == 'Y' ? 'Sim' : 'Não' }}
                </li>
            </ul>

            <hr>

            <h3>Assinatura</h3>
            <ul>
                <li>
                    <strong>Data Assinatura: </strong>{{ $tenant->subscription }}
                </li>
                <li>
                    <strong>Dta Expiração: </strong>{{ $tenant->expires_at }}
                </li>
                <li>
                    <strong>Itendificador: </strong>{{ $tenant->subscription_id }}
                </li>
                <li>
                    <strong>Ativo: </strong>{{ $tenant->subscription_active == 'Y' ? 'Sim' : 'Não' }}
                </li>
                <li>
                    <strong>Cancelou? </strong>{{ $tenant->subscription_suspended == 'Y' ? 'Sim' : 'Não' }}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a Empresa {{ $tenant->name }}</button>
            </form>
        </div>
    </div>
@stop
