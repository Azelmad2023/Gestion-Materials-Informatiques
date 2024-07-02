@extends('layouts.adminauthLayouts')

@section('title', 'Admin LogIn Form')

@section('content')
<form action="{{ route('admin_login_submit') }}" method="post" class="mt-4">
    @csrf

    @session('error_ware')
    <div class="alert alert-danger">
        {{ $value }}
    </div>
    @endsession
    @session('error')
    <div class="alert alert-danger">
        {{ $value }}
    </div>
    @endsession

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}">
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="password"><b>Password</b></label>
    <div class="password-input-container">
        <input type="password" id="password"  placeholder="Enter Password" name="password">
        <i class="fas fa-eye" id="togglePassword" ></i> <!-- Eye icon -->
    </div>
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit">Login</button>
    {{-- <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> --}}
    <div class="mt-3">
        <span class="psw float-end forgot-password "> <a href="{{ route('admin_forget_password') }}"> Forgot password?</a></span>
        {{-- <span class="psw float-end">Forgot <a href="{{ route('admin.password.request') }}">password?</a></span> --}}
    </div>
</form>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/loginForm.css') }}">
@endsection
@section('fontawesomeLink')
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
@endsection

@section('js')
            {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script> --}}
            <script src="{{ asset('js/admin.js') }}"></script>
@endsection
