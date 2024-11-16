const multer = require('multer');
const path = require('path');

// Configure multer storage for banners
const bannerStorage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'uploads/foto/banner');
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname));
    }
});
const bannerUpload = multer({ storage: bannerStorage });

// Configure multer storage for products
const productStorage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'uploads/foto/best_selling');
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname));
    }
});
const productUpload = multer({ storage: productStorage });

module.exports = { bannerUpload, productUpload };
