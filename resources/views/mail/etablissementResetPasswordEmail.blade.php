@extends('layouts.adminauthLayouts')

@section('content')
<div class="container">
    <div class="header">
        <h1>Password Reset</h1>
    </div>
    <div class="body">
        <p>Hello there!</p>
        <p>We've received a request to reset your password. To proceed, click the button below:</p>
        <a href="{{ route('etablissement_password_reset', ['token' => $token]) }}" class="reset-link">Reset Password</a>
        <p class="note">If you didn't request a password reset, you can safely ignore this email.</p>
    </div>
    <div class="footer">
        <p class="signature">Best regards</p>
    </div>
</div>
@endsection

@section('css')
<style>
    .container {
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 500px;
        margin: auto;
        text-align: center;
    }

    .header h1 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .body p {
        color: #666;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .reset-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .reset-link:hover {
        background-color: #0056b3;
    }

    .note {
        color: #999;
        font-size: 14px;
    }

    .signature {
        font-style: italic;
        color: #999;
        margin-top: 40px;
    }
</style>
@endsection
