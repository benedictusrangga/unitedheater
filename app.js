const { app } = require('./server');
const authRoutes = require('./auth');
const bannerRoutes = require('./routes/bannerRoutes');
const productRoutes = require('./routes/productRoutes');

app.use('/api', bannerRoutes);
app.use('/api', productRoutes);

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
