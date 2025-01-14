<?php
header('Content-Type: application/json');

include '../connection.php';


$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchTerm = $conn->real_escape_string($searchTerm);
$sql = "SELECT movieID, title, director, actor, actor2, genre, genre2, country, description, poster, release_date, rating, imdbVotes 
        FROM movies 
        WHERE title LIKE '%$searchTerm%' 
           OR director LIKE '%$searchTerm%' 
           OR actor LIKE '%$searchTerm%' 
           OR actor2 LIKE '%$searchTerm%' 
           OR genre LIKE '%$searchTerm%' 
           OR genre2 LIKE '%$searchTerm%'
        ORDER BY release_date DESC";

$result = $conn->query($sql);

$movies = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

echo json_encode($movies);

$conn->close();
?>
