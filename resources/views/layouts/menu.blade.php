<!DOCTYPE html>
<html lang="en">
<head>
	<title>SCE - SISTEMA DE CONSULTORIA ENERGÉTICA</title>

	<!-- BEGIN META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Enegia solar,energia, fotovoltaica">
	<meta name="description" content="SCE - SISTEMA DE CONSULTORIA ENERGÉTICA">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

	<!-- BEGIN STYLESHEETS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
	<link href="{{ asset('/assets/css/theme-default/bootstrap.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/materialadmin.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/material-design-iconic-font.min.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/DataTables/jquery.dataTables.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/multi-select/multi-select.css')}}" rel="stylesheet">

	<link href="{{ asset('/assets/css/theme-default/libs/select2/select2.css')}}" rel="stylesheet">

	<link href="{{ asset('/assets/css/theme-default/libs/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">

	<link href="{{ asset('/assets/css/theme-default/libs/sweetalert/sweetalert.css')}}" rel="stylesheet">
	<link href="{{ asset('/assets/css/theme-default/libs/toastr/toastr.css')}}" rel="stylesheet">
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
								<span class="text-lg text-bold text-primary">SOLAR LIFE ENERGY</span>
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
				<ul class="header-nav header-nav-profile">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
							{{--<img src="" alt="" />--}}
							<span class="profile-info">
									{{ Auth::user()->name }}
								@role('admin')
                                        <small>{{ isset(Auth::user()->franquia->nome) ? Auth::user()->franquia->nome : null }} - Adm</small>
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
				<div class="expanded">
					<a href="../../html/dashboards/dashboard.html">
						<span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
					</a>
				</div>
			</div>



			<div class="menubar-scroll-panel">



				<!-- BEGIN MAIN MENU -->
				<ul id="main-menu" class="gui-controls">

					<!-- BEGIN DASHBOARD -->
					<li>
						<a href="#" >
							<div class="gui-icon"><i class="md md-home"></i></div>
							<span class="title">Dashboard</span>
						</a>
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
							<li><a href="{{ route('cliente.cliente.index') }}" class="active"><span class="title">Clientes</span></a></li>
							<li><a href="{{ route('pre_proposta.pre_proposta.index') }}" class="active"><span class="title">Pré-Propostas</span></a></li>
							<li><a href="{{ route('projeto.projeto.index') }}" class="active"><span class="title">Projetos</span></a></li>

							@role('admin')

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Documentos</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="" class="active"><span class="title">Procurações</span></a></li>

								</ul><!--end /submenu -->
							</li><!--end /menu-li -->

							<li class="gui-folder">
								<a href="javascript:void(0);">
									<span class="title">Cadastro</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a href="{{ route('users.user.index') }}" class="active"><span class="title">Usuarios</span></a></li>
									<li><a href="{{ route('franquia.franquia.index') }}" class="active"><span class="title">Franquias</span></a></li>
									<li><a href="{{ '/parametro/' . Auth::user()->franquia->parametro->id . '/edit' }}" class="active"><span class="title">Parâmetros</span></a></li>
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->

							@endrole

						</ul><!--end /submenu -->
					</li><!--end /menu-li -->
					<!-- END FORMS -->


				</ul><!--end .main-menu -->
				<!-- END MAIN MENU -->

				<div class="menubar-foot-panel">
					<small class="no-linebreak hidden-folded">
						<span class="opacity-75">Copyright &copy; 2014</span> <strong>Serbinario</strong>
					</small>
				</div>
			</div><!--end .menubar-scroll-panel-->

		</div><!--end #menubar-->
		<!-- END MENUBAR -->
	@endif

</div><!--end #base-->
<!-- END BASE -->

<!-- BEGIN JAVASCRIPT -->

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
{{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" type="text/javascript"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" type="text/javascript"></script>--}}
{{--<script src="{{ asset('/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.js')}}" type="text/javascript"></script>--}}

<!-- Teste -->
<script src="{{ asset('/assets/js/libs/DataTables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
<!-- FIM Datatables -->

<script src="{{ asset('/assets/js/libs/multi-select/jquery.multi-select.js')}}" type="text/javascript"></script>

<script src="{{ asset('/assets/js/libs/select2/select2.js')}}" type="text/javascript"></script>

<script src="{{ asset('/assets/js/libs/jquery-knob/jquery.knob.min.js')}}" type="text/javascript"></script>





<script src="{{ asset('/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>

<script src="{{ asset('/assets/js/libs/sweetalert/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/libs/jquery-mask-plugin/dist/jquery.mask.js')}}" type="text/javascript"></script>
<script src="{{ asset('/js/ajaxError.js')}}" type="text/javascript"></script>

<!-- END JAVASCRIPT -->
@yield('javascript')
</body>
</html>
