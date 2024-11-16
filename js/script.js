

//navbar

fetch('templates/navbar.html') 
    .then(response => response.text()) 
    .then(data => document.getElementById('navbar-container').innerHTML = data); 


//banner

fetch('http://localhost:3000/banners')
.then(response => response.json())
.then(banners => {
    const container = document.getElementById('banner-container');
    
    banners.forEach(banner => {
        const slide = document.createElement('div');
        slide.classList.add('swiper-slide');
        
        const img = document.createElement('img');
        img.src = banner.image;
        img.alt = banner.title;
        
        const caption = document.createElement('div');
        caption.classList.add('caption');
        
        const title = document.createElement('h2');
        title.textContent = banner.title;
        
        const description = document.createElement('p');
        description.textContent = banner.description;
        
        caption.appendChild(title);
        caption.appendChild(description);
        slide.appendChild(img);
        slide.appendChild(caption);
        
        container.appendChild(slide);
    });


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
})
.catch(error => {
    console.error('Error fetching banner data:', error);
});


//topfeat.js
// Menambahkan event listener saat halaman dimuat
  document.addEventListener('DOMContentLoaded', function () {
      fetch('http://localhost:3000/features')
        .then(response => response.json())
        .then(features => {
         
          const featuresContainer = document.getElementById('features-container');
          features.forEach(feature => {
            const featureBox = document.createElement('div');
            featureBox.classList.add('tp-top-feat-box');
    
            const featureImg = document.createElement('div');
            featureImg.classList.add('tp-top-feat-img');
            const icon = document.createElement('i');
            icon.classList.add(...feature.icon_class.split(' '), 'fa-3x'); 
            featureImg.appendChild(icon);
    
            const featureTitle = document.createElement('div');
            featureTitle.classList.add('tp-top-feat-title');
            const title = document.createElement('h3');
            title.textContent = feature.title;
            const description = document.createElement('p');
            description.textContent = feature.description;
            featureTitle.appendChild(title);
            featureTitle.appendChild(description);
    
            featureBox.appendChild(featureImg);
            featureBox.appendChild(featureTitle);
    
            featuresContainer.appendChild(featureBox);
          });
        })
        .catch(error => console.error('Error loading features:', error));
    });



    //best-selling
    

// Fetch data produk terbaik dari server
fetch('http://localhost:3000/best-selling-products')
    .then(response => response.json())
    .then(products => {
        const productGrid = document.getElementById('product-grid');
        
        // Loop untuk menampilkan setiap produk
        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.classList.add('product-card');
            
            const img = document.createElement('img');
            img.src = product.image_url;
            img.alt = product.name;
            
            const productInfo = document.createElement('div');
            productInfo.classList.add('product-info');
            
            const title = document.createElement('h3');
            title.textContent = product.name;
            
            const buyNowLink = document.createElement('a');
            buyNowLink.href = product.link;
            buyNowLink.classList.add('btn');
            buyNowLink.textContent = 'Pemesanan';
            
            productInfo.appendChild(title);
            productInfo.appendChild(buyNowLink);
            productCard.appendChild(img);
            productCard.appendChild(productInfo);
            
            productGrid.appendChild(productCard);
        });
    })
    .catch(error => {
        console.error('Error fetching products:', error);
    });


    //artikel
    
