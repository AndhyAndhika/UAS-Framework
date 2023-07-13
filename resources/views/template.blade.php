<!DOCTYPE html>
<html lang="en" class="notranslate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UAS - FRAMEWORK</title>
    <link href="/UI/CSS/styles.css" rel="stylesheet" />
    <link href="/UI/CSS/self-style.css" rel="stylesheet" />
    <script src="/UI/JS/fontawesomeV610.js"></script>
    <link href="/UI/CSS/datatables.css" rel="stylesheet" />
    <script src="/UI/JS/jquery363.js"></script>
    <script src="/UI/JS/jquerydatatables.js"></script>
    <link href="/UI/CSS/select2.css" rel="stylesheet" />
    <script src="/UI/JS/select2.js"></script>
</head>

<body class="sb-nav-fixed bg-digital">
    <nav class="sb-topnav navbar navbar-expand navbar-light" style="background-color: #E9E8E8;">
        <a href="{{ url('/') }}">
            <img src="/UI/IMG/logo-web-.png" width="185" height="40">
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <ul class="navbar-nav d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="card fs-4 fw-bold p-1" id="MyClockDisplay" onload="showTime()">
            </div>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light text-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="{{ url('/') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop fa-lg"></i></div>
                            Dashboard
                        </a>
                        <hr class="sidebar-divider my-1">
                        <a class="nav-link" href="{{ url('/customer') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group fa-lg"></i></div>
                            Customer
                        </a>
                        <hr class="sidebar-divider my-1">
                        <a class="nav-link" href="{{ url('/inventory') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked fa-lg"></i></div>
                            Inventory
                        </a>
                        <hr class="sidebar-divider my-1">
                        <a class="nav-link" href="{{ url('/transaction') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-handshake fa-lg"></i></div>
                            Transaction
                        </a>
                        <hr class="sidebar-divider my-1">
                        <a class="nav-link" href="{{ url('/delivery-order') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-fast fa-lg"></i></div>
                            Delivery Order
                        </a>
                        <hr class="sidebar-divider my-1">
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small ">Welcome, </div>
                    <span class="fw-bold">Andhika Nur Rohman </span>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content" class="">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                    {{-- SweetAlert2 --}}
                    @if (session()->has('berhasil_input'))
                         <?php toast('Record Successfully.','success')->autoClose(1000); ?>

                    @elseif(session()->has('gagal_input'))
                        <?php toast('Failed data Entry.', 'error')->autoClose(1000); ?>

                    @elseif(session()->has('gagal_validasi'))
                        <?php toast('Wrong Data Entry.','error')->autoClose(1000); ?>

                    @elseif(session()->has('Berhasil_edit'))
                        <?php toast('Changes Successfully', 'success')->autoClose(1000); ?>

                    @endif
                    {{-- MODAL --}}
                    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="page">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="/UI/JS/bootstrap523.js"></script>
    <script src="/UI/JS/scripts.js"></script>
    <script src="/UI/JS/moment.js"></script>
</body>

</html>
