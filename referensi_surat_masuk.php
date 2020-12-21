<?php
// Cegah direct akses ajax.
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
         ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    // Set header type konten.
    header("Content-Type: application/json; charset=UTF-8");

    require_once "include/config.php";
    require_once "include/functions.php";

    // Koneksi ke database.
    $conn = mysqli_connect($host, $username, $password, $database);

    // Deklarasi variable keyword referensi_surat.
    $referensi_surat = $_GET["query"];

    // Query ke database.
    $query  = mysqli_query($conn, "SELECT * FROM tbl_surat_keluar
        WHERE no_surat LIKE '%$referensi_surat%'");

    if (mysqli_num_rows($query) > 0){
        // Format bentuk data untuk autocomplete.
        while ($data = mysqli_fetch_assoc($query)) {
            $output['suggestions'][] = [
                'value' => $data['no_surat'],
                'referensi_surat'  => $data['no_surat']
            ];
        }
    } else {
        $output['suggestions'][] = [
            'value' => '',
            'referensi_surat' => ''
        ];
    }

    // Encode ke json.
    echo json_encode($output);
}
