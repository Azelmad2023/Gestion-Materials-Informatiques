@extends('layouts.admindashboardLayouts')
@section('addNewMaterial')
    <a href="{{ route('admin_add_commune_form') }}">
        <button class="app-content-headerButton-add-material" >Add Commune</button>
    </a>
    <thead class="products-header">

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
                        <th class="product-cell communes">Code Commune</th>
                        <th class="product-cell code-Milieu">Code Milieu</th>
                        <th class="product-cell communes">Francais</th>
                        <th class="product-cell communes">Arabic</th>
                        <th class="product-cell actions">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($communes as $commune)
                        <tr class="products-row">
                            <td class="product-cell">
                                <span>{{ $commune->code_Commune }}</span>
                            </td>
                            <td class="product-cell">
                                <span>{{ $commune->code_Milieu }}</span>
                            </td>
                            <td class="product-cell">
                                <span>{{ $commune->nomcommune_FR }}</span>
                            </td>
                            <td class="product-cell">
                                <span>{{ $commune->nomcommune_AR }}</span>
                            </td>
                            <td class="product-cell buttonsMaterials">
                                {{-- <button class="editMaterial">Edit</button> --}}
                                <a href="{{ route('commune-edit',['code_Commune' => $commune->code_Commune]) }}">
                                    <button class="editMaterial">Edit</button>
                                </a>
                                {{-- <a href=""><button class="deleteMaterial"  data-id="{{ $materialInformatique->id }}" onclick="deleteMaterial()">Delete</button></a> --}}
                                <button class="deleteMaterial" onclick="deleteCommune('{{ $commune->code_Commune }}')">Delete</button>
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
    function deleteCommune(code_Commune) {
    if (confirm('Are you sure you want to delete this Commune?')) {
        $.ajax({
            url: "{{ route('delete-commune.destroyCommune', ':id') }}".replace(':id', code_Commune),
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
