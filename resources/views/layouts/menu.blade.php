<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>SCE - SISTEMA DE CONSULTORIA ENERGÉTICA</title>

	<!-- BEGIN META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Enegia solar,energia, fotovoltaica, SISTEMA DE CONSULTORIA ENERGÉTICA">
	<meta name="description" content="SCE - SISTEMA DE CONSULTORIA ENERGÉTICA">
	<link rel="shortcut icon" href="/images/icone-2-100x100.png" type="image/x-icon"/>

	<!-- BEGIN STYLESHEETS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
	<link href="{{ asset('/assets/css/theme-default/bootstrap.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/materialadmin.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/font-awesome.min.css')}}" rel="stylesheet">

	<link href="{{ asset('/assets/css/theme-default/material-design-iconic-font.min.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/DataTables/jquery.dataTables.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/bootstrap-multiselect/bootstrap-multiselect.css')}}" rel="stylesheet">

	<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' rel='stylesheet' type='text/css'>
	{{--<link href="{{ asset('/assets/css/theme-default/libs/select2/select2.css')}}" rel="stylesheet">--}}


	<link href="{{ asset('/assets/css/theme-default/libs/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">

	<link href="{{ asset('/assets/css/theme-default/libs/sweetalert/sweetalert.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/toastr/toastr.css')}}" rel="stylesheet">

	<link href="{{ asset('/assets/css/theme-default/libs/wizard/wizard.css')}}" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap_custon.css')}}" rel="stylesheet">

	<!-- END STYLESHEETS -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>

	<script src="{{ asset('/assets/js/libs/utils/html5shiv.js')}}" type="text/javascript"></script>
	<script src="{{ asset('/assets/js/libs/utils/respond.min.js')}}" type="text/javascript"></script>

	<![endif]-->

	@yield('css')
</head>
<body class="menubar-hoverable header-fixed menubar-pin ">
@if(Auth::check())

	<!-- BEGIN HEADER-->
	<header id="header" >
		<div class="headerbar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="headerbar-left">
				<ul class="header-nav header-nav-options">
					<li class="header-nav-brand" >
						<div class="brand-holder">
							<a href="../../html/dashboards/dashboard.html">
								<span class="text-lg color2 text-bold text-primary">SOLAR LIFE ENERGY</span>
							</a>
						</div>
					</li>
					<li>
						<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- DropDown Menu superior direito -->
			<div class="headerbar-right">
				<ul  class="header-nav header-nav-profile">
					<li id="alert-solar" class="dropdown hidden-sm">
						<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
							<i class="fa fa-bell"></i>
							<sup id="lert-count" class="badge style-danger"></sup>
						</a>
						<ul class="dropdown-menu dropdown-menu-solar animation-expand">

							<li><a href="#">Todoas as notificações <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
						</ul><!--end .dropdown-menu -->
					</li><!--end .dropdown -->
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
							{{--<img src="" alt="" />--}}
							<span class="profile-info">
									{{ Auth::user()->name }}
								@role('super-admin')
                                        <small>{{ isset(Auth::user()->franquia->nome) ? Auth::user()->franquia->nome : null }} - Super Adm</small>
								@else
									<small>{{ isset(Auth::user()->franquia->nome) ? Auth::user()->franquia->nome : null }} - Integrador</small>
									@endrole

							</span>
						</a>
						<ul class="dropdown-menu animation-dock">
							<li class="dropdown-header">Config</li>
							<li><a href="#">Meus Dados</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off text-danger"></i> Sair</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</ul><!--end .dropdown-menu -->
					</li><!--end .dropdown -->
				</ul><!--end .header-nav-profile -->

			</div><!--end #header-navbar-collapse -->
		</div>
	</header>
	<!-- END HEADER-->
@endif

<!-- BEGIN BASE-->
<div id="base">

	<!-- BEGIN OFFCANVAS LEFT -->
	<div class="offcanvas">
	</div><!--end .offcanvas-->
	<!-- END OFFCANVAS LEFT -->

	<!-- BEGIN CONTENT-->
	<div id="content">

		<!-- BEGIN BLANK SECTION -->
		<section>
			<div class="section-body contain-lg">

				@yield('content')


			</div><!--end .section-body -->
		</section>
		<!-- BEGIN BLANK SECTION -->


	</div><!--end #content-->
	<!-- END CONTENT -->
