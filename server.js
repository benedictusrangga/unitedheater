const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const cors = require('cors');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
require('dotenv').config();
const multer = require('multer');
const path = require('path');
const fs = require('fs');

// Configure multer storage for banner images
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'uploads/foto/banner');
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname));
    }
});

const upload = multer({ storage: storage });

const app = express();
app.use(cors());
app.use(bodyParser.json());
app.use(express.static('public'));

// Database connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'united'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL database');
});

// JWT token verification middleware
function verifyToken(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];
    if (!token) return res.status(403).send('Token required');

    jwt.verify(token, process.env.JWT_SECRET, (err, admin) => {
        if (err) return res.status(403).send('Invalid token');
        req.admin = admin;
        next();
    });
}

app.use(cors({
    origin: 'http://localhost:8080', 
    methods: ['GET', 'POST', 'PUT', 'DELETE'],
    allowedHeaders: ['Content-Type', 'Authorization']
}));

// Admin login route
app.post('/admin/login', (req, res) => {
    const { username, password } = req.body;

    db.query('SELECT * FROM admins WHERE username = ?', [username], (err, results) => {
        if (err) return res.status(500).send('Database error');
        if (results.length === 0) return res.status(401).send('User not found');

        const admin = results[0];

        bcrypt.compare(password, admin.password, (err, match) => {
            if (err) return res.status(500).send('Error comparing passwords');
            if (!match) return res.status(401).send('Incorrect password');

            const token = jwt.sign({ id: admin.id, username: admin.username }, process.env.JWT_SECRET, { expiresIn: '1h' });
            res.json({ message: 'Login successful', token });
        });
    });
});

// Route to get banners
app.get('/banners', (req, res) => {
    db.query('SELECT id, image_url AS image, title, description FROM banners', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results);
    });
});


app.get('/banners/:id', (req, res) => {
    const bannerId = req.params.id;  // Ambil ID dari parameter URL
    db.query('SELECT id, image_url AS image, title, description FROM banners WHERE id = ?', [bannerId], (err, results) => {
        if (err) return res.status(500).send(err);
        if (results.length === 0) {
            return res.status(404).json({ message: 'Banner not found' }); // Jika banner tidak ditemukan
        }
        res.json(results[0]);  // Mengirim banner pertama yang ditemukan
    });
});




// Route to upload banner
app.post('/admin/upload-banner', upload.single('bannerImage'), (req, res) => {
    const { title, description } = req.body;
    const imageUrl = '/uploads/foto/banner/' + req.file.filename;

    const sql = 'INSERT INTO banners (title, description, image_url) VALUES (?, ?, ?)';
    db.query(sql, [title, description, imageUrl], (err, results) => {
        if (err) return res.status(500).send('Database error');
        res.status(201).json({ message: 'Banner uploaded successfully' });
    });
});

// Route to edit banner
app.put('/admin/edit-banner/:id', upload.single('bannerImage'), (req, res) => {
    const { title, description } = req.body;
    let imageUrl = req.body.imageUrl;

    if (req.file) {
        db.query('SELECT image_url FROM banners WHERE id = ?', [req.params.id], (err, results) => {
            if (err) return res.status(500).send('Database error');
            if (results.length === 0) return res.status(404).send('Banner not found');

            // Pastikan oldImagePath didefinisikan di dalam callback query
            const oldImagePath = path.join(__dirname, 'uploads', 'foto', 'banner', path.basename(results[0].image_url));

            // Cek dan hapus gambar lama
            fs.access(oldImagePath, fs.constants.F_OK, (err) => {
                if (err) {
                    console.error('File does not exist:', oldImagePath);
                } else {
                    fs.unlink(oldImagePath, (err) => {
                        if (err) {
                            console.error('Error deleting old image:', err);
                        } else {
                            console.log('Old image deleted successfully');
                        }
                    });
                }
            });

            // Tentukan imageUrl untuk gambar baru
            imageUrl = '/uploads/foto/banner/' + req.file.filename;

            const sql = 'UPDATE banners SET title = ?, description = ?, image_url = ? WHERE id = ?';
            db.query(sql, [title, description, imageUrl, req.params.id], (err) => {
                if (err) return res.status(500).send('Database error');
                res.status(200).json({ message: 'Banner updated successfully' });
            });
        });
    } else {
        const sql = 'UPDATE banners SET title = ?, description = ? WHERE id = ?';
        db.query(sql, [title, description, req.params.id], (err) => {
            if (err) return res.status(500).send('Database error');
            res.status(200).json({ message: 'Banner updated successfully' });
        });
    }
});




// Route to delete banner
app.delete('/admin/delete-banner/:id', (req, res) => {
    db.query('SELECT image_url FROM banners WHERE id = ?', [req.params.id], (err, results) => {
        if (err) return res.status(500).send('Database error');
        if (results.length === 0) return res.status(404).send('Banner not found');

        const imagePath = path.join(__dirname, 'uploads', 'foto', 'banner', path.basename(results[0].image_url));


        fs.unlink(imagePath, (err) => {
            if (err) console.error('Error deleting image:', err);

            const sql = 'DELETE FROM banners WHERE id = ?';
            db.query(sql, [req.params.id], (err) => {
                if (err) return res.status(500).send('Database error');
                res.status(200).json({ message: 'Banner deleted successfully' });
            });
        });
    });
});


// Configure multer storage for product images
const productStorage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'uploads/foto/best_selling');  // Separate folder for product images
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname)); // Unique filename
    }
});

// Multer instance for product image uploads
const productUpload = multer({ storage: productStorage });

app.get('/best-selling-products', (req, res) => {
    db.query('SELECT id, name, image_url, link FROM best_selling_products', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results);
    });
});

