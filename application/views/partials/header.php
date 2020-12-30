<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="<?php echo base_url();?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>UDC</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/main.css">
    <script src="assets/jquery_3.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="add">Add Person <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_mobile">Raw data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search_new">Search</a>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <a href="auth" class="btn btn-outline-success mx-2 my-sm-0"> auth page</a>
                    <a href="logout" class="btn btn-outline-success my-2 my-sm-0" >Log Out</a>
                </div>
            </div>
        </div>
    </nav>