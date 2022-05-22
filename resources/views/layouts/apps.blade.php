<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }} &mdash; Aplikasi Invoice Dan Surat Jalan</title>

    <!-- General CSS Files -->
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

			{{-- Sidebar Content --}}
            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
						@if( Auth::user()->hasRole('admin') )

                        <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
                            <a href="{{ url('dashboard') }}" class="nav-link"><i class="far fa-fire"></i><span>Dashboard</span></a>
                        </li>

                        <li class="nav-item dropdown {{ (request()->is('kategori')) ? 'active' : '' }}">
                            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                                    class="far fa-chalkboard"></i><span>Data Master</span></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="{{ url('admin/customer') }}" class="nav-link">Customer</a></li>
                            </ul>
                        </li>

						<li class="nav-item dropdown">
							<a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
								<i class="far fa-clone"></i>
								<span>Multiple Dropdown</span>
							</a>
							<ul class="dropdown-menu">
								<li class="nav-item">
									<a href="#" class="nav-link">Not Dropdown Link</a>
								</li>
								<li class="nav-item dropdown">
									<a href="#" class="nav-link has-dropdown">Hover Me</a>
									<ul class="dropdown-menu">
										<li class="nav-item">
											<a href="#" class="nav-link">Link</a>
										</li>
										<li class="nav-item dropdown">
											<a href="#" class="nav-link has-dropdown">Link 2</a>
											<ul class="dropdown-menu">
												<li class="nav-item">
													<a href="#" class="nav-link">Link</a>
												</li>
												<li class="nav-item">
													<a href="#" class="nav-link">Link</a>
												</li>
												<li class="nav-item">
													<a href="#" class="nav-link">Link</a>
												</li>
											</ul>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">Link 3</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						@endif
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content px-3">
                <section class="section custom-section">
                    @yield('content')
                </section>
            </div>

			{{-- Footer Content --}}
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Created By <a href="https://github.com/fahmiibrahimdev">Fahmi Ibrahim</a>
                </div>
                <div class="footer-right">
                    1.0
                </div>
            </footer>
        </div>
    </div>

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
						"Success!", 
						"Data updated successfully", 
						"success"
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
						"Success!", 
						"Data updated successfully", 
						"success"
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
</body>

</html>
