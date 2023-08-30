@extends("layout.master-registry")

@section("title", "Authentification")

@section('content')
                <form action="{{ route('authentification') }}" method="POST" autocomplete="off">
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

                    @if (session("error"))
                        <div class="alert alert-danger text-center" role="alert">
                            <strong>Message success</strong> <br>{{ session("error") }}
                        </div>
                    @endif

                    @if (session("verified"))
                        <div class="alert alert-secondary text-center" role="alert">
                            <strong>Message success</strong> <br>{{ session("verified") }}
                        </div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Saisir votre email">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Saisir votre email">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Connexion</button>
                </form>
                <p>Vous n'avez pas un compte ? <a href="{{ route('register') }}">Cliquez ici</a></p>
                <p>Mot de passe oublié ? <a href="{{ route('recovery') }}">Cliquez ici</a></p>
@stop