<?php
include_once('db.php');

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if there are any products in the database
if ($result->num_rows > 0) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $products = []; // Initialize an empty array if no products are found
}

// Close the result set
$result->close();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get the product ID from the URL parameter
    $product_id = $_GET['id'];

    // Prepare and execute the SQL statement for deleting the product
    $delete_sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo 'Product deleted successfully <a href=".">Back</a>';
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!-- Assuming you have fetched the products from the database and stored them in $products array -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<?php
    
    ?>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $product['id'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['price'] . "$</td>";
                    echo "<td><img src='" . $product['img'] . "' alt='" . $product['name'] . "' width='50'></td>";
                    echo "<td><a class=\"btn btn-danger\" href='deletepoduct.php?id=" . $product['id'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>