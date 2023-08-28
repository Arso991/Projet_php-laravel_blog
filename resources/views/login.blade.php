@extends("layout.master-registry")

@section("title", "Authentification")

@section('content')
                <form action="" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Saisir votre email">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mot de passe</label>
                        <input type="text" name="password" class="form-control" placeholder="Saisir votre email">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Connexion</button>
                </form>
                <p>Vous n'avez pas un compte ? <a href="{{ route('register') }}">Cliquez ici</a></p>
@stop