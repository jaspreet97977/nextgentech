<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel - NextGenTech</title>
    <link rel="stylesheet" href="public/css/admin.css">
</head>
<body>

<?php include 'includes/header.php'; ?>
<?php
session_start();
require 'includes/db.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = floatval($_POST['price']);
        $image = $_POST['image'];

        $collection->insertOne([
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'price' => $price,
            'image' => $image
        ]);
        echo "<script>alert('Product added successfully!'); window.location.href='admin_panel.php';</script>";
    } elseif ($action === 'update') {
        $id = new MongoDB\BSON\ObjectId($_POST['id']);
        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = floatval($_POST['price']);
        $image = $_POST['image'];

        $collection->updateOne(['_id' => $id], ['$set' => [
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'price' => $price,
            'image' => $image
        ]]);
        echo "<script>alert('Product updated successfully!'); window.location.href='admin_panel.php';</script>";
    } elseif ($action === 'delete') {
        $id = new MongoDB\BSON\ObjectId($_POST['id']);
        $collection->deleteOne(['_id' => $id]);
        echo "<script>alert('Product deleted successfully!'); window.location.href='admin_panel.php';</script>";
    }
}

// Fetch all products
$products = $collection->find();
?>

<h2>Admin Panel - NextGenTech</h2>

<h3>Add Product</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="text" name="category" placeholder="Category" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="text" name="image" placeholder="Image URL" required>
    <input type="hidden" name="action" value="add">
    <button type="submit">Add Product</button>
</form>

<h3>Product List</h3>
<table>
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['category']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td>$<?php echo number_format($product['price'], 2); ?></td>
            <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50"></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $product['_id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit">Delete</button>
                </form>
                <button onclick="editProduct('<?php echo $product['_id']; ?>', '<?php echo $product['name']; ?>', '<?php echo $product['category']; ?>', '<?php echo $product['description']; ?>', '<?php echo $product['price']; ?>', '<?php echo $product['image']; ?>')">Edit</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Edit Product Form (Initially Hidden) -->
<div id="editForm" style="display: none; margin-top: 20px;">
    <h3>Edit Product</h3>
    <form method="POST">
        <input type="hidden" id="editProductId" name="id">
        <input type="text" id="editName" name="name" placeholder="Product Name" required>
        <input type="text" id="editCategory" name="category" placeholder="Category" required>
        <textarea id="editDescription" name="description" placeholder="Description" required></textarea>
        <input type="number" step="0.01" id="editPrice" name="price" placeholder="Price" required>
        <input type="text" id="editImage" name="image" placeholder="Image URL" required>
        <input type="hidden" name="action" value="update">
        <button type="submit">Update Product</button>
        <button type="button" onclick="hideEditForm()">Cancel</button>
    </form>
</div>

<script>
    function editProduct(id, name, category, description, price, image) {
        document.getElementById('editProductId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editCategory').value = category;
        document.getElementById('editDescription').value = description;
        document.getElementById('editPrice').value = price;
        document.getElementById('editImage').value = image;
        document.getElementById('editForm').style.display = 'block';
    }

    function hideEditForm() {
        document.getElementById('editForm').style.display = 'none';
    }
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>