// Get a single best selling product
app.get('/best-selling-products/:id', (req, res) => {
    const { id } = req.params;
    db.query('SELECT id, name, image_url, link FROM best_selling_products WHERE id = ?', [id], (err, results) => {
        if (err) return res.status(500).send(err);
        if (results.length === 0) return res.status(404).send('Product not found');
        res.json(results[0]);
    });
});

// Add new product
app.post('/admin/upload-product', productUpload.single('productImage'), (req, res) => {
    const { name, link } = req.body;
    const image_url = req.file ? `/uploads/foto/best_selling/${req.file.filename}` : null;
    db.query('INSERT INTO best_selling_products (name, image_url, link) VALUES (?, ?, ?)', [name, image_url, link], (err, results) => {
        if (err) return res.status(500).send(err);
        res.json({ message: 'Product added successfully' });
    });
});

// Edit best-selling product
app.put('/admin/edit-product/:id', productUpload.single('productImage'), (req, res) => {
    const { id } = req.params;
    const { name, link } = req.body;
    let image_url = req.body.image_url;

    if (req.file) {
        db.query('SELECT image_url FROM best_selling_products WHERE id = ?', [id], (err, results) => {
            if (err) return res.status(500).send('Database error');
            if (results.length === 0) return res.status(404).send('Product not found');

            const oldImagePath = path.join(__dirname, 'uploads', 'foto', 'best_selling', path.basename(results[0].image_url));

            // Delete old image from server
            fs.access(oldImagePath, fs.constants.F_OK, (err) => {
                if (!err) {
                    fs.unlink(oldImagePath, (err) => {
                        if (err) console.error('Error deleting old image:', err);
                        else console.log('Old image deleted successfully');
                    });
                }
            });

            // Set new image path
            image_url = `/uploads/foto/best_selling/${req.file.filename}`;

            const sql = 'UPDATE best_selling_products SET name = ?, link = ?, image_url = ? WHERE id = ?';
            db.query(sql, [name, link, image_url, id], (err) => {
                if (err) return res.status(500).send('Database error');
                res.json({ message: 'Product updated successfully' });
            });
        });
    } else {
        const sql = 'UPDATE best_selling_products SET name = ?, link = ? WHERE id = ?';
        db.query(sql, [name, link, id], (err) => {
            if (err) return res.status(500).send('Database error');
            res.json({ message: 'Product updated successfully' });
        });
    }
});

// Delete best-selling product
app.delete('/admin/delete-product/:id', (req, res) => {
    const { id } = req.params;

    db.query('SELECT image_url FROM best_selling_products WHERE id = ?', [id], (err, results) => {
        if (err) return res.status(500).send('Database error');
        if (results.length === 0) return res.status(404).send('Product not found');

        const imagePath = path.join(__dirname, 'uploads', 'foto', 'best_selling', path.basename(results[0].image_url));

        // Delete image from server
        fs.unlink(imagePath, (err) => {
            if (err) console.error('Error deleting image:', err);

            const sql = 'DELETE FROM best_selling_products WHERE id = ?';
            db.query(sql, [id], (err) => {
                if (err) return res.status(500).send('Database error');
                res.json({ message: 'Product deleted successfully' });
            });
        });
    });
});




// Rute untuk features
app.get('/features', (req, res) => {
    db.query('SELECT * FROM features', (err, results) => {
        if (err) {
            console.error(err);
            return res.status(500).send(err);
        }

        res.json(results);
    });
});

app.get('/client-logos', (req, res) => {
    db.query('SELECT image_url AS logo_url, alt_text FROM client_logos', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results);
    });
});


app.get('/barang', (req, res) => {
    db.query(
        'SELECT tipe_barang AS tipe, group_barang AS kategori, id AS nomor, image_url AS gambar, deskripsi_produk AS deskripsi FROM barang ORDER BY group_barang, id', 
        (err, results) => {
            if (err) return res.status(500).send(err);
            res.json(results); // Mengembalikan data produk dalam format JSON
        }
    );
});






    app.get('/artikel', (req, res) => {
        const query = `
            SELECT 
                id, 
                category AS kategori, 
                title AS judul, 
                image_url AS gambar, 
                summary AS ringkasan, 
                content AS konten 
            FROM artikel 
            ORDER BY category, id
        `;
        
        db.query(query, (err, results) => {
            if (err) {
                return res.status(500).send(err);
            }
            res.json(results); // Returns article data in JSON format
        });
    });
    












app.get('/jobs', (req, res) => {
    db.query('SELECT id, title, location, description, created_at, updated_at, responsibilities, requirements FROM jobs', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results); // This sends the data in JSON format
    });
});

app.get('/jobs/:id', (req, res) => {
    const { id } = req.params;
    db.query('SELECT id, title, location, description, responsibilities, requirements FROM jobs WHERE id = ?', [id], (err, results) => {
        if (err) return res.status(500).send(err);
        if (results.length === 0) {
            return res.status(404).send('Job not found');
        }
        res.json(results[0]); // Send back the job details as a JSON object
    });
});



app.get('/articles', (req, res) => {
    db.query('SELECT id, title, image_url, content, date FROM articles', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results); // Mengembalikan hasil dalam format JSON
    });
});


// JWT token verification middleware
function verifyToken(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];
    if (!token) return res.status(403).send('Token required');

    jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
        if (err) return res.status(403).send('Invalid token');
        req.user = user;
        next();
    });
}


// Middleware to check admin role
function verifyAdmin(req, res, next) {
    if (req.user.role !== 'admin') {
        return res.status(403).send('Access denied');
    }
    next();
}

// Admin route with token verification and role check
app.get('/admin', verifyToken, verifyAdmin, (req, res) => {
    res.send('Welcome Admin');
});




// Start server
app.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});
