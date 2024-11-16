<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unitedheater";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses untuk menambahkan, mengedit, atau menghapus data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tambah atau edit data
    if (isset($_POST['action'])) {
        $id = $_POST['id'] ?? null;

        if ($_POST['action'] == 'add_banner') {
            $image_url = $_POST['image_url'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $sql = "INSERT INTO banners (image_url, title, description) VALUES ('$image_url', '$title', '$description')";
            $conn->query($sql);
            header("Location: ".$_SERVER['PHP_SELF']."#addBannerForm");
        } elseif ($_POST['action'] == 'edit_banner') {
            $image_url = $_POST['image_url'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $sql = "UPDATE banners SET image_url='$image_url', title='$title', description='$description' WHERE id=$id";
            $conn->query($sql);
            header("Location: ".$_SERVER['PHP_SELF']."#editBannerForm");
        } elseif ($_POST['action'] == 'add_best_selling_product') {
            $image = $_POST['product_image'];
            $name = $_POST['product_name'];
            $link = $_POST['product_link'];
            $sql = "INSERT INTO best_selling_products (image_url, name, link) VALUES ('$image', '$name', '$link')";
            $conn->query($sql);
            header("Location: ".$_SERVER['PHP_SELF']."#addProductForm");
        } elseif ($_POST['action'] == 'edit_best_selling_product') {
            $image = $_POST['product_image'];
            $name = $_POST['product_name'];
            $link = $_POST['product_link'];
            $sql = "UPDATE best_selling_products SET image_url='$image', name='$name', link='$link' WHERE id=$id";
            $conn->query($sql);
            header("Location: ".$_SERVER['PHP_SELF']."#editProductForm");
        } elseif ($_POST['action'] == 'add_article') {
            $image = $_POST['article_image'];
            $title = $_POST['article_title'];
            $date = $_POST['article_date'];
            $content = $_POST['article_content'];
            $sql = "INSERT INTO articles (image, title, date, content) VALUES ('$image', '$title', '$date', '$content')";
            $conn->query($sql);
            header("Location: ".$_SERVER['PHP_SELF']."#addArticleForm");
        } elseif ($_POST['action'] == 'edit_article') {
            $image = $_POST['article_image'];
            $title = $_POST['article_title'];
            $date = $_POST['article_date'];
            $content = $_POST['article_content'];
            $sql = "UPDATE articles SET image='$image', title='$title', date='$date', content='$content' WHERE id=$id";
            $conn->query($sql);
            header("Location: ".$_SERVER['PHP_SELF']."#editArticleForm");
        }
        exit;
    }
}

// Hapus data
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        
        if ($type == 'banner') {
            $sql = "DELETE FROM banners WHERE id=$deleteId";
            $conn->query($sql);
        } elseif ($type == 'product') {
            $sql = "DELETE FROM best_selling_products WHERE id=$deleteId";
            $conn->query($sql);
        } elseif ($type == 'article') {
            $sql = "DELETE FROM articles WHERE id=$deleteId";
            $conn->query($sql);
        }
        header("Location: ".$_SERVER['PHP_SELF']."#". $type . "Table");
        exit;
    }
}

// Ambil data untuk ditampilkan
$banners = $conn->query("SELECT * FROM banners");
$bestSellingProducts = $conn->query("SELECT * FROM best_selling_products");
$articles = $conn->query("SELECT * FROM articles");

// Menangani edit
$editData = null;
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        
        if ($type == 'banner') {
            $editData = $conn->query("SELECT * FROM banners WHERE id=$editId")->fetch_assoc();
        } elseif ($type == 'product') {
            $editData = $conn->query("SELECT * FROM best_selling_products WHERE id=$editId")->fetch_assoc();
        } elseif ($type == 'article') {
            $editData = $conn->query("SELECT * FROM articles WHERE id=$editId")->fetch_assoc();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Admin Panel</h1>

<h2 id="addBannerForm">Add Banner</h2>
<form method="post">
    <input type="text" name="image_url" placeholder="Image URL" required>
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <button type="submit" name="action" value="add_banner">Add Banner</button>
</form>

<?php if ($editData && $_GET['type'] == 'banner'): ?>
<h2 id="editBannerForm">Edit Banner</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
    <input type="text" name="image_url" placeholder="Image URL" value="<?php echo $editData['image_url']; ?>" required>
    <input type="text" name="title" placeholder="Title" value="<?php echo $editData['title']; ?>" required>
    <textarea name="description" placeholder="Description" required><?php echo $editData['description']; ?></textarea>
    <button type="submit" name="action" value="edit_banner">Update Banner</button>
</form>
<?php endif; ?>

<h2 id="bannerTable">Existing Banners</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Image URL</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $banners->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['image_url']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td>
            <a href="?edit=<?php echo $row['id']; ?>&type=banner#editBannerForm">Edit</a>
            <a href="?delete=<?php echo $row['id']; ?>&type=banner" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<h2 id="addProductForm">Add Best Selling Product</h2>
<form method="post">
    <input type="text" name="product_image" placeholder="Product Image URL" required>
    <input type="text" name="product_name" placeholder="Product Name" required>
    <input type="text" name="product_link" placeholder="Product Link" required>
    <button type="submit" name="action" value="add_best_selling_product">Add Product</button>
</form>

<?php if ($editData && $_GET['type'] == 'product'): ?>
<h2 id="editProductForm">Edit Best Selling Product</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
    <input type="text" name="product_image" placeholder="Product Image URL" value="<?php echo $editData['image_url']; ?>" required>
    <input type="text" name="product_name" placeholder="Product Name" value="<?php echo $editData['name']; ?>" required>
    <input type="text" name="product_link" placeholder="Product Link" value="<?php echo $editData['link']; ?>" required>
    <button type="submit" name="action" value="edit_best_selling_product">Update Product</button>
</form>
<?php endif; ?>

<h2 id="productTable">Existing Best Selling Products</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Image URL</th>
        <th>Name</th>
        <th>Link</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $bestSellingProducts->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['image_url']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['link']; ?></td>
        <td>
            <a href="?edit=<?php echo $row['id']; ?>&type=product#editProductForm">Edit</a>
            <a href="?delete=<?php echo $row['id']; ?>&type=product" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<h2 id="addArticleForm">Add Article</h2>
<form method="post">
    <input type="text" name="article_image" placeholder="Article Image URL" required>
    <input type="text" name="article_title" placeholder="Title" required>
    <input type="date" name="article_date" required>
    <textarea name="article_content" placeholder="Content" required></textarea>
    <button type="submit" name="action" value="add_article">Add Article</button>
</form>

<?php if ($editData && $_GET['type'] == 'article'): ?>
<h2 id="editArticleForm">Edit Article</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
    <input type="text" name="article_image" placeholder="Article Image URL" value="<?php echo $editData['image']; ?>" required>
    <input type="text" name="article_title" placeholder="Title" value="<?php echo $editData['title']; ?>" required>
    <input type="date" name="article_date" value="<?php echo $editData['date']; ?>" required>
    <textarea name="article_content" placeholder="Content" required><?php echo $editData['content']; ?></textarea>
    <button type="submit" name="action" value="edit_article">Update Article</button>
</form>
<?php endif; ?>

<h2 id="articleTable">Existing Articles</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Image URL</th>
        <th>Title</th>
        <th>Date</th>
        <th>Content</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $articles->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['image']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['content']; ?></td>
        <td>
            <a href="?edit=<?php echo $row['id']; ?>&type=article#editArticleForm">Edit</a>
            <a href="?delete=<?php echo $row['id']; ?>&type=article" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
