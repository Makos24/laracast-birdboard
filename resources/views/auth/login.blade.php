@extends('layouts.app')

@section('content')
<div class="container mx-auto lg:w-2/5 lg:pt-20">
            <div class="card">
                <h3 class="text-2xl font-normal text-center py-2 text-grey-dark">{{ __('Login') }}</h3>

                <div class="px-8 pt-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>

                            <div class="mb-4">
                                <input id="email" type="email" class="control focus:outline-none focus:shadow-outline @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="error mt-4" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="control-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="control focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="flex items-end mb-2">
                                    <input class="m-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="control-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                            <div class="flex justify-between">
                                <button type="submit" class="button">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="no-underline font-normal" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
</div>
@endsection
