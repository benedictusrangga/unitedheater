const express = require('express');
const router = express.Router();
const db = require('../db'); 

// Rute untuk user melihat banner
router.get('/banners', (req, res) => {
    db.query('SELECT id, image_url AS image, title, description FROM banners', (err, results) => {
        if (err) return res.status(500).send(err);
        res.json(results);
    });
});

// Rute lain untuk fitur yang bisa diakses user
// ...

module.exports = router;
