<?php
header("Content-Type: application/json");

$serverName = "pabrikusm.dyndns.org"; 
$connectionOptions = [
    "Database" => "produksi1", 
    "Uid" => "view_spk",                
    "PWD" => "*X1?v4"                   
];

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(json_encode(["error" => sqlsrv_errors()]));
}

if (isset($_GET['po_number'])) {
    $po_number = $_GET['po_number'];
    $query = "SELECT CUSTOMER_NAME, QTY_SPK, NAMA_BARANG, QTY_QC_OK, qty_kirim, tgl_kirim, Tgl_QC_OK, No_Item_Accurate FROM dbo.TR_SPK WHERE NOPO_Customer = ?";
    $params = [$po_number];
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt === false) {
        die(json_encode(["error" => sqlsrv_errors()]));
    }

    $po_data = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if ($row['Tgl_QC_OK'] instanceof DateTime) {
            $row['Tgl_QC_OK'] = $row['Tgl_QC_OK']->format('Y-m-d');
        }
        if ($row['tgl_kirim'] instanceof DateTime) {
            $row['tgl_kirim'] = $row['tgl_kirim']->format('Y-m-d');
        }
        $po_data[] = $row;
    }
    echo json_encode($po_data);
} else {
    echo json_encode(["error" => "No PO number provided"]);
}

sqlsrv_close($conn);
?>
