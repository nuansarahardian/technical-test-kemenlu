<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Negara DataTable</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        #negara-table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
            margin-top: 10px;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .delete {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
        }
        .delete:hover {
            background-color: #c82333;
        }
        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        footer {
            background-color: #dcdcdc;
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    @include('partials.navbar')
    
    <div class="container">
        <div class="title">
            <h2 class="mb-4">DataTable Negara</h2>
        </div>
        <table class="table table-bordered" id="negara-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Negara</th>
                    <th>Kawasan</th>
                    <th>Direktorat</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#negara-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'http://127.0.0.1:8000/api/negara',
                    dataSrc: 'data'
                },
                columns: [
                    { 
                        data: null,
                        name: 'id_negara',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'nama_negara', name: 'nama_negara' },
                    { data: 'kawasan.nama_kawasan', name: 'kawasan.nama_kawasan' },
                    { data: 'direktorat.nama_direktorat', name: 'direktorat.nama_direktorat' },
                    { data: 'created_at', name: 'created_at', render: function(data) {
                        return new Date(data).toLocaleDateString(); // Format tanggal
                    }},
                    { 
                        data: 'id_negara',
                        name: 'id_negara',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return '<button type="button" class="delete btn btn-danger btn-sm" data-id="'+data+'">Delete</button>';
                        }
                    }
                ],
                dom: 'Bfrtip', // Menampilkan tombol export di atas DataTable
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                drawCallback: function(settings) {
                    console.log('Total records:', settings.json.recordsTotal);
                }
            });

            $('#negara-table').on('click', '.delete', function() {
                var id = $(this).data("id");
                var url = '/api/negara/' + id;

                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (data) {
                            table.ajax.reload();
                            alert(data.message);
                        },
                        error: function (data) {
                            alert(data.responseJSON.message);
                        }
                    });
                }
            });
        });
    </script>
    
    <footer>
        <p>Nuansa Syafrie Rahardian - Universitas Jenderal Soedirman</p>
    </footer>
</body>
</html>