@if(Auth::check())
	<!-- BEGIN MENUBAR-->
		<div id="menubar" class="menubar-inverse ">
			<div class="menubar-fixed-panel">
				<div>
					<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
						<i class="fa fa-bars"></i>
					</a>
				</div>
			</div>



			<div class="menubar-scroll-panel">



				<!-- BEGIN MAIN MENU -->
				<ul id="main-menu" class="gui-controls">

					<!-- BEGIN DASHBOARD -->
					<li>
						@role('super-admin')
							<a href="{{ route('dashboard.index') }}" >
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Dashboard</span>
							</a>
						@endrole

					</li><!--end /menu-li -->
					<!-- END DASHBOARD -->


					<!-- BEGIN DASHBOARD -->
					<!-- END DASHBOARD -->


					<!-- BEGIN PAGES -->
					<li class="gui-folder expanded">
						<a>
							<div class="gui-icon"><i class="md md-computer"></i></div>
							<span class="title">Controle</span>
						</a>
						<!--start submenu -->

						<ul>
							@can('read.cliente')
							<li><a data-title="cliente" onclick="pop(this)"  href="{{ route('cliente.cliente.index') }}" ><span class="title">Clientes</span></a></li>
							@endcan

							@can('read.proposta')
							<li class="gui-folder">
								<a>
									<span class="title">Propostas</span>
								</a>
								<!--start submenu -->
								<ul>

									<li><a data-title="proposta" onclick="pop(this)" href="{{ route('pre_proposta.pre_proposta.index') }}" ><span  class="title title_sub">Propostas</span></a></li>
										<li><a  data-title="propostaArquivada" onclick="pop(this)"  href="{{ route('pre_proposta.arquivadas.index') }}" ><span class="title title_sub">Propostas Arquivadas</span></a></li>

										@if(Auth::user()->franquia->id == 14)
											<li> <a data-title="propostaExpansao" onclick="pop(this)" href="{{ route('proposta.expansao.index') }}" ><span class="title title_sub">Propostas Expansão</span></a></li>
										@endif

								</ul><!--end /submenu -->

							</li><!--end /menu-li -->
							@endcan

							@can('read.projeto')
							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Projetos</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a data-title="projetov2" onclick="pop(this)" href="{{ route('projetov2.projetov2.index') }}" ><span class="title">Projetos</span></a></li>

									@if(Auth::user()->franquia->id == 14)
										<li><a data-title="projetoAdicional" onclick="pop(this)"  href="{{ route('projetos.adicionais.index') }}" ><span class="title">Projetos Adiconais</span></a></li>
									@endif
									@role('super-admin')
									<li><a data-title="projetoArquivado" onclick="pop(this)"  href="{{ route('projetov2.arquivados.index') }}" ><span class="title">Projetos Arquivados</span></a></li>
									@endrole

								</ul><!--end /submenu -->
							</li><!--end /menu-li -->
							@endcan




							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Documentos</span>
								</a>
								<!--start submenu -->
								<ul>
									@can('read.procuracao')
									<li><a <a data-title="produracao" onclick="pop(this)"  href="{{ route('procuracao.procuracao.index') }}" ><span class="title">Procurações</span></a></li>
									@endcan
									@can('read.contrato')
									<li><a <a data-title="contratos" onclick="pop(this)"  href="{{ route('contrato.contrato.index') }}" ><span class="title">Contratos</span></a></li>
									@endcan

								</ul><!--end /submenu -->

							</li><!--end /menu-li -->






							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Logística</span>
								</a>
								<!--start submenu -->
								<ul>
									@can('read.log.entrega')
									<li><a data-title="solicitacaoEntregas" onclick="pop(this)"  href="{{ route('solicitacaoEntrega.index') }}" ><span class="title">Entregas</span></a></li>
									@endcan
									@can('read.vist.tecnica')
									<li><a data-title="visita_tecnica" onclick="pop(this)" href="{{ route('visita_tecnica.index') }}" ><span class="title">Visitas técnicas</span></a></li>
									@endcan
									@can('read.vist.tecnica')
									<li><a data-title="arquivadasIndex" onclick="pop(this)" href="{{ route('visita_tecnica.arquivadasIndex') }}" ><span class="title">Visitas Arquivadas</span></a></li>
									@endcan



								</ul><!--end /submenu -->

							</li><!--end /menu-li -->

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Execução</span>
								</a>
								<!--start submenu -->
								<ul>
									@can('read.os.instalacao')
									<li><a data-title="osInstalacao" onclick="pop(this)" href="{{ route('osInstalacao.index') }}" ><span class="title">O.S. - Instalação</span></a></li>
									@endcan
									@can('read.os.corretiva')
									<li><a  data-title="osCorretiva" onclick="pop(this)" href="{{ route('osCorretiva.index') }}" ><span class="title">O.S. - Corretiva</span></a></li>
									@endcan
									@can('read.os.preventiva')
									<li><a data-title="osPreventiva" onclick="pop(this)" href="{{ route('osPreventiva.index') }}" ><span class="title">O.S. - Preventiva</span></a></li>
									@endcan

								</ul><!--end /submenu -->

							</li>




							@role('super-admin|revenda')

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Pedido</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a  data-title="orcamento" onclick="pop(this)"  href="{{ route('orcamento.index') }}" ><span class="title">Orçamentos/Perso...</span></a></li>
									<li><a  data-title="pedido" onclick="pop(this)"  href="{{ route('pedido.index') }}" ><span class="title">Pedidos</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->
							@endrole

							@can('read.estoque')
							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Estoque</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a data-title="produto" onclick="pop(this)"  href="{{ route('produto.index') }}" ><span class="title">Produtos</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->
							@endcan

							@role('super-admin|revenda')
							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Parâmetros Sistema</span>
								</a>
								<!--start submenu -->
								<ul>

									<li><a data-title="alert" onclick="pop(this)" href="{{ route('alert.index') }}" ><span class="title">Alertas</span></a></li>
									<li><a data-title="geral" onclick="pop(this)" href="{{ route('geral.edit') }}" ><span class="title">Geral</span></a></li>
									<li><a data-title="mao_obra" onclick="pop(this)" href="{{ route('mao_obra.index') }}" ><span class="title">Mão de Obra</span></a></li>
									<li><a data-title="inversor_modulo" onclick="pop(this)" href="{{ route('inversor_modulo.index') }}" ><span class="title">Inversor/Modulos</span></a></li>
									<li><a data-title="modulo" onclick="pop(this)" href="{{ route('modulo.index') }}" ><span class="title">Modulos</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->

							@endrole

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Cadastro</span>
								</a>
								<!--start submenu -->
								<ul>
									@can('read.role')
									<li><a data-title="grupos" onclick="pop(this)" href="{{ route('roles.role.index') }}"><span class="title">Grupos</span></a></li>
									@endcan

									@can('read.user')
									<li><a data-title="users" onclick="pop(this)" href="{{ route('users.user.index') }}" ><span class="title">Usuarios</span></a></li>
									@endcan

									@if(Auth::user()->franquia->id == 14)
										<li><a data-title="franquia" onclick="pop(this)" href="{{ route('franquia.franquia.index') }}" ><span class="title">Franquias</span></a></li>
									@endif
									@can('update.paramteros')
									<li><a data-title="parametro" onclick="pop(this)" href="{{ '/parametro/' . Auth::user()->franquia->parametro->id . '/edit' }}" ><span class="title">Parâmetros</span></a></li>
									@endcan
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->


							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Financeiro</span>
								</a>
								<!--start submenu -->
								@role('super-admin')
								<ul>
									<li><a href="{{ route('financeiro.index') }}" ><span class="title">Lançamentos</span></a></li>
								</ul><!--end /submenu -->
								@endrole

							</li><!--end /menu-li -->

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Franquia</span>
								</a>
								<!--start submenu -->
								@can('update.franquia.dados.cadastrais')
								<ul>
									<li><a data-title="franquia2" onclick="pop(this)" href="{{ '/franquia/' . Auth::user()->franquia->id . '/edit' }}" ><span class="title">Dados Cadastrais</span></a></li>
								</ul><!--end /submenu -->
								@endcan

								@can('update.franquia.documentos')
								<ul>
									<li><a data-title="documento" onclick="pop(this)" href="{{ route('documento.index') }}" ><span class="title">Documentos</span></a></li>
								</ul><!--end /submenu -->
								@endcan

							</li><!--end /menu-li -->


						</ul><!--end /submenu -->
					</li><!--end /menu-li -->
					<!-- END FORMS -->


				</ul><!--end .main-menu -->
				<!-- END MAIN MENU -->

			</div><!--end .menubar-scroll-panel-->

		</div><!--end #menubar-->
		<!-- END MENUBAR -->
	@endif

