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

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5 rounded">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0">
                        Kembali ke <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
