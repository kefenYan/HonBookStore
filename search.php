<?php
// connect database
$conn = mysqli_connect('localhost', 'root', '', 'bookstore');
    
// exit if url parameter is empty
if (!isset($_GET['keyword'])) {
    echo http_response_code(400);
    exit("keyword is empty");
}
$keyword = trim($_GET['keyword']);

// escapes special characters in a string for use in an SQL query, 
// taking into account the current character set of the connection.
$search = mysqli_real_escape_string($conn, $keyword);

// search the allbooks table to find the books matching keyword.
$sql = "SELECT * FROM allbook WHERE title LIKE '%$search%' ";
    
// Perform query
$result = mysqli_query($conn, $sql);
// Check how many result of query.
$queryResult = mysqli_num_rows($result);
if ($queryResult > 0) {
    // If there is a result,
    while($row = mysqli_fetch_assoc($result)) {
        $books[] = $row; 
    }
    echo json_encode($books);
} else {
    // If there is no result,
    // return 400 if no books match the id
    echo http_response_code(400);
}   
?>