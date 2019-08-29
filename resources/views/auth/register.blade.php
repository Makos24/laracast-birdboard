@extends('layouts.app')

@section('content')
<div class="container mx-auto lg:w-3/5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="text-2xl font-normal text-center py-2 text-grey-dark">{{ __('Register') }}</div>

                <div class=" px-6 pt-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="control-label">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="control .focus:outline-none .focus:shadow-outline @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="control .focus:outline-none .focus:shadow-outline @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="control-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="control .focus:outline-none .focus:shadow-outline @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="control .focus:outline-none .focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
