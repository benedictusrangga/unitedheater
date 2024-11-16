// fileHelper.js
const fs = require('fs');
const path = require('path');
const db = require('./database'); // Import koneksi database Anda

// Fungsi untuk menghapus gambar lama dari server
function deleteImageFromServer(imageUrl) {
    const imagePath = path.join(__dirname, 'uploads', imageUrl);
    fs.unlink(imagePath, (err) => {
        if (err) console.error('Error deleting image:', err);
        else console.log('Image deleted successfully');
    });
}

// Fungsi template untuk mengedit data dengan opsi pembaruan gambar
function updateRecordWithImage(table, id, data, file, callback) {
    db.query(`SELECT image_url FROM ${table} WHERE id = ?`, [id], (err, results) => {
        if (err) return callback(err);
        if (results.length === 0) return callback(null, { message: 'Record not found' });

        // Jika ada file baru, hapus gambar lama
        if (file) {
            deleteImageFromServer(results[0].image_url);
            data.image_url = `/uploads/foto/${table}/${file.filename}`;
        }

        // Buat query dinamis untuk pembaruan data
        const columns = Object.keys(data).map(col => `${col} = ?`).join(', ');
        const values = [...Object.values(data), id];

        db.query(`UPDATE ${table} SET ${columns} WHERE id = ?`, values, (err, results) => {
            if (err) return callback(err);
            callback(null, { message: 'Record updated successfully' });
        });
    });
}

// Fungsi template untuk menghapus data beserta gambar
function deleteRecordWithImage(table, id, callback) {
    db.query(`SELECT image_url FROM ${table} WHERE id = ?`, [id], (err, results) => {
        if (err) return callback(err);
        if (results.length === 0) return callback(null, { message: 'Record not found' });

        // Hapus gambar lama
        deleteImageFromServer(results[0].image_url);

        // Hapus data dari database
        db.query(`DELETE FROM ${table} WHERE id = ?`, [id], (err) => {
            if (err) return callback(err);
            callback(null, { message: 'Record deleted successfully' });
        });
    });
}

module.exports = {
    updateRecordWithImage,
    deleteRecordWithImage
};
