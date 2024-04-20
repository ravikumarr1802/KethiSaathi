<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = htmlspecialchars($_POST["full_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $company_name = htmlspecialchars($_POST["company_name"]);
    $product_category = htmlspecialchars($_POST["product_category"]);
    $product_description = htmlspecialchars($_POST["product_description"]);

    // Validate and process form data
    // Here, you can add your validation and processing logic
    // For demonstration purposes, we'll just print the submitted data

    echo "<!DOCTYPE html>";
    echo "<html lang=\"en\">";
    echo "<head>";
    echo "<meta charset=\"UTF-8\">";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    echo "<title>Form Submission Result</title>";
    echo "</head>";
    echo "<body>";
    echo "<h1>Form Submission Result</h1>";
    echo "<p><strong>Full Name:</strong> $full_name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone Number:</strong> $phone</p>";
    echo "<p><strong>Company Name:</strong> $company_name</p>";
    echo "<p><strong>Product Category:</strong> $product_category</p>";
    echo "<p><strong>Product Description:</strong> $product_description</p>";
    echo "</body>";
    echo "</html>";

    // You can also save the data to a database or perform other actions here
} else {
    // Redirect or display an error if accessed directly without form submission
    header("Location: /seller_form.html");
    exit();
}
?>
