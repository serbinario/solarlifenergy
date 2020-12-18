<!DOCTYPE html>
<html lang="en">
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
					<li class="gui-folder">
						<a>
							<div class="gui-icon"><i class="md md-computer"></i></div>
							<span class="title">Controle</span>
						</a>
						<!--start submenu -->

						<ul>
							@role('super-admin|franquia|integrador')
							<li><a href="{{ route('cliente.cliente.index') }}" class="active"><span class="title">Clientes</span></a></li>
							<li><a href="{{ route('pre_proposta.pre_proposta.index') }}" class="active"><span class="title">Propostas</span></a></li>


								<li><a href="{{ route('pre_proposta.arquivadas.index') }}" class="active"><span class="title">Propostas Arquivadas</span></a></li>
								<li><a href="{{ route('projetov2.projetov2.index') }}" class="active"><span class="title">Projetos</span></a></li>
							@endrole

							@role('super-admin')
								<li><a href="{{ route('projetov2.arquivados.index') }}" class="active"><span class="title">Projetos Arquivados</span></a></li>
							@endrole

							@role('super-admin|franquia')

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Documentos</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="{{ route('procuracao.procuracao.index') }}" class="active"><span class="title">Procurações</span></a></li>
									<li><a href="{{ route('contrato.contrato.index') }}" class="active"><span class="title">Contratos</span></a></li>

								</ul><!--end /submenu -->

							</li><!--end /menu-li -->

							@endrole


							@role('super-admin|revenda')

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Pedido</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="{{ route('orcamento.index') }}" class="active"><span class="title">Orçamentos/Perso...</span></a></li>
									<li><a href="{{ route('pedido.index') }}" class="active"><span class="title">Pedidos</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->

							@endrole

							@role('super-admin')

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Estoque</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="{{ route('produto.index') }}" class="active"><span class="title">Produtos</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->
							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Parâmetros Sistema</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="{{ route('alert.index') }}" class="active"><span class="title">Alertas</span></a></li>
									<li><a href="{{ route('geral.edit') }}" class="active"><span class="title">Geral</span></a></li>
									<li><a href="{{ route('mao_obra.index') }}" class="active"><span class="title">Mão De Obra</span></a></li>
									<li><a href="{{ route('inversor_modulo.index') }}" class="active"><span class="title">Inversor/Modulos</span></a></li>
									<li><a href="{{ route('modulo.index') }}" class="active"><span class="title">Modulos</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Cadastro</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="{{ route('users.user.index') }}" class="active"><span class="title">Usuarios</span></a></li>
									@if(Auth::user()->franquia->franqueadora == 1)
										<li><a href="{{ route('franquia.franquia.index') }}" class="active"><span class="title">Franquias</span></a></li>
									@endif
									<li><a href="{{ '/parametro/' . Auth::user()->franquia->parametro->id . '/edit' }}" class="active"><span class="title">Parâmetros</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->
							@endrole

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Financeiro</span>
								</a>
								<!--start submenu -->
								@role('super-admin')
								<ul>
									<li><a href="{{ route('financeiro.index') }}" class="active"><span class="title">Lançamentos</span></a></li>
								</ul><!--end /submenu -->
								@endrole

							</li><!--end /menu-li -->

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Franquia</span>
								</a>
								<!--start submenu -->
								@role('super-admin|franquia')
								<ul>
									<li><a href="{{ '/franquia/' . Auth::user()->franquia->id . '/edit' }}" class="active"><span class="title">Dados Cadastrais</span></a></li>
								</ul><!--end /submenu -->
								@endrole

								@role('super-admin|advocacia|franquia')
								<ul>
									<li><a href="{{ route('documento.index') }}" class="active"><span class="title">Documentos</span></a></li>
								</ul><!--end /submenu -->
								@endrole
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



<!-- END JAVASCRIPT -->
@yield('javascript')
</body>
</html>
