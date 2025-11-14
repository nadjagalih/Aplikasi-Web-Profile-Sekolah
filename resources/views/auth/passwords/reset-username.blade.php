@extends('layouts.app')

@section('auth')
    <div class="col-md-8 col-lg-6 col-xxl-4 mx-auto">
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <a href="/" class="d-block">
                        <img src="{{ asset('storage/' . $logo->logo) }}" width="180" alt="Logo">
                    </a>
                </div>

                <h4 class="text-center mb-4 fw-bold">Reset Password</h4>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.reset-username.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                               name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password Baru</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label fw-bold">Konfirmasi Password Baru</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5 rounded">Reset Password</button>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0">
                        Ingat password Anda? <a href="{{ route('login') }}" class="text-primary fw-bold">Kembali ke Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
