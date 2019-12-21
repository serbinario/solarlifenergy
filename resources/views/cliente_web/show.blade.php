@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Cliente Web' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cliente_webs.cliente_web.destroy', $clienteWeb->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('cliente_web') }}" class="btn btn-primary" title="Show All Cliente Web">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('cliente_webs.cliente_web.create') }}" class="btn btn-success" title="Create New Cliente Web">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('cliente_webs.cliente_web.edit', $clienteWeb->id ) }}" class="btn btn-primary" title="Edit Cliente Web">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Cliente Web" onclick="return confirm(&quot;Click Ok to delete Cliente Web.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Nome</dt>
            <dd>{{ $clienteWeb->nome }}</dd>
            <dt>Tipo</dt>
            <dd>{{ $clienteWeb->tipo }}</dd>
            <dt>Cpf Cnpj</dt>
            <dd>{{ $clienteWeb->cpf_cnpj }}</dd>
            <dt>Celular</dt>
            <dd>{{ $clienteWeb->celular }}</dd>
            <dt>Email</dt>
            <dd>{{ $clienteWeb->email }}</dd>
            <dt>Nome Empresa</dt>
            <dd>{{ $clienteWeb->nome_empresa }}</dd>
            <dt>Cep</dt>
            <dd>{{ $clienteWeb->cep }}</dd>
            <dt>Numero</dt>
            <dd>{{ $clienteWeb->numero }}</dd>
            <dt>Endereco</dt>
            <dd>{{ $clienteWeb->endereco }}</dd>
            <dt>Complemento</dt>
            <dd>{{ $clienteWeb->complemento }}</dd>
            <dt>Cidade</dt>
            <dd>{{ $clienteWeb->cidade }}</dd>
            <dt>Estado</dt>
            <dd>{{ $clienteWeb->estado }}</dd>
            <dt>Is Whatsapp</dt>
            <dd>{{ ($clienteWeb->is_whatsapp) ? 'Yes' : 'No' }}</dd>
            <dt>Obs</dt>
            <dd>{{ $clienteWeb->obs }}</dd>
            <dt>Created At</dt>
            <dd>{{ $clienteWeb->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $clienteWeb->updated_at }}</dd>
            <dt>Mae</dt>
            <dd>{{ $clienteWeb->mae }}</dd>
            <dt>Pai</dt>
            <dd>{{ $clienteWeb->pai }}</dd>
            <dt>Conjugue</dt>
            <dd>{{ $clienteWeb->conjugue }}</dd>
            <dt>Conjugue Cpf</dt>
            <dd>{{ $clienteWeb->conjugue_cpf }}</dd>
            <dt>Rg</dt>
            <dd>{{ $clienteWeb->rg }}</dd>
            <dt>Data Emissao Rg</dt>
            <dd>{{ $clienteWeb->data_emissao_rg }}</dd>
            <dt>Orgao Emissor Rg</dt>
            <dd>{{ $clienteWeb->orgao_emissor_rg }}</dd>
            <dt>Naturalidade Uf</dt>
            <dd>{{ $clienteWeb->naturalidade_uf }}</dd>
            <dt>Naturalidade Cidade</dt>
            <dd>{{ $clienteWeb->naturalidade_cidade }}</dd>
            <dt>Data Nascimento</dt>
            <dd>{{ $clienteWeb->data_nascimento }}</dd>

        </dl>

    </div>
</div>

@endsection