@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Cliente Webs</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('cliente_webs.cliente_web.create') }}" class="btn btn-success" title="Create New Cliente Web">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($clienteWebs) == 0)
            <div class="panel-body text-center">
                <h4>No Cliente Webs Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Cpf Cnpj</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Nome Empresa</th>
                            <th>Cep</th>
                            <th>Numero</th>
                            <th>Endereco</th>
                            <th>Complemento</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Is Whatsapp</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($clienteWebs as $clienteWeb)
                        <tr>
                            <td>{{ $clienteWeb->nome }}</td>
                            <td>{{ $clienteWeb->tipo }}</td>
                            <td>{{ $clienteWeb->cpf_cnpj }}</td>
                            <td>{{ $clienteWeb->celular }}</td>
                            <td>{{ $clienteWeb->email }}</td>
                            <td>{{ $clienteWeb->nome_empresa }}</td>
                            <td>{{ $clienteWeb->cep }}</td>
                            <td>{{ $clienteWeb->numero }}</td>
                            <td>{{ $clienteWeb->endereco }}</td>
                            <td>{{ $clienteWeb->complemento }}</td>
                            <td>{{ $clienteWeb->cidade }}</td>
                            <td>{{ $clienteWeb->estado }}</td>
                            <td>{{ ($clienteWeb->is_whatsapp) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('cliente_web', $clienteWeb->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('cliente_webs.cliente_web.show', $clienteWeb->id ) }}" class="btn btn-info" title="Show Cliente Web">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('cliente_webs.cliente_web.edit', $clienteWeb->id ) }}" class="btn btn-primary" title="Edit Cliente Web">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Cliente Web" onclick="return confirm(&quot;Click Ok to delete Cliente Web.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $clienteWebs->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection