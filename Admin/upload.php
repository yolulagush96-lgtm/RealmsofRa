<?php
$password = "realm123";

if (!isset($_GET['key']) || $_GET['key'] !== $password) {
    die("Access denied");
}
?>

<h1>Admin Upload</h1>

        <form action="" method="POST" enctype="multipart/form-data">

             <input type="text" name="title" placeholder="Product Name" required>
             <input type="number" name="price" placeholder="Price" required>
             <textarea name="description" placeholder="Description"></textarea>

             <input type="file" name="image" required>

            <button type="submit">Upload Product</button>

        </form>

<?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "realmsofra";

       $conn = new mysqli($host, $user, $pass, $db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    $imageName = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $folder = "../uploads/" . $imageName;

    move_uploaded_file($tmpName, $folder);

    $sql = "INSERT INTO products (title, price, description, image)
            VALUES ('$title', '$price', '$description', '$imageName')";

    $conn->query($sql);

    echo "Uploaded successfully!";
}
?>