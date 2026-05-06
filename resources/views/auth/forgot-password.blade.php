@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Recupero password GLASCO')

@section('auth_body')
    <p class="login-box-msg">Inserisci la tua email per ricevere il link di reset password.</p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Invia link reset</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p class="mb-0">
        <a href="{{ route('login') }}" class="text-center">Torna al login</a>
    </p>
@endsection