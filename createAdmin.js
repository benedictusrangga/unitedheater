const bcrypt = require('bcrypt');
const mysql = require('mysql2');

// Create a database connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', 
    password: '', 
    database: 'united'
});

// Admin credentials
const username = 'admina';
const password = 'admina';

// Hash the password before saving it
bcrypt.hash(password, 10, (err, hash) => {
    if (err) throw err;

    // Insert the admin with hashed password
    db.query(
        'INSERT INTO admins (username, password) VALUES (?, ?)',
        [username, hash],
        (error, results) => {
            if (error) throw error;
            console.log('Admin user created successfully');
            db.end();
        }
    );
});