fetch('http://localhost:3000/articles')
    .then(response => response.json())
    .then(articles => {
        const articleGrid = document.getElementById('article-grid');
        
        // Loop untuk menampilkan setiap artikel
        articles.forEach(article => {
            const articleItem = document.createElement('div');
            articleItem.classList.add('article-item');
            
            // Artikel gambar
            const articleImage = document.createElement('div');
            articleImage.classList.add('article-image');
            
            const linkImage = document.createElement('a');
            linkImage.href = "#";
            
            const img = document.createElement('img');
            img.src = article.image_url;
            img.alt = article.title;
            
            linkImage.appendChild(img);
            articleImage.appendChild(linkImage);
            
            // Artikel tanggal
            const articleDate = document.createElement('div');
            articleDate.classList.add('article-date');
            
            const dateLink = document.createElement('a');
            const date = new Date(article.date);
            dateLink.href = "#";
            dateLink.textContent = date.toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' });
            
            articleDate.appendChild(dateLink);
            articleImage.appendChild(articleDate);
            
            // Artikel konten
            const articleContent = document.createElement('div');
            articleContent.classList.add('article-content');
            
            const titleLink = document.createElement('a');
            titleLink.href = "#";
            
            const title = document.createElement('h3');
            title.textContent = article.title;
            
            titleLink.appendChild(title);
            articleContent.appendChild(titleLink);
            
            const content = document.createElement('p');
            content.textContent = article.content;
            
            articleContent.appendChild(content);
            
            const readMoreLink = document.createElement('a');
            readMoreLink.href = "#";
            readMoreLink.classList.add('article-btn');
            readMoreLink.textContent = 'Baca Selengkapnya';
            
            articleContent.appendChild(readMoreLink);
            
            // Gabungkan semua bagian artikel
            articleItem.appendChild(articleImage);
            articleItem.appendChild(articleContent);
            
            // Masukkan artikel ke dalam grid
            articleGrid.appendChild(articleItem);
        });
    })
    .catch(error => {
        console.error('Error fetching articles:', error);
    });

//footer
    fetch('templates/footer.html')
        .then(response => response.text())
        .then(data => document.getElementById('footer-container').innerHTML = data);



  //logohome
  document.addEventListener("DOMContentLoaded", function () {
    fetch('http://localhost:3000/client-logos')
        .then(response => response.json())
        .then(data => {
            const portfolioContent = document.getElementById('tp-portfolio-content');
            data.forEach(client => {
                const clientLogo = document.createElement('div');
                clientLogo.classList.add('tp-client-logo');
                clientLogo.innerHTML = `<img src="${client.logo_url}" alt="${client.alt_text}" />`;
                portfolioContent.appendChild(clientLogo);
            });
        })
        .catch(error => console.error('Error fetching client logos:', error));
});

//track order


document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    const poNumber = document.getElementById("po_number").value;

    fetch(`api/api.php?po_number=${poNumber}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById("error-message").textContent = data.error;
                document.getElementById("order-details").style.display = "none";
            } else if (data.length > 0) {
                document.getElementById("error-message").textContent = "";
                document.getElementById("order-details").style.display = "block";
                document.getElementById("customer-name").textContent = `Nama Perusahaan: ${data[0].CUSTOMER_NAME}`;

                const tableBody = document.getElementById("order-table-body");
                tableBody.innerHTML = "";

                data.forEach(item => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${item.No_Item_Accurate}</td>
                        <td>${item.NAMA_BARANG}</td>
                        <td>${item.QTY_SPK}</td>
                        <td>${getStatus(item)}</td>
                        <td>${item.qty_kirim || ""}</td>
                        <td>${item.tgl_kirim || ""}</td>
                    `;
                    tableBody.appendChild(row);
                });
            } else {
                document.getElementById("error-message").textContent = "Order tidak ditemukan.";
                document.getElementById("order-details").style.display = "none";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            document.getElementById("error-message").textContent = "Terjadi kesalahan saat mengambil data.";
            document.getElementById("order-details").style.display = "none";
        });
});

function getStatus(item) {
    const currentDate = new Date().toISOString().split("T")[0];
    if (!item.Tgl_QC_OK && !item.qty_kirim && !item.tgl_kirim) {
        return '<span class="status-icon produksi"></span> Produksi';
    } else if (item.Tgl_QC_OK && !item.qty_kirim && currentDate >= item.Tgl_QC_OK) {
        return '<span class="status-icon pengemasan"></span> Pengemasan';
    } else if (item.tgl_kirim && item.qty_kirim > 0) {
        return '<span class="status-icon terkirim"></span> Terkirim';
    } else if (item.tgl_kirim && !item.qty_kirim) {
        return '<span class="status-icon pengiriman"></span> Pengiriman';
    } else {
        return '<span class="status-icon produksi"></span> Produksi';
    }
}