</div><!--end #base-->
<!-- END BASE -->

<!-- BEGIN JAVASCRIPT -->

@include('alert.modalAlert')

<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
{{--<script src="{{ asset('/assets/js/libs/jquery/jquery-1.11.2.min.js')}}" type="text/javascript"></script>--}}
<script src="{{ asset('/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>


<script src="{{ asset('/assets/js/libs/spin.js/spin.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/autosize/jquery.autosize.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/App.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppNavigation.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppOffcanvas.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppCard.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppForm.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppNavSearch.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppVendor.js')}}" type="text/javascript"></script>


<script src="{{ asset('/assets/js/libs/toastr/toastr.js')}}" type="text/javascript"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
{{--<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" type="text/javascript"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" type="text/javascript"></script>--}}
{{--<script src="{{ asset('/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.js')}}" type="text/javascript"></script>--}}

<!-- Teste -->
{{--<script src="{{ asset('/assets/js/libs/DataTables/jquery.dataTables.min.js')}}" type="text/javascript"></script>--}}
<script src="{{ asset('/assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>

<script src='https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js'></script>
<!-- FIM Datatables -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" type="text/javascript"></script>


<script src="{{ asset('/assets/js/libs/wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>

<script src="{{ asset('/assets/js/libs/bootstrap-multiselect/bootstrap-multiselect.js')}}" type="text/javascript"></script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>
{{--<script src="{{ asset('/assets/js/libs/select2/select2.js')}}" type="text/javascript"></script>--}}

<script src="{{ asset('/assets/js/libs/jquery-knob/jquery.knob.min.js')}}" type="text/javascript"></script>

<script src="{{ asset('/js/alert/header.js')}}" type="text/javascript"></script>


<script src="{{ asset('/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>


<script src="{{ asset('/assets/js/libs/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/jquery-mask-plugin/dist/jquery.mask.js')}}" type="text/javascript"></script>
<script src="{{ asset('/js/ajaxError.js')}}" type="text/javascript"></script>
<script src="{{ asset('/js/menu.js')}}" type="text/javascript"></script>



<!-- END JAVASCRIPT -->
@yield('javascript')


</body>
</html>
