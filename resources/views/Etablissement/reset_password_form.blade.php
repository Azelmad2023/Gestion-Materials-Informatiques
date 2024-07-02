@extends('layouts.adminauthLayouts')

@section('content')

    <form action="{{ route('etablissement_reset_password_submit') }}" method="post" class="mt-4">
        @csrf
        <label for="email"><b>Email</b></label>
        <input type="text" name="email" value="{{ $email }}" readonly>


        <label for="password"><b>New Password</b></label>
        <div class="password-input-container">
            <input type="password" id="password"  placeholder="Enter New Password" name="password">
        </div>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="password"><b>Confirm Password</b></label>
        <div class="password-input-container">
            <input type="password" id="password"  placeholder="Confirm New Password" name="password_confirmation">
        </div>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="hidden" name="token" value="{{ $token }}">

        <button type="submit">Reset Password</button>
    </form>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/loginForm.css') }}">
@endsection


