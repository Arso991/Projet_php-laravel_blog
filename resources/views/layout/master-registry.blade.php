<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>@yield("title")</title>
</head>
<body class="container position-absolute top-50 start-50 translate-middle">
    @if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="width: 600px" class="card border-primary position-absolute top-50 start-50 translate-middle">
        <div>
            <div class="card-header text-center bg-primary text-white">
                <h2>@yield("title")</h2>
            </div>
            <div class="card-body">
                            
                @yield("content")
    
            </div>
        </div>
    </div>
</body>
</html>