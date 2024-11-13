@extends('layouts.app-auth')

@push('title')
    Verify Your Email Address
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card card-primary mt-5 radius-10" style="opacity: 0.8;">
                        <div class="card-header">
                            <a href="{{ url('/') }}">
                                <img src="{{ Storage::url($business_profile->logo) }}" alt="logo" width="50" class="rounded">
                            </a>
                            <h3 class="ml-auto">{{ __('Verify Your Email Address') }}</h3>
                        </div>
                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
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
    <script>
        $(document).ready(function() {
            function checkEmailVerification() {
                $.get('/email/check-email-verified', function(response) {
                    if (response.verified) {
                        window.location.href = '/dashboard';
                    }
                }).fail(function() {
                    console.log('User not authenticated');
                });
            }

            checkEmailVerification();

            setInterval(checkEmailVerification, 5000);
        });
    </script>
@endpush
