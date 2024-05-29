<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>App Title</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--  custom CSS -->

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/coins">Coins list</a>
        </nav>
    </header>

    <div class="container">
        @yield('content')
        @livewireScripts

    </div>
</body>

<footer>
    <div class="container">
        <p>&copy; 2024 App Name. All rights reserved.</p>
    </div>
</footer>

</html>

<style>
    footer {

            margin-top: 30px;
            width: 100%;
            background-color: #f8f9fa; /* Adjust background color as needed */
            text-align: center;
            padding: 10px 0; /* Adjust padding as needed */
        }
    </style>
