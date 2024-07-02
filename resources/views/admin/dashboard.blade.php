@extends('layouts.admindashboardLayouts')

@section('title', 'All Etablissemnts && Communes')

@section('header-title')
<h1 class="app-content-headerText">Etablissements</h1>
@endsection

@section('content')
@section('filter')
<div class="app-content-actions">
    <!-- <input class="search-bar" placeholder="Search..." type="text"> -->
    <div class="app-content-actions-wrapper">
        <button class="mode-switch" title="Switch Theme">
            <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                <defs></defs>
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
            </svg>
        </button>
        <div class="filter-button-wrapper">
            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                </svg></button>
            <div class="filter-menu">
                <label>Communes</label>
                <select id="communesSelect">
                    <option value="">Select Commune</option>
                    @foreach($communes as $commune)
                    <option value="{{ $commune->code_Commune }}">{{ $commune->nomcommune_FR }}</option>
                    @endforeach
                </select>
                <label>Etablissements</label>
                <select id="etablissementsSelect">
                    <option value="">Select Etablissement</option>
                </select>
                <div class="filter-menu-buttons">
                    <button class="filter-button apply">
                        Search
                    </button>
                </div>
            </div>
        </div>
        <a href="{{ route('admin_dashboard') }}">
            <button class="action-button list active" title="List View">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                    <line x1="8" y1="6" x2="21" y2="6" />
                    <line x1="8" y1="12" x2="21" y2="12" />
                    <line x1="8" y1="18" x2="21" y2="18" />
                    <line x1="3" y1="6" x2="3.01" y2="6" />
                    <line x1="3" y1="12" x2="3.01" y2="12" />
                    <line x1="3" y1="18" x2="3.01" y2="18" />
                </svg>
            </button>
        </a>
    </div>
</div>
@endsection
<div class="products-area-wrapper">
    <div class="tableView">
        <div class="table-container">
            <table class="products-table">
                <thead class="products-header">
                    <tr>
                        <th class="product-cell communes">Communes</th>
                        <th class="product-cell etablissments">Etablissments</th>
                        <th class="product-cell NumberOfMI">Number Of MI</th>
                        <th class="product-cell detail">Cycle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($communes as $commune)
                    @foreach($commune->etablissements as $etablissement)
                    <tr class="products-row">
                        <td class="product-cell">
                            <span>{{ $commune->nomcommune_FR }}</span>
                        </td>
                        <td class="product-cell">
                            <span>{{ $etablissement->nomEtabllissemnt_FR }}</span>
                        </td>
                        <td class="product-cell">
                            <span class="number active">{{ $etablissement->materialInformatiques->count() }}</span>
                        </td>
                        <td class="product-cell view-button">
                            <span>{{ $etablissement->cycle }}</span>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</div>
@endsection