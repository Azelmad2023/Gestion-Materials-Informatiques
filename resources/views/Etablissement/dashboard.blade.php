<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etablissement Dashboard</title>
</head>
<style>
:root {
            --app-bg: #101827;
            --sidebar: rgba(21, 30, 47, 1);
            --sidebar-main-color: #fff;
            --table-border: #1a2131;
            --table-header: #1a2131;
            --app-content-main-color: #fff;
            --sidebar-link: #fff;
            --sidebar-active-link: #1d283c;
            --sidebar-hover-link: #1a2539;
            --action-color: #2869ff;
            --action-color-hover: #6291fd;
            --app-content-secondary-color: #1d283c;
            --filter-reset: #2c394f;
            --filter-shadow: rgba(16, 24, 39, 0.8) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        /* Light mode */
        .light:root {
            --app-bg: #fff;
            --sidebar: #f3f6fd;
            --app-content-secondary-color: #f3f6fd;
            --app-content-main-color: #1f1c2e;
            --sidebar-link: #1f1c2e;
            --sidebar-hover-link: rgba(195, 207, 244, 0.5);
            --sidebar-active-link: rgba(195, 207, 244, 1);
            --sidebar-main-color: #1f1c2e;
            --filter-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        body{
            background-color: var(--app-bg);
        }
/* Header and cell styling */
.tableView .products-table th,
.tableView .products-table td {
    border-bottom: 1.5px solid var(--app-content-secondary-color);
    color: var(--app-content-main-color);
    font-size: 16px; /* Increase font size for better readability */
    text-align: left;
}
.tableView .products-table th {
    padding: 14px 8px;
}
.tableView .products-table td {
    padding: 12px 8px;
}

.tableView .products-table th:last-child,
.tableView .products-table td:last-child {
    padding-right: 0;
}

/* Make the table container scrollable */

.tableView .table-container {
    max-height: 400px; /* Adjust the max-height according to your needs */
    overflow-y: auto;
    overflow-x: hidden; /* Hide horizontal scrollbar */ /* scrollbar-width: thin; */
}
.tableView .table-container::-webkit-scrollbar {
    width: 8px;
}

.tableView .table-container::-webkit-scrollbar-track {
    background: var(--app-content-secondary-color);
}

/* Scrollbar Handle */
.tableView .table-container::-webkit-scrollbar-thumb {
    background: var(--action-color);
    border-radius: 8px;
}

/* Scrollbar Handle on hover */
.tableView .table-container::-webkit-scrollbar-thumb:hover {
    background: var(--action-color-hover);
}

/* Update table styles */
.tableView .products-table {
    width: 100%;
    border-collapse: collapse;
}

/* Update table header styles */
.tableView .products-header {
    position: sticky;
    top: 0;
    background-color: var(--app-content-secondary-color);
    z-index: 2;
}

/* Row hover effect */
.tableView .products-row:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: var(--app-content-secondary-color);
}

</style>
<body>

<a href="{{ route('etablissement_logout') }}">Logout </a>
    <div class="tableView">
        <div class="table-container">
            <table class="products-table">
                <thead class="products-header">
                    <tr>
                        <th class="product-cell ">Num_Inv</th>
                        <th class="product-cell ">Type</th>
                        <th class="product-cell ">Marque</th>
                        <th class="product-cell ">Date of Acquisition</th>
                        <th class="product-cell ">EF</th>
                        <th class="product-cell ">Etat</th>
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
                                <span>{{ $materialInformatique->marque }}</span>
                            </td>
                            <td class="product-cell">
                                <span>{{ $materialInformatique->dateDacquisition }}</span>
                            </td>
                            <td class="product-cell">
                                <span>{{ $materialInformatique->EF }}</span>
                            </td>
                            <td class="product-cell">
                                <span>{{ $materialInformatique->etat }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>


