@extends("layout.master-registry")

@section("title", "Renouvellement de mot de passe")

@section('content')
<form action="{{ route('storePassword', ['email' => $email]) }}" method="POST" autocomplete="off">
    @if (session("verified"))
        <div class="alert alert-secondary text-center" role="alert">
            <strong>Message success</strong> <br>{{ session("verified") }}
        </div>
    @endif
    @csrf
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
                
@stop