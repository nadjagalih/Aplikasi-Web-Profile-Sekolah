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
                
                @if (session()->has('password-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('password-success') }}
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

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" id="username" class="form-control" name="username" value="{{ old('username') }}"
                            required autocomplete="username" autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ingat perangkat ini</label>
                        </div>
                        <a href="{{ route('password.reset-username') }}" class="text-decoration-none text-primary fw-bold">
                            Lupa Password?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5 rounded">Login</button>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0">Kembali Ke <a href="/" class="text-primary fw-bold">Home</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
