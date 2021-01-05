
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  {{-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/modern-business.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-success fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, {{ auth()->user()->name }} {{ auth()->user()->last_name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                <a class="dropdown-item" href="{{ route('profile') }}">Akun</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link btn btn-warning" href="{{ route('login') }}">Login</a>
            </li>
            @endauth
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container col-md-8">

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Features Section -->
    <div class="row mb-3 mt-3">
        <div class="col-md-4">
            <img src="{{ asset('storage/'.$project->image) }}" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h3>{{ $project->name }}</h3>
            <p class="text-success">Rp. {{ number_format($project->price, 0, ',', '.') }}</p>
            <div class="row">
                <div class="col-md-4">Periode Kontrak</div>
                <div class="col-md-8 font-weight-bolder">{{ $project->periode }} Bulan</div>
            </div>
            <div class="row">
                <div class="col-md-4">Bagi Hasil</div>
                <div class="col-md-8 font-weight-bolder">{{ $project->profit }}% per Tahun</div>
            </div>
            <div class="row">
                <div class="col-md-4">Stock</div>
                <div class="col-md-8 font-weight-bolder">{{ $project->stock }}</div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-8 font-weight-bolder">
                    <form action="{{ route('project.beli', $project->id) }}" method="post"> @csrf
                        <button class="btn btn-success btn-sm px-5 py-2" type="submit">Beli</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col">
            <h3>Deskripsi Proyek</h3>
            <div class="text-secondary">
                {!! $project->description !!}
            </div>
        </div>
    </div>

  </div>
  <!-- /.container -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; {{ config('app.name', 'Laravel') }} 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
