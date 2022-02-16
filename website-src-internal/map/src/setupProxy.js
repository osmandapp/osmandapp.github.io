const { createProxyMiddleware } = require('http-proxy-middleware');
module.exports = function (app) {
    let proxy = createProxyMiddleware({
        target: 'http://localhost:8080/',
        changeOrigin: true,
        hostRewrite: 'localhost:3000',
        logLevel: 'debug'
    });
    let testProxy = createProxyMiddleware({
        target: 'http://test.osmand.net/',
        changeOrigin: true,
        hostRewrite: 'localhost:3000',
        logLevel: 'debug'
    });
    app.use('/mapapi/', Proxy);
    app.use('/routing/', Proxy);
    app.use('/gpx/', Proxy);
    app.use('/tile/', Proxy);
    app.use('/weather-api/', Proxy);
    // app.use('/weather-api/', testProxy);
    
};
