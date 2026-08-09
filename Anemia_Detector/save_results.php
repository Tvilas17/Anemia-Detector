<?php
$host = "localhost";
$user = "root";   // XAMPP default
$pass = "";       // default empty password
$db   = "anemia_app";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload
$imagePath = "";
if (!empty($_FILES['image']['name'])) {
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imagePath = $targetFile;
    }
}

// Collect form data
$name        = $_POST['name'] ?? '';
$gender      = $_POST['gender'] ?? '';
$age         = intval($_POST['age'] ?? 0);
$prediction  = $_POST['prediction'] ?? '';
$confidence  = $_POST['confidence'] ?? '';
$normal_prob = intval($_POST['normal_prob'] ?? 0);
$anemic_prob = intval($_POST['anemic_prob'] ?? 0);
$features    = $_POST['features'] ?? '';

// Insert into DB
$sql = "INSERT INTO results 
    (name, gender, age, prediction, confidence, normal_prob, anemic_prob, features, image_path) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssissiiss",
    $name, $gender, $age, $prediction, $confidence,
    $normal_prob, $anemic_prob, $features, $imagePath
);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
