@extends('layouts.admindashboardLayouts')
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
@section('addNewMaterial')
    <a href="{{ route('admin_add_etablissement_form') }}">
        <button class="app-content-headerButton-add-material">Add Etablissement</button>
    </a>
@endsection

@section('content')
<div class="products-area-wrapper">
    <div class="tableView">
        <div class="table-container">
            <table class="products-table">
                <thead class="products-header">
                    <tr>
                        <th class="product-cell">Code Gresa</th>
                        <th class="product-cell">Etablissement (French)</th>
                        <th class="product-cell">Email</th>
                        <th class="product-cell">Cycle</th>
                        <th class="product-cell">Code Commune</th>
                        <th class="product-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etablissements as $etablissement)
                        <tr class="products-row">
                            <td class="product-cell">{{ $etablissement->code_Gresa }}</td>
                            <td class="product-cell">{{ $etablissement->nomEtabllissemnt_FR }}</td>
                            <td class="product-cell">{{ $etablissement->email }}</td>
                            <td class="product-cell">{{ $etablissement->cycle }}</td>
                            <td class="product-cell">{{ $etablissement->code_Commune }}</td>
                            <td class="product-cell buttonsMaterials">
                                <a href="{{ route('etablissement-edit', ['code_Gresa' => $etablissement->code_Gresa]) }}">
                                    <button class="editMaterial">Edit</button>
                                </a>
                                <button class="deleteMaterial" onclick="deleteEtablissement('{{ $etablissement->code_Gresa }}')">Delete</button>
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
function deleteEtablissement(code_Gresa) {
    if (confirm('Are you sure you want to delete this Etablissement?')) {
        $.ajax({
            url: "{{ route('delete-etablissement.destroy_etablissement', ':code_Gresa') }}".replace(':code_Gresa', code_Gresa),
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Error deleting Etablissement. Please try again.');
            }
        });
    }
}
</script>
@endsection
