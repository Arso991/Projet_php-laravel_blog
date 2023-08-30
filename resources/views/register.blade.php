@extends("layout.master-registry")

@section("title", "Inscription")

@section('content')
                <form action="{{ route('storeUser') }}" method="POST" autocomplete="off">
                    @if (session("success"))
                        <div class="alert alert-secondary text-center" role="alert">
                            <strong>Message success</strong> <br>{{ session("success") }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Nom</label>
                        <input type="text" value="{{ old('lastname') }}" name="lastname" class="form-control" placeholder="Saisir votre Nom">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Prénom</label>
                        <input type="text" value="{{ old('firstname') }}" name="firstname" class="form-control" placeholder="Saisir votre prenom">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" value="{{ old('email') }}" name="email" class="form-control" placeholder="Saisir votre mail">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Date de naissance</label>
                        <input type="date" value="{{ old('birthday') }}" name="birthday" class="form-control" placeholder="Saisir votre date de naissance">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Saisir votre mot de passe">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirmez mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Enrégistrer</button>
                </form>
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Cliquez ici</a></p>
@stop