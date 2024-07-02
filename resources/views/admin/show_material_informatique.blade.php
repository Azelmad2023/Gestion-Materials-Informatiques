{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Material Informatique</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($materialInformatiques as $materialInformatique)
                <tr>
                    <td>{{ $materialInformatique->type }}</td>
                    <td>{{ $materialInformatique->marque }}</td>
                    <td>{{ $materialInformatique->dateDacquisition }}</td>
                    <!-- Add more columns as needed -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> --}}


@extends('layouts.admindashboardLayouts')

@section('title', 'Material Informatique')
@section('header-title')
<h1 class="app-content-headerText">{{ $etablissementName->nomEtabllissemnt_FR }}</h1>
@endsection
@section('Scanoradd')
<a href="{{ route('admin.download_pdf', ['code_Gresa' => $etablissementName->code_Gresa]) }}">
    <button class="app-content-headerButton">Download PDF</button>
</a>
@endsection
@section('addNewMaterial')
<a href="{{ route('admin.add_material', ['etablissementId' => $etablissementName->code_Gresa]) }}">
    <button class="app-content-headerButton-add-material" >Add Material</button>
</a>
@endsection
@section('filter')
    <div class="app-content-actions">
        <div class="app-content-actions-wrapper">
            <button class="mode-switch" title="Switch Theme">
                <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                <defs></defs>
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
            </button>
            <div class="filter-button-wrapper">
                <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg></button>
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
                <button class="action-button list active" title="List View" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                </button>
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="products-area-wrapper">
    <div class="tableView">
        <div class="table-container">
            <table class="products-table">
                <thead class="products-header">
                    <tr>
                        <th class="product-cell communes">Num_Inv</th>
                        <th class="product-cell etablissments">type</th>
                        <th class="product-cell NumberOfMI">marque</th>
                        <th class="product-cell NumberOfMI">dateDacquisition</th>
                        <th class="product-cell detail">EF</th>
                        <th class="product-cell detail">etat</th>
                        <th class="product-cell actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materialInformatiques as $materialInformatique)
                            <tr class="products-row">
                                <td class="product-cell">
                                    <span>{{ $materialInformatique->Num_Inv }}</span>
                                </td>
                                <td class="product-cell">
                                    <span>{{ $materialInformatique->type }}</span>
                                </td>
                                <td class="product-cell">
                                    <span class="number ">{{ $materialInformatique->marque }}</span>
                                </td>
                                <td class="product-cell">
                                    <span class="number active">{{ $materialInformatique->dateDacquisition }}</span>
                                </td>
                                <td class="product-cell">
                                    <span class="number ">{{ $materialInformatique->EF }}</span>
                                </td>
                                <td class="product-cell">
                                    <span class="number disabled">{{ $materialInformatique->etat }}</span>
                                </td>
                                <td class="product-cell buttonsMaterials">
                                    {{-- <button class="editMaterial">Edit</button> --}}
                                    <a href="{{ route('material-informatique.edit', ['Num_Inv' => $materialInformatique->Num_Inv, 'code_Gresa' => $etablissementName->code_Gresa]) }}">
                                        <button class="editMaterial">Edit</button>
                                    </a>
                                    {{-- <a href=""><button class="deleteMaterial"  data-id="{{ $materialInformatique->id }}" onclick="deleteMaterial()">Delete</button></a> --}}
                                    <button class="deleteMaterial" onclick="deleteMaterial('{{ $materialInformatique->Num_Inv }}')">Delete</button>
                                </td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
function deleteMaterial(materialId) {
    console.log('Material ID:', materialId);
    if (confirm('Are you sure you want to delete this material informatique?')) {
        $.ajax({
            url: '/admin/material-informatique/' + materialId,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Error deleting material informatique. Please try again.');
            }
        });
    }
}
</script>
@endsection
