@extends("layout.master-registry")

@section("title", "Récupération de compte")

@section('content')
                <form action="{{ route('change') }}" method="POST" autocomplete="off">
                    @if (session("success"))
                        <div class="alert alert-secondary text-center" role="alert">
                            <strong>Message success</strong> <br>{{ session("success") }}
                        </div>
                    @endif

                    @if (session("validate"))
                        <div class="alert alert-secondary text-center" role="alert">
                            <strong>Message success</strong> <br>{{ session("validate") }}
                        </div>
                    @endif

                    @if (session("error"))
                        <div class="alert alert-danger text-center" role="alert">
                            <strong>Message erreur</strong> <br>{{ session("error") }}
                        </div>
                    @endif

                    @if (session("failed"))
                        <div class="alert alert-danger text-center" role="alert">
                            <strong>Message failed</strong> <br>{{ session("failed") }}
                        </div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" value="{{ old('email') }}" name="email" class="form-control" placeholder="Saisir votre mail">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Envoyer</button>
                </form>
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Cliquez ici</a></p>
@stop