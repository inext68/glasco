@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Accedi al Pannello GLASCO')

@section('auth_body')
    <form method="POST" action="{{ route('login') }}">
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

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        Ricordami
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Accedi</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    @if (Route::has('password.request'))
        <p class="mb-1">
            <a href="{{ route('password.request') }}">Hai dimenticato la password?</a>
        </p>
    @endif
    @if (Route::has('register'))
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Registra un nuovo account</a>
        </p>
    @endif
@endsection