<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    // Data dari formulir
    $name = htmlspecialchars($_POST['name']);
    $companyName = htmlspecialchars($_POST['companyName']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $address = htmlspecialchars($_POST['address']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid.";
        exit;
    }

    // Produk
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
        $mail->addAddress('fitriahjuki@gmail.com');

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
    echo '<div style="text-align: center; margin-top: 20px;">
    <a href="/views/product.html" class="btn btn-primary" style="padding: 10px 20px; background-color: #007bff; border: none; border-radius: 5px; color: white; text-decoration: none; font-family: Arial, sans-serif;">Kembali ke Produk</a>
  </div>';

}

?>