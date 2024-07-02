<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Informatique</title>
    <style>
        /* Reset default margin and padding */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        /* Container styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Table header styles */
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        /* Table row styles */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $etablissementName }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Num_Inv</th>
                    <th>Type</th>
                    <th>Marque</th>
                    <th>Date D'acquisition</th>
                    <th>EF</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materialInformatiques as $materialInformatique)
                <tr>
                    <td>{{ $materialInformatique->Num_Inv }}</td>
                    <td>{{ $materialInformatique->type }}</td>
                    <td>{{ $materialInformatique->marque }}</td>
                    <td>{{ $materialInformatique->dateDacquisition }}</td>
                    <td>{{ $materialInformatique->EF }}</td>
                    <td>{{ $materialInformatique->etat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
