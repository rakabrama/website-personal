<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semantic Web - Muhamad Sahyudi</title>
    <!-- Include Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        /* Styling to ensure filters are visually distinct */
        .column-filter {
            width: 100%;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        th {
            width: 600px !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">DATA SEKOLAH KOTA BATAM</h1>
        <h5 class="text-center mb-4"> By Raka Brama Siddiq</h5>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th style="width:600px !important;">NIB</th>
                        <th style="width:600px !important;">Nama Sekolah</th>
                        <th style="width:600px !important;">Kelurahan</th>
                        <th style="width:600px !important;">Kecamatan</th>
                        <th style="width:600px !important;">Kota</th>
                        <th style="width:600px !important;">Alamat</th>
                        <th style="width:600px !important;">Luas</th>
                        <th style="width:600px !important;">Status</th>
                        <th style="width:600px !important;">Tanggal Terbit</th>
                        <th style="width:600px !important;">Tanggal Berdiri Sekolah</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search NIB"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Pemilik"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Kelurahan"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Kecamatan"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Kota"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Alamat"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Luas"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Status"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Tanggal Terbit"></th>
                        <th><input type="text" class="form-control column-filter" placeholder="Search Tanggal Jatuh Tempo"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli('localhost', 'root', '', 'semanticweb');

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    // Query untuk mengambil data
                    $sql = "SELECT * FROM sertipikat_tanah";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td >" . htmlspecialchars($row['nib']) . "</td>";
                            echo "<td >" . htmlspecialchars($row['pemilik']) . "</td>";
                            echo "<td >" . htmlspecialchars($row['kelurahan']) . "</td>";
                            echo "<td >" . htmlspecialchars($row['kecamatan']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['kota']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['luas']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tgl_terbit']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tgl_jth_tempo']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No data available</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include jQuery, Bootstrap 4 JS, and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize the DataTable
            var table = $('#example').DataTable({
                columns: [{
                        width: "50px"
                    }, // No
                    {
                        width: "200px"
                    }, // NIB
                    {
                        width: "200px"
                    }, // Pemilik
                    {
                        width: "200px"
                    }, // Kelurahan
                    {
                        width: "200px"
                    }, // Kecamatan
                    {
                        width: "200px"
                    }, // Kota
                    {
                        width: "200px"
                    }, // Alamat
                    {
                        width: "100px"
                    }, // Luas
                    {
                        width: "100px"
                    }, // Status
                    {
                        width: "150px"
                    }, // Tanggal Terbit
                    {
                        width: "150px"
                    } // Tanggal Jatuh Tempo
                ],
                autoWidth: false,
                scrollX: true,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        $("input", column.header()).on("keyup change clear", function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    });
                } // Jika tabel terlalu lebar, tambahkan scroll horizontal
            });
        });
    </script>
</body>

</html>