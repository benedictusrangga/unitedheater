<?php
// Koneksi ke database
$servername = "localhost"; // Ganti sesuai pengaturan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "united"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>United Heater</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/custom.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Manrope:wght@400;500;600;700;800&family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;1,700&family=Ubuntu:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="shortcut icon"
      type="image/png"
      href="https://unitedheater.co.id/sites/default/files/new_logo.png"
    />
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link rel="icon" href="https://unitedheater.co.id/sites/default/files/new_logo.png" type="image/x-icon">

  </head>


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
          <style>
        

       
        
      
        </style>
    
          <body>
          <!-- Navigation Menu -->
          <div class="tp-nav-menu" id="navMenu">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="about-us.html">About us</a></li>
              <li><a href="product.html">Product </a></li>
              
              <li><a href="articles.html">Artikel</a></li>
              <li><a href="career.html">Karir</a></li>
              </li>
           
              <li><a href="contact.html">Contact</a></li>
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
          <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
          <li><a href="about-us.html"><i class="fas fa-info-circle"></i> About Us</a></li>
          <li><a href="product.html"><i class="fas fa-box-open"></i> Product</a></li>
          
          <li><a href="articles.html"><i class="fas fa-newspaper"></i> Artikel</a></li>

          <li><a href="career.html"><i class="fas fa-briefcase"></i> Karir</a></li>

       
          <li><a href="contact.html"><i class="fas fa-envelope"></i> Contact</a></li>

        </ul>
      </nav>
      
      <div class="overlay" id="overlay" onclick="toggleMenu()"></div>
      
    
    
      <div class="tp-banner">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php
            // Query untuk mengambil data banner
            $sql = "SELECT image_url AS image, title, description FROM banners"; // Perbaiki nama kolom
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0): // Cek jika $result tidak false
                while($row = $result->fetch_assoc()): ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
                        <div class="caption">
                            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                    </div>
                <?php endwhile;
            else: // Jika tidak ada hasil
                echo "<div class='swiper-slide'>No banners available</div>";
            endif; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

    
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
       
    </body>
    </html>
    
    
    <script>
      var swiper = new Swiper('.mySwiper', {
        loop: true,    
                  
        autoplay: {
          delay: 3000,           
          disableOnInteraction: false,  
        },
        speed: 1000,            
        effect: 'slide',      
        pagination: {
          el: '.swiper-pagination',
          clickable: true,     
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<div class="tp-top-feat">
  <div class="tp-page-width">
    <div class="tp-top-feat-content">
      
      
      <div class="tp-top-feat-con">
        
        <!-- Client Needs -->
        <div class="tp-top-feat-box" >
          <div class="tp-top-feat-img">
            <i class="fas fa-handshake fa-3x"></i>
          </div>
          <div class="tp-top-feat-title">
            <h3>Client Needs</h3>
            <p>Providing optimal solutions and services tailored to client requirements.</p>
          </div>
        </div>
        
        <!-- Competitive Pricing -->
        <div class="tp-top-feat-box" >
          <div class="tp-top-feat-img">
            <i class="fas fa-tags fa-3x"></i>
          </div>
          <div class="tp-top-feat-title">
            <h3>Competitive Pricing</h3>
            <p>High-quality products at competitive prices in Indonesia.</p>
          </div>
        </div>
        
        <!-- Quality Control -->
        <div class="tp-top-feat-box" >
                    <div class="tp-top-feat-img">
            <i class="fas fa-certificate fa-3x"></i>
          </div>
          <div class="tp-top-feat-title">
            <h3>Quality Control</h3>
            <p>Consistent supervision to ensure product quality.</p>
          </div>
        </div>
        
        <!-- Timely Delivery -->
        <div class="tp-top-feat-box" >
                    <div class="tp-top-feat-img">
            <i class="fas fa-truck fa-3x"></i>
          </div>
          <div class="tp-top-feat-title">
            <h3>Timely Delivery</h3>
            <p>On-time delivery builds trust with partners.</p>
          </div>
        </div>
        
        <!-- After-Sales Support -->
        <div class="tp-top-feat-box" >          <div class="tp-top-feat-img">
            <i class="fas fa-headset fa-3x"></i>
          </div>
          <div class="tp-top-feat-title">
            <h3>After-Sales Support</h3>
            <p>Comprehensive support and service post-purchase.</p>
          </div>
        </div>
        
        <!-- Innovation & Improvement -->
        <div class="tp-top-feat-box" >
                    <div class="tp-top-feat-img">
            <i class="fas fa-lightbulb fa-3x"></i>
          </div>
          <div class="tp-top-feat-title">
            <h3>Innovation & Improvement</h3>
            <p>Fostering research for enhanced customer productivity.</p>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>


    
    
<div class="containers">
    <div class="best-selling-products">
        <h2>Best Selling Products</h2>
        <div class="product-grid">
            <?php
            // Query untuk mengambil data produk terbaik
            $sql = "SELECT id, name, image_url, link FROM best_selling_products";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0):
                // Loop untuk menampilkan setiap produk
                while($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                        <div class="product-info">
                            <h3><?php echo $row['name']; ?></h3>
                            <a href="<?php echo $row['link']; ?>" class="btn">Buy Now</a>
                        </div>
                    </div>
                <?php endwhile;
            else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

      

</section>
</div>
  
<?php

$query = "SELECT * FROM articles";
$result = mysqli_query($conn, $query);
?>
    <!-- Blog Section -->
<div class="article-wrap">
  <div class="article-container">
      <div class="article-header">
          <h3>Article</h3>
          <h2>Our Latest Articles</h2>
      </div>
      <div class="article-grid">
    <?php while($article = mysqli_fetch_assoc($result)) { ?>
        <div class="article-item">
            <div class="article-image">
                <a href="#">
                    <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" />
                </a>
                <div class="article-date">
                    <a href="#"><?php echo date("d F Y", strtotime($article['date'])); ?></a>
                </div>
            </div>
            <div class="article-content">
                <a href="#">
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                </a>
                <p><?php echo htmlspecialchars($article['content']); ?></p>
                <a href="#" class="article-btn">READ MORE</a>
            </div>
        </div>
    <?php } ?>
</div>

<!-- WhatsApp Floating Icon -->
<a href=https://api.whatsapp.com/send?phone=628176565099&text=" class="whatsapp_float" target="_blank">
  <i class="fab fa-whatsapp"></i>
</a>


<a href="https://www.instagram.com/unitedheater/" class="instagram_float" target="_blank">
  <i class="fab fa-instagram"></i>
</a>
           

    
    <!-- Portfolio Client Section -->
    <div class="tp-portfolio">
    <div class="tp-container">
      <div class="tp-portfolio-title tp-title-con">
        <h3>OUR CLIENTS</h3>
        <h2>Here are some of the amazing clients we have worked with so far</h2>
      </div>
      <div class="tp-portfolio-content">
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_toyo_seal_indonesia.png" alt="Client 1" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_toray.png" alt="Client 1" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_takagi_sari.png" alt="Client 2" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_synergi_prima_persada_0.png" alt="Client 3" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_pura_barutama.png" alt="Client 4" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_panverta_cakrakencana.png" alt="Client 5" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_nissin_biscuit_indonesia.png" alt="Client 6" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_multi_spunindo_jaya.png" alt="Client 7" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_muliaglass.png" alt="Client 8" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_mattel.png" alt="Client 9" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_lion_wings.png" alt="Client 10" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_komatsu_undercarriage.png" alt="Client 11" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_kencar_sukses_investama.png" alt="Client 12" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_indah_kiat.png" alt="Client 13" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_honda_lock_indonesia.png" alt="Client 14" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_hartono_polytron.png" alt="Client 15" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_framas_indonesia.png" alt="Client 16" />
        </div>
        <div class="tp-client-logo">
          <img src="https://unitedheater.co.id/sites/default/files/logo/pt_federal_karyatama.png" alt="Client 17" />
        </div>
      </div>
    </div>
    </div>
    
   

    <div class="tp-footer">
        <div class="tp-container">
          <div class="tp-footer-wrap">
            <div class="tp-footer-top">
              <div class="tp-foot-content">
                <div class="tp-logo-img">
                  <a href="index.html">
               
                  </a>
                </div>
                <div class="tp-logo-content">
                  <p>
                    United Heater, a proud product of PT Usaha Saudara Mandiri, is a leading brand in heating equipment, based in Tangerang, West Java. We are committed to delivering high-quality heating solutions that enhance industries across Indonesia and Southeast Asia.
                  </p>
                </div>
              </div>
              <div class="tp-foot-menu">
                <h3>Kantor Pusat</h3>
                <p style="color: white;">Perkantoran Hayam Wuruk Plaza Tower  Lantai 16 Unit J
                Jl. Hayam Wuruk No. 108, Jakarta Barat 11160 
              </p>
                </ul>
              </div>
              <div class="tp-foot-menu tp-foot-twit">
                <h3>CONTACT US</h3>
                <div class="tp-foot-con">
                  <img
                    src=""
                    alt=""
                  />
                  <a href="#"
                    ><span>Email</a
                  >
                  <h5> marketing@unitedheater.co.id</h5>
                  <br />
                  <img
                  src=""                
                  alt=""
                  />
                  <a href="#"
                    ><span>Telp</span></a
                  >
                  <h5>021 6242 510 </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div style="background-color: rgb(255, 0, 0);" class="tp-foot-copy">
        <div class="tp-container" >
          <div class="tp-foot-wrap">
            <h5 style="color: white;">Copyright © 2024 United Heater</h5>
          </div>
        </div>
      </div>

 
    <script>
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
   
  </body>
</html>

<style >


.tp-banner {
    position: relative;
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}
.mySwiper {
    width: 100%;
    height: 500px;
}
.swiper-slide {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #000;
}
.swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.6); 
}

/* Caption Styling */
.caption {
    position: absolute;
    left: 10%;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    max-width: 50%;
    background: rgba(0, 0, 0, 0.5);
}

.caption h2 {
  color: white;
    font-size: 2em;
    margin-bottom: 0.5em;
}
.caption p {
    font-size: 1em;
    line-height: 1.5em;
}

/* Swiper Pagination and Navigation */
.swiper-pagination {
    bottom: 10px;
}
.swiper-button-next, .swiper-button-prev {
    color: #fff;
}


        

.containers {
  max-width: 1200px;
  margin: auto;
  background-color: #ffffff;
  padding: 50px;
  border-radius: 10px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}


header {
  text-align: center;
  margin-bottom: 40px;
}

header h1 {
  font-size: 36px;
  color: #ce181e;
  font-weight: 700;
  letter-spacing: 2px;
}

header p {
  font-size: 18px;
  color: #555;
  margin-top: 10px;
}

/* Section Titles */
h2 {
  font-size: 28px;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
  font-weight: 600;
}

/* About Section */
.about-section {
  text-align: center;
  margin-bottom: 40px;
}

.about-section p {
  font-size: 16px;
  color: #666;
  line-height: 1.8;
  max-width: 900px;
  margin: 0 auto;
}

.containere {
    display: flex;
    justify-content: space-between;
    padding: 50px;
    min-height: min-content;
}
.container-about{
 
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
  

}

/* Vision and Mission Section */
.vision-mission {
    flex: 1;
    padding-right: 50px;
}

.vision, .mission {
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.vision h3, .mission h3 {
    color: red;
    margin-bottom: 10px;
}

.vision p, .mission p {
    font-size: 16px;
    line-height: 1.6;
}

/* Core Values Section */
.core-values {
    flex: 1;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.core-values h3 {
    text-align: center;
    margin-bottom: 20px;
}

.value-item {
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.value-item h4 {
    color: red;
    margin-bottom: 10px;
}

.value-item p {
    font-size: 16px;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .vision-mission {
        padding-right: 0;
        margin-bottom: 20px;
    }
}

/* Hover Effects */
.vision-box:hover, .mission-box:hover, .core-value:hover {
  background-color: #f2f2f2;
  transition: 0.3s ease-in-out;
}




.tp-banner img {
  width: 100%;
 object-fit: cover;
  border-radius: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .vision-mission {
      flex-direction: column;
      gap: 30px;
  }

  header h1 {
      font-size: 28px;
  }

  h2 {
      font-size: 24px;
  }
}
.product-advantages {
    text-align: center;
    padding: 60px 20px; 
    background: linear-gradient(to right, #f8f8f8, #eaeaea); 
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
}

.product-advantages h2 {
    font-size: 36px;
    color: #333;
    margin-bottom: 40px;
    font-weight: 700;
    position: relative;
}

.product-advantages h2::after {
    content: "";
    display: block;
    width: 50px; 
    height: 4px; 
    background-color: #ce181e;
    margin: 10px auto 0;}

.advantages-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid layout */
    gap: 30px; /* Space between cards */
}

.advantage-card {
    background-color: white;
    padding: 20px;
    border-radius: 20px; /* Rounded corners for the card */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Soft shadow */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth transition */
    text-align: center;
    cursor: pointer; /* Pointer cursor for interactivity */
}

.advantage-card:hover {
    transform: translateY(-5px); /* Lift effect on hover */
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
    background-color: #f9f9f9; /* Subtle background color change on hover */
}

.advantage-card .icon {
    margin-bottom: 20px; /* Space below icon */
    font-size: 48px; /* Increase icon size */
    color: #ce181e; /* Icon color */
}

.advantage-card h3 {
    font-size: 20px; /* Increased font size for headings */
    color: #333; /* Heading color */
    margin: 10px 0;
    font-weight: 700;
}

.advantage-card p {
    font-size: 14px; /* Font size for the description */
    color: #666; /* Description color */
    line-height: 1.5; /* Line height for readability */
}

/* Responsive design adjustments */
@media (max-width: 768px) {
    .product-advantages {
        padding: 40px 10px; /* Adjust padding for smaller screens */
    }
    .advantages-container {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* More columns on smaller screens */
    }
}

/* Best Selling Products Section */
.best-selling-products {
  text-align: center;

  padding: 20px;
}

.best-selling-products h2 {
  font-size: 36px;
  margin-bottom: 40px;
  color: #ce181e;
}

/* Product Grid Layout */
.product-grid {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 40px;
}

.product-card {
  background-color: #fff;
  border: 2px solid #ce181e;
  border-radius: 10px;
  overflow: hidden;
  width: 250px; /* Menjaga ukuran tetap */
  text-align: center;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
}

.product-card:hover {
  transform: translateY(-10px);
}

.product-card img {
  width: 100%;
  height: auto;
  object-fit: cover;
}

.product-info {
  padding: 20px;
}

.product-info h3 {
  font-size: 18px;
  margin: 10px 0;
  color: #333;
}

.product-info .btn {
  background-color: #ce181e;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
  display: inline-block;
  margin-top: 15px;
  transition: background-color 0.3s ease;
}

.product-info .btn:hover {
  background-color: #a51414;
}


.product-grid {
  justify-content: space-around;
}

/* Adjust to 3 cards per row */
@media (min-width: 1024px) {
  .product-grid {
    justify-content: center;
  }
  .product-card {
    flex: 1 1 calc(33.333% - 30px); /* Mengatur 3 card per baris */
    max-width: 250px; /* Tetap menjaga lebar card */
  }
}

/* Responsive for tablet and smaller screens */
@media (max-width: 1024px) {
  .product-card {
    flex: 1 1 calc(50% - 30px); /* Dua card per baris di layar tablet */
  }
}

@media (max-width: 768px) {
  .product-card {
    flex: 1 1 100%; /* Satu card per baris di layar smartphone */
  }
}


/*--- Article Section ---*/
.article-wrap {
    padding: 60px 0;
    background-color: white;
}

.article-header {
    text-align: center;
    margin-bottom: 40px;
}

.article-header h3 {
    font-size: 24px;
}

.article-header h2 {
    font-size: 36px;
}

.article-grid {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.article-item {
    width: 25%; 
    padding: 20px;
    background-color: white;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.4s ease-in-out;
    margin-bottom: 20px;
}

.article-item:hover {
    transform: scale(1.05);
    z-index: 2;
}

.article-image {
    position: relative;
}

.article-image img {
    width: 100%;
    height: auto;
}

.article-date {
    position: absolute;
    left: 10px;
    bottom: 10px;
    background-color: #ce181e;
    color: white ;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 3px;
}

.article-content {
    padding: 20px;
}

.article-content h3 {
    font-size: 20px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.article-content p {
    font-size: 14px;
    line-height: 24px;
    color: #555;
    margin-bottom: 15px;
}

.article-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ce181e;
    color: white;
    border-radius: 5px;
    font-weight: 700;
    text-decoration: none;
    transition: background-color 0.3s;
}

.article-btn:hover {
    background-color: #3e0202;
}




/* client*/
      .tp-client-container {
        width: 768px;
    }
      .tp-portfolio {
        padding: 60px 0;
        background-color: #f8f8f8;
      }
    
      .tp-portfolio-title {
        text-align: center;
        margin-bottom: 40px;
      }
    
      .tp-portfolio-title h3 {
        font-size: 24px;
        margin-bottom: 10px;
      }
    
      .tp-portfolio-title h2 {
        font-size: 36px;
      }
    
      .tp-portfolio-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
      }
    
      .tp-client-logo {
        flex: 1 1 15%;
        max-width: 150px;
        margin: 10px;
      }
     
      
       
      .tp-client-logo img {
        width: 100%;
        border-radius: 30px;
        height: auto;
        opacity: 0.8;
        transition: opacity 0.3s ease;
      }
    
      .tp-client-logo img:hover {
        opacity: 1;
      }
      
      .tp-title-con h3 {
    color: #ce181e;
    letter-spacing: 2px;
    font-size: 16px;
    margin-bottom: 15px;
    text-align: center;
      }


      

      .instagram_float {
  position: fixed;
  width: 50px;
  height: 50px;
  bottom: 20px;
  right: 20px;
  background-color: #E1638F; /* Instagram pink */
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 32px;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease-in-out;
  z-index: 1000;
  animation: pulse 2s infinite;
}

.instagram_float:hover {
  background-color: #C13584; /* Darker pink on hover */
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
  transform: translateY(-10px); /* Elevate button on hover */
}

.instagram_float i {
  animation: shake 1s ease infinite;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes shake {
  0%,
  100% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(-10deg);
  }
  50% {
    transform: rotate(10deg);
  }
  75% {
    transform: rotate(-10deg);
  }
}

     


/* Overlay style */
.overlay {
  position: fixed;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  z-index: 99;
}

/* Drawer Style */
.drawer {
  position: fixed;
  top: 0;
  right: -100%;
  width: 80%;
  max-width: 250px;
  height: 100%;
  background-color: rgba(206, 24, 30, 0.9);
  color: white;
  transition: 0.3s;
  z-index: 100;
  padding-top: 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
  overflow-y: auto;
}

.drawer-menu {
  list-style: none;
  padding: 0;
  
  margin: 90px 16px;
}

.drawer-menu li {
  padding: 18px 20px;
}

.drawer-menu li a {
  text-decoration: none;
  color: white;
  font-size: 18px;
}

.drawer-menu li a i {
  margin-right: 10px;
}

/* Show Drawer */
.drawer.show {
  right: 0;
}


.overlay.show {
  display: block;

 
}

/* Hide the drawer on larger screens */
@media screen and (min-width: 769px) {
  .drawer, .overlay {
    display: none;
  }


  
}

</style>
</html>

