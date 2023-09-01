<div class="container">
    @if (session("message"))
    <div class="alert alert-secondary text-center" role="alert">
        <strong>Message success</strong> <br> Enregistrement avec succès
    </div>
    @endif

    <h2>Liste des blogs  @if(isset($nom)) de {{$nom}} @endif </h2>
    <p class="lead text-muted">
        Il s'agit de la page qui permettra d'explorer les contours de laravel avec les étudiants!
    </p>
    <a href="{{ route('index') }}" class="btn btn-warning" type="button">Mes blogs</a>
    <a href="{{ route('createBlog') }}" class="btn btn-primary" type="button">Ajouter un article</a>
    <a href="{{ route('all') }}" class="btn btn-success" type="button">Tous les blogs</a>
</div>