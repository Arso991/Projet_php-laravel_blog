<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <header>
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <div>
                    <a class="navbar-brand text-white bold" href="{{route('index')}}">BLOG</a>
                </div>
                <form class="d-flex">
                    <input class="form-control me-3" type="search" placeholder="Rechercher un blog">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </form>
            </div>

        </nav>
    </header>
    
    @yield("content")
</body>

</html>