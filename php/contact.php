<?php
// Ensure that the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Connect to SQLite database
    $db = new SQLite3('..\database\database.db');

    // Check if the database connection was successful
    if (!$db) {
        die("Connection failed: " . $db->lastErrorMsg());
    }

    // Create a table (if not exists) to store form submissions
    $db->exec("CREATE TABLE IF NOT EXISTS submissions (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        email TEXT,
        phone TEXT,
        message TEXT
    )");

    // Insert form data into the database
    $stmt = $db->prepare("INSERT INTO submissions (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    $stmt->bindValue(':message', $message, SQLITE3_TEXT);

    if (!$stmt->execute()) {
        die("Error inserting data: " . $db->lastErrorMsg());
    }

    // Close the database connection
    $db->close();
    
    // In the future we can optionally redirect the user to a thank you page
    header("Location: ..\pages\contact.html");
    
    exit;
}
?>
