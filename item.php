<?php
// connect database
$conn = mysqli_connect('localhost', 'root', '', 'bookstore'); 
    
// exit if url parameter is empty
if (!isset($_GET['id'])) {
    echo http_response_code(404);
    exit("id is empty");
}
        
// Get id from url parameter
$id = trim($_GET['id']);           
$search = mysqli_real_escape_string($conn, $id);    
$sql = "SELECT * FROM allbook WHERE id = $search ";   
// Perform query; 
$result = mysqli_query($conn, $sql);    
// Check how many result of query.
$queryResult = mysqli_num_rows($result);    
if ($queryResult > 0) {
    // If there is a result,    
    $book = mysqli_fetch_assoc($result);   
    echo json_encode($book);   
} else {
    // If there is no result,
    // Return 400 if no books match the id
    echo http_response_code(400);  
}
?>