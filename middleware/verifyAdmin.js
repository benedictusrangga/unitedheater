// middleware/verifyAdmin.js
const jwt = require('jsonwebtoken');
require('dotenv').config();

function verifyAdmin(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];
    if (!token) return res.status(403).send('Token required');

    jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
        if (err) return res.status(403).send('Invalid token');
        
        if (user && user.role === 'admin') { 
            req.user = user;
            next();
        } else {
            return res.status(403).send('Access denied: Admins only');
        }
    });
}

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

module.exports = verifyAdmin;
