<!DOCTYPE html>
<html lang="id">
<head>
  
    <title>United Heater</title>
    <link rel="stylesheet" href="/css/home.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/responsive.css" />
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Manrope:wght@400;500;600;700;800&family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;1,700&family=Ubuntu:wght@300;400;500;700&display=swap"
      rel="stylesheet"/>
    <link
      rel="shortcut icon"
      type="image/png"
      href="https://unitedheater.co.id/sites/default/files/new_logo.png"
    />
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link rel="icon" href="https://unitedheater.co.id/sites/default/files/new_logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
  </head>

    <?php
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;



 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mail = new PHPMailer(true);

        $name = htmlspecialchars($_POST['name']);
        $companyName = htmlspecialchars($_POST['companyName']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $address = htmlspecialchars($_POST['address']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Format email tidak valid.";
            exit;
        }

        $productNames = $_POST['productName'];
        $specifications = $_POST['specification'];
        $usages = $_POST['usage'];
        $itemCodes = $_POST['itemCode'];

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'benedictus.rangga9@gmail.com';
            $mail->Password = 'yuxiinsmpafkstjj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom($email, $name);
            $mail->addAddress('ameliafega02@gmail.com');

            $mail->Subject = "Pemesanan Baru dari $name";
            $message = "Nama: $name\n";
            $message .= "Nama Perusahaan: $companyName\n";
            $message .= "Nomor Telepon: $phone\n";
            $message .= "Email: $email\n";
            $message .= "Alamat: $address\n";
            $message .= "Detail Produk:\n";

            for ($i = 0; $i < count($productNames); $i++) {
                $message .= "\nProduk " . ($i + 1) . ":\n";
                $message .= "Nama Produk: " . htmlspecialchars($productNames[$i]) . "\n";
                $message .= "Spesifikasi: " . htmlspecialchars($specifications[$i]) . "\n";
                $message .= "Penggunaan: " . htmlspecialchars($usages[$i]) . "\n";
                $message .= "Kode Barang: " . htmlspecialchars($itemCodes[$i]) . "\n";
            }

            $mail->Body = $message;

            if (isset($_FILES['productPhoto'])) {
                foreach ($_FILES['productPhoto']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['productPhoto']['error'][$key] === UPLOAD_ERR_OK) {
                        $filePath = $_FILES['productPhoto']['tmp_name'][$key];
                        $fileName = $_FILES['productPhoto']['name'][$key];
                        $mail->addAttachment($filePath, $fileName);
                    }
                }
            }

            if ($mail->send()) {
                echo '<div class="alert alert-success" role="alert" style="font-family: Arial, sans-serif; color: #28a745; background-color: #d4edda; border-color: #c3e6cb;  text-align:center; padding: 15px; top: 10px;">
                 <strong>Sukses!</strong> Email berhasil dikirim!
              </div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert" style="font-family: Arial, sans-serif; color: #dc3545; background-color: #f8d7da; text-align:center;    border-color: #f5c6cb; padding: 15px; top: 10px;">
              <strong>Gagal!</strong> Gagal mengirim email. Pesan: ' . $mail->ErrorInfo . '
          </div>';
        }
    }
    
    ?>


