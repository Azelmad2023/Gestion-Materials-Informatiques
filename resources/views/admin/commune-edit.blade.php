@extends('layouts.admindashboardLayouts')

@section('title', 'Add Material Informatique')
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

@extends('layouts.admindashboardLayouts')

@section('title', 'Edit Commune')

@section('content')
<div class="scrollable-container">
    <div class="form-container">
        <form action="{{ route('update-commune-submit', $commune->code_Commune) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" id="code_Commune" name="code_Commune" value="{{ $commune->code_Commune }}">

            <div class="form-group">
                <label for="code_Commune">Code Commune:</label>
                <input type="text" id="code_Commune" name="code_Commune" value="{{ $commune->code_Commune }}">
            </div>

            <div class="form-group">
                <label for="nomcommune_FR">Nom Commune (Français):</label>
                <input type="text" id="nomcommune_FR" name="nomcommune_FR" value="{{ $commune->nomcommune_FR }}">
                @error('nomcommune_FR')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomcommune_AR">Nom Commune (Arabe):</label>
                <input type="text" id="nomcommune_AR" name="nomcommune_AR" value="{{ $commune->nomcommune_AR }}">
                @error('nomcommune_AR')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="code_Milieu">Code Milieu:</label>
                <input type="text" id="code_Milieu" name="code_Milieu" value="{{ $commune->code_Milieu }}">
                @error('code_Milieu')
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

