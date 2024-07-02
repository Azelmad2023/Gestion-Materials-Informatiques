@extends('layouts.admindashboardLayouts')

@section('title', 'Edit Etablissement')
@section('filter')
<div class="app-content-actions">
    <div class="app-content-actions-wrapper">
        <button class="mode-switch" title="Switch Theme">
            <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
            <defs></defs>
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
            </svg>
        </button>
    </div>
</div>
@endsection
@section('content')
<div class="scrollable-container">
    <div class="form-container">
        <form action="{{ route('update-etablissement-submit', $etablissement->code_Gresa) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" id="code_Gresa" name="code_Gresa" value="{{ $etablissement->code_Gresa }}">
            <div class="form-group">
                <label for="nomEtabllissemnt_FR">Nom Etablissement (French):</label>
                <input type="text" id="nomEtabllissemnt_FR" name="nomEtabllissemnt_FR" value="{{ $etablissement->nomEtabllissemnt_FR }}" required>
                @error('nomEtabllissemnt_FR')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="nomEtabllissemnt_AR">Nom Etablissement (Arabic):</label>
                <input type="text" id="nomEtabllissemnt_AR" name="nomEtabllissemnt_AR" value="{{ $etablissement->nomEtabllissemnt_AR }}" required>
                @error('nomEtabllissemnt_AR')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{ $etablissement->email }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="cycle">Cycle:</label>
                <input type="text" id="cycle" name="cycle" value="{{ $etablissement->cycle }}" required>
                @error('cycle')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" placeholder="Enter New Password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="code_Commune">Commune:</label>
                <select id="code_Commune" name="code_Commune">
                    @foreach($communes as $commune)
                        <option value="{{ $commune->code_Commune }}" {{ $etablissement->code_Commune == $commune->code_Commune ? 'selected' : '' }}>{{ $commune->nomcommune_FR }}</option>
                    @endforeach
                </select>
                @error('code_Commune')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/addwitheditematerial.css') }}">
@endsection