<div class="tp-navigation">
  <div class="tp-page-width">
    <div class="tp-nav-bar">
      
      <div class="tp-nav-logo">
        <a href="index.html">
          <img src="https://unitedheater.co.id/sites/default/files/new_logo.png" alt="Company Logo"   class="main-logo" id="mainLogo">
        </a>
         <span class="logo-sitename" id="logoName" >United Heater </span>
        </div>
        <div class="slogan" id="slogan">"We make your heating better"</div>
      </div>
      <body>
      <!-- Navigation Menu -->
      <div class="tp-nav-menu" id="navMenu">
        <ul>
          <li><a href="../views/Home.html">Home</a></li>
          <li><a href="../views/about-us.html">About us</a></li>
          <li><a href="../views/product.html">Product </a></li>
          <li><a href="../views/track_order.html">tracking </a></li>
          <li><a href="../views/articles.html">Artikel</a></li>
          <li><a href="../views/career.html">Karir</a></li>
          </li>
       
          <li><a href="../views/contact.html">Contact</a></li>
        </ul>
      </div>
    </div>

    <div class="hamburger" id="hamburger" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
  </div>

  <nav class="drawer" id="drawer">
    <ul class="drawer-menu">
      <li><a href="../views/Home.html"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="../views/about-us.html"><i class="fas fa-info-circle"></i> About Us</a></li>
      <li><a href="../views/product.html"><i class="fas fa-box-open"></i> Product</a></li>
      <li><a href="../views/tracking.html"><i class="fas fa-tracking"></i> tracking</a></li>

      
      <li><a href="../views/articles.html"><i class="fas fa-newspaper"></i> Artikel</a></li>
     
      <li><a href="../views/career.html"><i class="fas fa-briefcase"></i> Karir</a></li>


   
      <li><a href="../views/contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
      <li><a href="../views/track_order.html"><i class="fas fa-envelope"></i>Tracker</a></li>

    </ul>
  </nav>
  


    <title>Form Pemesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }

        .time-container {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
            color: red;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .product-container {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .add-product {
            text-align: right;
            margin: 10px 0;
        }
        .add-product i {
            cursor: pointer;
            color: #007bff;
            font-size: 1.5em;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }


        <style>
      /* Style for suggestion box */
      .suggestions {
         position: absolute;
         background-color: white;
         border: 1px solid #ccc;
         width: 100%;
         max-height: 150px;
         overflow-y: auto;
         display: none;
      }
      .suggestions div {
         padding: 10px;
         cursor: pointer;
      }
      .suggestions div:hover {
         background-color: #f1f1f1;
      }
   </style>


<body>

    <h1>Form Pemesanan</h1>
    <div class="time-container" id="currentTime"></div>
    <div class="form-container">
        <form id="orderForm" action="" method="POST" enctype="multipart/form-data">
            <h2>Identitas</h2>
            <label for="name">Nama </label>
            <input type="text" name="name" id="name"  placeholder="Name" required>
            <label for="companyName">Nama Perusahaan </label>
            <input type="text" name="companyName" id="companyName" placeholder="Company Name" required>
            <label for="phone">Nomor Telepon </label>
            <input type="text" name="phone" id="phone" placeholder="Phone number" required>
            <label for="email">Email </label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="address">Alamat </label>
            <textarea name="address" id="address" placeholder="Address" required></textarea>
            <h2>Produk</h2>
            <div id="productList">
                <div class="product-container">
                <label for="productName">Nama Produk</label>
                <input type="text" name="productName[]" id="productName" placeholder="Product Name" oninput="fetchSuggestions()" required>
              <div id="suggestions" class="suggestions"></div>
                    <label for="specification">Spesifikasi</label>
                    <textarea name="specification[]" placeholder="specification" required></textarea>
                    <label for="usage">Penggunaan </label>
                    <textarea name="usage[]"placeholder="usage"  required></textarea>
                    <label for="itemCode">Kode Barang (opsional)</label>
                    <input type="text" name="itemCode[]" placeholder="Item Code(optional)">
                    <label for="productPhoto">Foto Barang/ Product Photo (opsional)</label>
                    <input type="file" name="productPhoto[]"   multiple>
                </div>
            </div>
            <div class="add-product">
                <i class="fas fa-plus-circle" id="addProductIcon"></i>
            </div>
            <button type="submit">Kirim Pesanan</button>
        </form>
    </div>

    <script>



        // Update the current time every second
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('currentTime').textContent = `Waktu Saat Ini: ${timeString}`;
        }
        setInterval(updateTime, 1000);



        const addProductIcon = document.getElementById('addProductIcon');
        const productList = document.getElementById('productList');

        addProductIcon.addEventListener('click', () => {
            const newProduct = document.createElement('div');
            newProduct.className = 'product-container';

            newProduct.innerHTML = `
              <div class="remove-product">
                <i class="fas fa-minus-circle" id="removeProductIcon">  hapus barang</i>
            </div>

                <label for="productName">Nama Produk</label>
                <input type="text" name="productName[]" placeholder="Masukkan nama produk" required>
                <label for="specification">Spesifikasi (wajib)</label>
                <textarea name="specification[]" required></textarea>
                <label for="usage">Penggunaan (wajib)</label>
                <textarea name="usage[]" required></textarea>
                <label for="itemCode">Kode Barang (opsional)</label>
                <input type="text" name="itemCode[]" placeholder="Masukkan kode barang">
                <label for="productPhoto">Foto Barang (opsional)</label>
                <input type="file" name="productPhoto[]" multiple>
               
            `;

            newProduct.querySelector('.remove-product').addEventListener('click', () => {
            productList.removeChild(newProduct);
        });
            productList.appendChild(newProduct);
        });

        
    </script>


<script>
    
    function fetchProductSuggestions(query) {
        $.ajax({
            url: 'search_products.php', 
            type: 'GET',
            data: { search: query },
            success: function(data) {
                const suggestions = JSON.parse(data);
                showSuggestions(suggestions);
            }
        });
    }

    // Function to display suggestions
    function showSuggestions(suggestions) {
        const suggestionBox = document.getElementById('suggestions');
        suggestionBox.innerHTML = '';

        if (suggestions.length > 0) {
            suggestionBox.style.display = 'block'; 
            suggestions.forEach(function(suggestion) {
                const div = document.createElement('div');
                div.textContent = suggestion.name; 
                div.onclick = function() {
                    document.getElementById('productName').value = suggestion.name;
                    suggestionBox.style.display = 'none';
                };
                suggestionBox.appendChild(div);
            });
        } else {
            suggestionBox.style.display = 'none'; // Hide if no suggestions
        }
    }

    // Event listener for the product name input field
    document.getElementById('productName').addEventListener('input', function() {
        const query = this.value.trim();
        if (query.length > 2) {
            fetchProductSuggestions(query); // Fetch suggestions if input length is greater than 2
        } else {
            document.getElementById('suggestions').style.display = 'none'; // Hide suggestions
        }
    });
</script>

  <script>
function fetchSuggestions() {
   const query = document.getElementById('productName').value;
   const suggestionBox = document.getElementById('suggestions');

   // If input is empty, hide the suggestion box
   if (!query) {
      suggestionBox.style.display = 'none';
      return;
   }

   // Fetch suggestions from the server
   fetch('search_products.php?query=' + query)
      .then(response => response.json())
      .then(data => {
         // Clear previous suggestions
         suggestionBox.innerHTML = '';

         // If there are matching results
         if (data.length > 0) {
            suggestionBox.style.display = 'block';
            // Display each suggestion as a list item
            data.forEach(item => {
               const div = document.createElement('div');
               div.textContent = item.product_name;  // Ensure this field matches your JSON response
               div.onclick = function() {
                  // When a suggestion is clicked, fill the input and hide suggestions
                  document.getElementById('productName').value = item.product_name;
                  suggestionBox.style.display = 'none';
               };
               suggestionBox.appendChild(div);
            });
         } else {
            suggestionBox.style.display = 'none';
         }
      })
      .catch(error => {
         console.error('Error fetching suggestions:', error);
      });
}

   </script>


