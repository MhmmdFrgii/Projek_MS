<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/app.css')

     <!-- Other head elements -->
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

     {{-- font awesome --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="leading-normal tracking-normal text-indigo-400 bg-cover bg-fixed" style="background-image: url('/assets/images/header.png')">

    {{-- navbar --}}
    <div class="mb-5">
    @include('layouts.nav')
    </div>

    {{-- content --}}
    <div class="container">
        @yield('content')
    </div>

    <!--Footer-->
    <div class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in">
        <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; App 2024</a>
        - website by
        <a class="text-gray-500 no-underline hover:no-underline" href="#">majanemensekolah.com</a>
      </div>

    <!-- Your body content -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (@json($errors->any())) {
            let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                keyboard: false
            });
            myModal.show();
        }
    });
</script>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.add('fade-out');
                setTimeout(function() {
                    alert.remove();
                }, 500); // matches the CSS animation duration
            }
        }, 3000); // 3 seconds before starting to fade out
    });
</script>
<style>
    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>

