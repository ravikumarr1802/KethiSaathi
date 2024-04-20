<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $temperature = $_POST["temperature"];
    $humidity = $_POST["humidity"];
    $rainfall = $_POST["rainfall"];
    $soil_ph = $_POST["soil_ph"];
    $nitrogen = $_POST["nitrogen"];
    $phosphorus = $_POST["phosphorus"];
    $potassium = $_POST["potassium"];

    // Perform crop prediction based on input values
    $prediction = "";

    if ($temperature > 25 && $humidity > 60 && $rainfall > 100) {
        $prediction = "Rice";
    } elseif ($temperature > 20 && $humidity > 50 && $rainfall > 50) {
        $prediction = "Wheat";
    } elseif ($temperature > 15 && $humidity > 40 && $rainfall > 70) {
        $prediction = "Corn";
    } elseif ($temperature > 30 && $humidity > 70 && $rainfall > 120) {
        $prediction = "Sugarcane";
    } elseif ($temperature > 18 && $humidity > 50 && $rainfall > 60) {
        $prediction = "Barley";
    } else {
        $prediction = "No specific crop prediction based on provided data";
    }

    // Display the predicted crop
    echo "<h2>Predicted Crop:</h2>";
    echo "<p>The predicted crop based on the input values is: <strong>$prediction</strong></p>";
} else {
    // Redirect to the form page if accessed directly
    header("Location: index.html");
    exit();
}
?>
