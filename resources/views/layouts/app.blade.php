<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Menarra Finance Dashboard Page" />
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap, Chart JS" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Rachma | @rachmadzii" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('assets')}}/css/styles.css" type="text/css" media="screen" />

    <!-- CDN Fontawesome -->
    <script src="https://kit.fontawesome.com/32f82e1dca.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset


    <!-- Main Content -->
    <main class="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div>
                    <button class="sidebarCollapseDefault btn p-0 border-0 d-none d-md-block"
                        aria-label="Hamburger Button">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <button data-bs-toggle="offcanvas" data-bs-target=".sidebar" aria-controls="sidebar"
                        aria-label="Hamburger Button" class="sidebarCollapseMobile btn p-0 border-0 d-block d-md-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
                <div class="d-flex align-items-center justify-content-end gap-4">
                    <input type="text" placeholder="Search report or product" class="search form-control" />
                    <button class="btn btn-search d-flex justify-content-center align-items-center p-0" type="button">
                        <img src="{{ asset('assets') }}/images/ic_search.svg" width="20px" height="20px" />
                    </button>
                    <img src="{{ asset('assets') }}/images/avatar.jpg" alt="Photo Profile" class="avatar" />
                </div>
            </div>
        </nav>
        {{ $slot }}
    </main>




    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="assets/js/donut_chart.js"></script>
    <script src="assets/js/line_chart.js"></script>

    <script>
        $(document).ready(function() {
            $('.sidebarCollapseDefault').on('click', function() {
                $('.sidebar').toggleClass('active');
                $('.content').toggleClass('active');
            });
        });
    </script>
</body>

</html>
