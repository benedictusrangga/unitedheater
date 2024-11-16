<?php
// Set up database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "united"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the AJAX request
$query = $_GET['query'];

// SQL to search for matching product names
$sql = "SELECT tipe_barang FROM barang WHERE tipe_barang LIKE ? LIMIT 10";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Prepare suggestions
$suggestions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = ['product_name' => $row['tipe_barang']];
    }
} 

echo json_encode($suggestions); // Return results as JSON

$stmt->close();
$conn->close();
?>
