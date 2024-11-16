const express = require('express');
const router = express.Router();
const db = require('../db'); // file db untuk koneksi database
const multer = require('multer');
const path = require('path');
const fs = require('fs');
const { verifyToken } = require('../middleware/auth');

// Konfigurasi multer untuk banner
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'uploads/foto/banner');
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname));
    }
});
const upload = multer({ storage: storage });

// Rute untuk admin mengelola banner
router.post('/upload-banner', verifyToken, upload.single('bannerImage'), (req, res) => {
    const { title, description } = req.body;
    const imageUrl = '/uploads/foto/banner/' + req.file.filename;
    const sql = 'INSERT INTO banners (title, description, image_url) VALUES (?, ?, ?)';
    db.query(sql, [title, description, imageUrl], (err, results) => {
        if (err) return res.status(500).send('Database error');
        res.status(201).json({ message: 'Banner uploaded successfully' });
    });
});

// Rute lain untuk edit dan delete (ikuti pola yang sama seperti di atas)
// ...

module.exports = router;
