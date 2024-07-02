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
        {{-- <a href="{{ route('admin.previous-page') }}"><button>Back</button></a> --}}
        <form action="{{ route('material-informatique.updateSubmit', $materialInformatique->Num_Inv) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="code_Gresa" value="{{ $etablissement->code_Gresa }}">
            <div class="form-group">
                <label for="Num_Inv">Num_Inv:</label>
                <input type="text" id="Num_Inv" name="Num_Inv" value="{{ $materialInformatique->Num_Inv }}">
                @error('Num_Inv')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="{{ $materialInformatique->type  }}" >
                @error('type')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="marque">Marque:</label>
                <input type="text" id="marque" name="marque" value="{{ $materialInformatique->marque }}" >
                @error('marque')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dateDacquisition">Date D'acquisition:</label>
                <input type="date" id="dateDacquisition" name="dateDacquisition" value="{{ $materialInformatique->dateDacquisition  }}" >
                @error('dateDacquisition')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="EF">EF:</label>
                <input type="date" id="EF" name="EF" value="{{ $materialInformatique->EF }}" >
                @error('EF')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="etat">Etat:</label>
                <input type="text" id="etat" name="etat" value="{{ $materialInformatique->etat }}" >
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
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/addwitheditematerial.css') }}">
@endsection
