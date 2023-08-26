<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog-form</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <header>
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <div>
                    <a class="navbar-brand text-white bold" href="/">BLOG</a>
                </div>
                <form class="d-flex">
                    <input class="form-control me-3" type="search" placeholder="Rechercher un blog">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </form>
            </div>

        </nav>
    </header>

    <section class="container">
        @if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <h2 class="muted text-center mt-5">Vous pouvez ajouter votre article sur le blog des etudiants de l'ecole229</h2>
        <form method="POST" action="{{ route('blogStore') }}" class="p-3 mt-2" enctype="multipart/form-data">
            @csrf
            <input value="{{ old("title") }}" name="title" class="form-control mb-4" type="text" placeholder="Objet">
            <input name="picture" class="form-control mb-4" type="file" placeholder="Ajouter une image">
            <textarea name="content" class="form-control mb-4" name="" rows="8" placeholder="Description">{{ old("content") }}</textarea>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </section>

</body>

</html>