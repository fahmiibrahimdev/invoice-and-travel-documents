<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }} &mdash; Aplikasi Invoice Dan Surat Jalan</title>

    <!-- General CSS Files -->
	<link rel="icon" href="http://sintesaniaga.com/assets/img/sintesa1.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}?_={{ rand(1000,2000) }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/fpro/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    @livewireStyles

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">
</head>

<body class="layout-3" style="font-family: Inter">
    
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
			{{-- Navbar Content --}}
				<nav class="navbar navbar-expand-lg main-navbar px-0">
					<a href="{{ url('dashboard') }}" class="navbar-brand sidebar-gone-hide">INVOICE</a>
					<a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars mt-4"></i></a>
					<ul class="navbar-nav navbar-right mt-3 lg:tw-mt-1 ml-auto">
						<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
								class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
							<div class="dropdown-menu dropdown-list dropdown-menu-right">
								<div class="dropdown-header">Notifications
									<div class="float-right">
										<a href="#">Mark All As Read</a>
									</div>
								</div>
								<div class="dropdown-list-content dropdown-list-icons">
									<a href="#" class="dropdown-item dropdown-item-unread">
										<div class="dropdown-item-icon bg-primary text-white">
											<i class="fas fa-code"></i>
										</div>
										<div class="dropdown-item-desc">
											Template update is available now!
											<div class="time text-primary">2 Min Ago</div>
										</div>
									</a>
									<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-info text-white">
											<i class="far fa-user"></i>
										</div>
										<div class="dropdown-item-desc">
											<b>You</b> and <b>Dedik Sugiharto</b> are now friends
											<div class="time">10 Hours Ago</div>
										</div>
									</a>
									<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-success text-white">
											<i class="fas fa-check"></i>
										</div>
										<div class="dropdown-item-desc">
											<b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
											<div class="time">12 Hours Ago</div>
										</div>
									</a>
									<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-danger text-white">
											<i class="fas fa-exclamation-triangle"></i>
										</div>
										<div class="dropdown-item-desc">
											Low disk space. Let's clean it!
											<div class="time">17 Hours Ago</div>
										</div>
									</a>
									<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-info text-white">
											<i class="fas fa-bell"></i>
										</div>
										<div class="dropdown-item-desc">
											Welcome to Stisla template!
											<div class="time">Yesterday</div>
										</div>
									</a>
								</div>
								<div class="dropdown-footer text-center">
									<a href="#">View All <i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</li>
						<li class="dropdown"><a href="#" data-toggle="dropdown"
								class="nav-link dropdown-toggle nav-link-lg nav-link-user">
								<div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-title">Logged in 5 min ago</div>
								<a href="#" class="dropdown-item has-icon">
									<i class="far fa-user"></i> Profile
								</a>
								<a href="#" class="dropdown-item has-icon">
									<i class="fas fa-bolt"></i> Activities
								</a>
								<a href="#" class="dropdown-item has-icon">
									<i class="fas fa-cog"></i> Settings
								</a>
								<div class="dropdown-divider"></div>
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<a href="{{ route('logout') }}" class="dropdown-item has-icon" onclick="event.preventDefault();
									this.closest('form').submit();">
										<i class="far fa-sign-out-alt"></i> Logout
									</a>
								</form>
							</div>
						</li>
					</ul>
				</nav>
			{{-- Navbar Content --}}

			{{-- Sidebar Content --}}
				<nav class="navbar navbar-secondary navbar-expand-lg">
					<div class="container">
						<ul class="navbar-nav">
							@if( Auth::user()->hasRole('admin') )
							{{-- Dashboard --}}
								<li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
									<a href="{{ url('dashboard') }}" class="nav-link"><i class="far fa-fire"></i><span>Dashboard</span></a>
								</li>
							{{-- Dashboard --}}

							{{-- Data Master --}}
								<li class="nav-item dropdown">
									<a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
										<i class="far fa-chalkboard"></i>
										<span>Data Master</span>
									</a>
									<ul class="dropdown-menu">

										{{-- Kelola User --}}
											<li class="nav-item">
												<a href="#" class="nav-link">{{ __('messages.manage.user') }}</a>
											</li>
										{{-- Kelola User --}}

										{{-- Barang --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">
													{{ __('messages.item.item') }}
												</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="{{ route('master-item') }}" class="nav-link">
															{{ __('messages.item.master') }}
														</a>
													</li>
													<li class="nav-item">
														<a href="{{ route('incoming-goods') }}" class="nav-link">
															{{ __('messages.item.incoming') }}
														</a>
													</li>
													<li class="nav-item">
														<a href="{{ route('stock-of-goods') }}" class="nav-link">
															{{ __('messages.item.stock') }}
														</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">
															{{ __('messages.item.tracking') }}
														</a>
													</li>
												</ul>
											</li>
										{{-- Barang --}}

										{{-- Data Project Non PO --}}
											<li class="nav-item">
												<a href="{{ route('pbo') }}" class="nav-link">Data Project Non PO</a>
											</li>
										{{-- Data Project Non PO --}}

										{{-- Quotation --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">Quotation</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="{{ route('no-quotation') }}" class="nav-link">Quotation</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">All Quotation</a>
													</li>
												</ul>
											</li>
										{{-- Quotation --}}
										
										{{-- Outstanding --}}
											<li class="nav-item">
												<a href="#" class="nav-link">Outstanding {{ __('messages.fabrication') }}</a>
											</li>
											<li class="nav-item">
												<a href="#" class="nav-link">Outstanding CS</a>
											</li>
											<li class="nav-item">
												<a href="#" class="nav-link">Outstanding GS</a>
											</li>
										{{-- Outstanding --}}
										
									</ul>
								</li>
							{{-- Data Master --}}
							
							
							{{-- Invoice & Surat Jalan --}}
								<li class="nav-item dropdown">
									<a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
										<i class="far fa-clone"></i>
										<span>{{ __('messages.iatd') }}</span>
									</a>
									<ul class="dropdown-menu">

										{{-- Fabrikasi --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">{{ __('messages.fabrication') }}</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.iatd') }}</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.manage.manage') }} BC</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.manage.manage') }} BAP</a>
													</li>
												</ul>
											</li>
										{{-- Fabrikasi --}}
										
										{{-- Cleaning Supply --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">Cleaning Supply</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.iatd') }}</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.manage.manage') }} BC</a>
													</li>
												</ul>
											</li>
										{{-- Cleaning Supply --}}

										{{-- General Supply --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">General Supply</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.iatd') }}</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">{{ __('messages.manage.manage') }} BC</a>
													</li>
												</ul>
											</li>
										{{-- General Supply --}}

									</ul>
								</li>
							{{-- Invoice & Surat Jalan --}}

							{{-- Riwayat & Laporan --}}
								<li class="nav-item dropdown">
									<a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
										<i class="far fa-folders"></i>
										<span>{{ __('messages.report.har') }}</span>
									</a>
									<ul class="dropdown-menu">

										{{-- Riwayat Outstanding --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">{{ __('messages.report.standing') }}</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="#" class="nav-link">Outstanding {{ __('messages.fabrication') }}</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">Outstanding Cleaning</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">Outstanding General</a>
													</li>
												</ul>
											</li>
										{{-- Riwayat Outstanding --}}

										{{-- Laporan Invoice --}}
											<li class="nav-item dropdown">
												<a href="#" class="nav-link has-dropdown">{{ __('messages.report.invoice') }}</a>
												<ul class="dropdown-menu">
													<li class="nav-item">
														<a href="#" class="nav-link">Invoice {{ __('messages.fabrication') }}</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">Invoice Cleaning Supply</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">Invoice General Supply</a>
													</li>
													<li class="nav-item">
														<a href="#" class="nav-link">All Invoice</a>
													</li>
												</ul>
											</li>
										{{-- Laporan Invoice --}}

										{{-- Laporan Harga Jual Beli --}}
											<li class="nav-item">
												<a href="#" class="nav-link">{{ __('messages.report.basp') }}</a>
											</li>
										{{-- Laporan Harga Jual Beli --}}

									</ul>
								</li>
							{{-- Riwayat & Laporan --}}
							@endif
						</ul>
					</div>
				</nav>
			{{-- Sidebar Content --}}

            <!-- Main Content -->
				<div class="main-content px-3">
					<section class="section custom-section">
						@yield('content')
					</section>
				</div>
			<!-- Main Content -->

			{{-- Footer Content --}}
				<footer class="main-footer">
					<div class="footer-left">
						Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Created By <a href="https://github.com/fahmiibrahimdev">Fahmi Ibrahim</a>
					</div>
					<div class="footer-right">
						1.0
					</div>
				</footer>
			{{-- Footer Content --}}
        </div>
    </div>

	{{-- Javascript Source --}}
		<!-- General JS Scripts -->
		<script src="{{ asset('/select2/jquery.min.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
		<script src="{{ asset('/assets/js/stisla.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<!-- JS Libraies -->
		<script src="{{ asset('/js/app.js') }}?_={{ rand(1000,2000) }}"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
		<script src="{{ asset('/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('/assets/js/scripts.js') }}"></script>

		@yield('js')
		<script>
			$(document).keydown(function (e) {
				if (e.keyCode == 112) {
					e.preventDefault()
					$('#tambahDataModal').modal('show')
				}
			});
			$(document).ready(function () {
				$('#dataTable').DataTable();
			});
		</script>
		@livewireScripts
		{{-- Livewire Scripts --}}
		<script>
			window.livewire.on("dataStore", () => {
				$("#tambahDataModal").modal("hide");
				$("#ubahDataModal").modal("hide");
			});
			window.addEventListener("swal", function () {
			Swal.fire({
					title: '{{ __('messages.alert.delete.title') }}',
					text: '{{ __('messages.alert.delete.notice') }}',
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: '{{ __('messages.alert.delete.confirm') }}',
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emit("deleteConfirmed");
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.delete.deleted') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
			window.addEventListener("swal:deleteChecked", function (event) {
				Swal.fire({
					title: '{{ __('messages.alert.delete.title') }}',
					text: '{{ __('messages.alert.delete.notice') }}',
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: '{{ __('messages.alert.delete.confirm') }}',
				}).then((result) => {
					if (result.isConfirmed) {
						window.livewire.emit("deleteCheckedData",event.detail.checkedIDs);
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.delete.deleted') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
			window.addEventListener("swal:modal", function () {
				Swal.fire({
					title: event.detail.message,
					html: event.detail.html,
					text: event.detail.text,
					icon: event.detail.type,
				});
			});
			window.addEventListener("swal:active", function () {
				Swal.fire({
					title: event.detail.message,
					html: event.detail.html,
					text: event.detail.text,
					icon: event.detail.type, // warning, success, alert
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: event.detail.confirmText,
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emit("activeConfirmed");
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.updated') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
			window.addEventListener("swal:unactive", function () {
				Swal.fire({
					title: event.detail.message,
					html: event.detail.html,
					text: event.detail.text,
					icon: event.detail.type, // warning, success, alert
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: event.detail.confirmText,
				}).then((result) => {
					if (result.isConfirmed) {
						livewire.emit("unactiveConfirmed");
						Swal.fire(
							'{{ __('messages.alert.success') }}',
							'{{ __('messages.alert.updated') }}',
							'{{ __('messages.alert.type') }}',
						);
					}
				});
			});
		</script>
		<script>
			window.onbeforeunload = function () {
				window.scrollTo(5,75);
			};
		</script>
		@stack('scripts')

		<!-- Template JS File -->
		<script src="{{ asset('/assets/js/custom.js') }}"></script>
	{{-- Javascript Source --}}
	
</body>

</html>
