  <!-- Topbar Start -->
  <div class="container-fluid bg-dark px-5 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>62 Street, Ohioo,
                    ID</small>
                <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+62 345 6789</small>
                <small class="text-light"><i class="fa fa-envelope-open me-2"></i>prevents@gmail.com</small>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                        class="fab fa-twitter fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                        class="fab fa-facebook-f fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                        class="fab fa-linkedin-in fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i
                        class="fab fa-instagram fw-normal"></i></a>
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i
                        class="fab fa-youtube fw-normal"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

 <!-- Navbar & Hero Start -->
 <div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Prevents</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('event') }}" class="nav-item nav-link">Events</a>
                <a href="{{ route('index') }}" class="nav-item nav-link">Tickets</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">My Account</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('my.profile.edit') }}" class="dropdown-item">Profile</a>
                        <a href="{{ route('my.transactions') }}" class="dropdown-item">Transaction</a>
                        <a href="{{ route('my.receipts') }}" class="dropdown-item">Receipt</a>
                        <a href="{{ route('my.tickets') }}" class="dropdown-item">Tickets</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            @guest
                <a href="{{ route('register') }}"
                    class="btn btn-outline-primary rounded-pill py-2 px-4 me-2">Register</a>
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4">Login</a>
            @endguest

            @auth
                <!-- Authentication -->
                <form method="POST" class="border-0" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger rounded-pill py-2 px-4"><i class="icon ic-logout"></i>
                        Logout</button>
                </form>
            @endauth
        </div>
    </nav>
