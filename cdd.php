<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if files were uploaded
    if (isset($_FILES["image1"]) && isset($_FILES["image2"])) {
        // Process uploaded images
        $image1 = $_FILES["image1"]["tmp_name"];
        $image2 = $_FILES["image2"]["tmp_name"];

        // Load images using GD library
        $img1 = imagecreatefromjpeg($image1);
        $img2 = imagecreatefromjpeg($image2);

        // Get image dimensions
        $width1 = imagesx($img1);
        $height1 = imagesy($img1);
        $width2 = imagesx($img2);
        $height2 = imagesy($img2);

        // Compare image dimensions
        if ($width1 == $width2 && $height1 == $height2) {
            // Compare pixel colors (sample logic)
            $diseased_pixels = 0;
            for ($x = 0; $x < $width1; $x++) {
                for ($y = 0; $y < $height1; $y++) {
                    $color1 = imagecolorat($img1, $x, $y);
                    $color2 = imagecolorat($img2, $x, $y);
                    if ($color1 != $color2) {
                        $diseased_pixels++;
                    }
                }
            }

            // Determine disease status based on pixel difference (sample logic)
            $total_pixels = $width1 * $height1;
            $disease_percentage = ($diseased_pixels / $total_pixels) * 100;
            $disease_status = $disease_percentage > 5 ? "Diseased" : "Healthy";

            // Display result
            echo "<!DOCTYPE html>";
            echo "<html lang=\"en\">";
            echo "<head>";
            echo "<meta charset=\"UTF-8\">";
            echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
            echo "<title>Disease Detection Result</title>";
            echo "</head>";
            echo "<body>";
            echo "<h1>Disease Detection Result</h1>";
            echo "<p>Image 1: <img src=\"{$_FILES["image1"]["name"]}\" alt=\"Image 1\" style=\"max-width: 100px;\"></p>";
            echo "<p>Image 2: <img src=\"{$_FILES["image2"]["name"]}\" alt=\"Image 2\" style=\"max-width: 100px;\"></p>";
            echo "<p>Disease Status: $disease_status</p>";
            echo "</body>";
            echo "</html>";

            // Free memory
            imagedestroy($img1);
            imagedestroy($img2);
        } else {
            echo "Error: Images must have the same dimensions.";
        }
    } else {
        echo "Error: Please upload two images.";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
