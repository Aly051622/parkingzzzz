<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection
include 'includes/dbconnection.php';

// Query to get distinct sender details
$sql = "SELECT DISTINCT m.sender, u.FirstName, u.LastName, u.profile_pictures
        FROM messages AS m
        INNER JOIN tblregusers AS u ON m.sender = u.Email";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if the query was successful
if (!$result) {
    die("Query Failed: " . mysqli_error($con)); // Output error if query fails
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Service</title>
    <!-- Include any CSS files here -->
</head>
<body>
    <h2>Messages from Users</h2>

    <?php
    // Loop through the query results and display the sender details
    while ($row = mysqli_fetch_assoc($result)) {
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $profilePicture = $row['profile_pictures'];

        // Display the sender's name and profile picture
        echo "<div class='sender'>";
        echo "<img src='uploads/profile_uploads/" . $profilePicture . "' alt='Profile Picture' width='50' height='50'>";
        echo "<p>" . $firstName . " " . $lastName . "</p>";
        echo "<a href='conversation.php?sender=" . urlencode($row['sender']) . "'>View Conversation</a>";
        echo "</div>";
    }
    ?>

</body>
</html>
