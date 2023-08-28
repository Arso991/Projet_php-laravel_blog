@extends("layout.master-registry")

@section("title", "Inscription")

@section('content')
                <form action="" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Nom</label>
                        <input type="text" name="email" class="form-control" placeholder="Saisir votre Nom">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Prénom</label>
                        <input type="text" name="email" class="form-control" placeholder="Saisir votre prenom">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Saisir votre mail">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Date de naissance</label>
                        <input type="date" name="email" class="form-control" placeholder="Saisir votre date de naissance">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Saisir votre mot de passe">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirmez mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Confirmez votre mot de passe">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Enrégistrer</button>
                </form>
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Cliquez ici</a></p>
@stop