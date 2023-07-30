<?php


if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get the product ID from the URL parameter
    $product_id = $_GET['id'];

    // Prepare and execute the SQL statement for deleting the product
    $sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo 'Product deleted successfully <a href="." >Back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid product ID";
}

// Close the database connection
$conn->close();
?>