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

@section('content')
<div class="scrollable-container">
    <div class="form-container">
        <h1 class="app-content-headerText">{{ $etablissement->nomEtabllissemnt_FR }}</h1>
        <!-- Form to add new material informatique -->
        <form action="{{ route('admin.add_material.submit') }}" method="post">
            @csrf
            <input type="hidden" name="etablissement_id" value="{{ $etablissement->code_Gresa }}">
            <div class="form-group">
                <label for="Num_Inv">Num_Inv:</label>
                <input type="text" id="Num_Inv" name="Num_Inv" value="{{ old('Num_Inv') }}" >
                @error('Num_Inv')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="{{ old('type') }}" >
                @error('type')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="marque">Marque:</label>
                <input type="text" id="marque" name="marque" value="{{ old('marque') }}" >
                @error('marque')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dateDacquisition">Date D'acquisition:</label>
                <input type="date" id="dateDacquisition" name="dateDacquisition" value="{{ old('dateDacquisition') }}" >
                @error('dateDacquisition')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="EF">EF:</label>
                <input type="date" id="EF" name="EF" value="{{ old('EF') }}" >
                @error('EF')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="etat">Etat:</label>
                <input type="text" id="etat" name="etat" value="{{ old('etat') }}" >
                @error('etat')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <!-- Add more input fields for other material informatique properties -->
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</div>
@endsection
    {{-- <style>
            .form-container {
            background-color: var(--app-bg);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-container .app-content-headerText {
            color: var(--app-content-main-color);
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: var(--app-content-main-color);
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: var(--app-content-secondary-color);
            color: var(--app-content-main-color);
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="date"]:focus {
            outline: none;
            box-shadow: 0 0 5px var(--action-color);
        }

        .submit-button {
            background-color: var(--action-color);
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: var(--action-color-hover);
        }
        .error {
                    color: #8b0000;
                    font-size: 12px;
                }
    </style> --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/addwitheditematerial.css') }}">
@endsection

