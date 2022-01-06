const { createProxyMiddleware } = require('http-proxy-middleware');
module.exports = function (app) {
    let proxy = createProxyMiddleware({
        // target: 'http://localhost:8080/',
         target: 'http://test.osmand.net/',
        changeOrigin: true,
        hostRewrite: 'localhost:3000',
        logLevel: 'debug'
    });
    app.use('/map/api/', proxy);
    app.use('/gpx/', proxy);
};