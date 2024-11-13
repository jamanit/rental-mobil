@extends('layouts.app-auth')

@push('title')
    Masuk
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary mt-5 radius-10" style="opacity: 0.8;">
                        <div class="card-header">
                            <a href="{{ url('/') }}">
                                <img src="{{ Storage::url($business_profile->logo) }}" alt="logo" width="50" class="rounded">
                            </a>
                            <h3 class="ml-auto">Masuk</h3>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror" tabindex="1" autofocus>
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
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="password" value="" placeholder="Password" class="form-control @error('password') is-invalid @enderror" tabindex="2">
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
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Masuk
                                    </button>
                                </div>
                            </form>

                        </div>
                        <div class="mb-4 text-muted text-center">
                            Belum punya akun? <a href="{{ url('register') }}">registrasi</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
