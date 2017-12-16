var fs = require('fs');
var express = require('express');
var hskey = fs.readFileSync('ssl-certificate/dhavalshah.pem');
var hscert = fs.readFileSync('ssl-certificate/gd_bundle-g2-g1.crt')
var options = {
    key: hskey,
    cert: hscert
};

//Create server
var app = express(options);

//app.all('/*', function(req, res, next) {
//  res.header("Access-Control-Allow-Origin", "*");
//  res.header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
//  res.header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length, X-Requested-With, *');
//  next();
//});

app.use(function (req, res, next) {

    // Website you wish to allow to connect
    res.setHeader('Access-Control-Allow-Origin', 'http://35.165.1.109:3000');

    // Request methods you wish to allow
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

    // Request headers you wish to allow
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');

    // Set to true if you need the website to include cookies in the requests sent
    // to the API (e.g. in case you use sessions)
    res.setHeader('Access-Control-Allow-Credentials', true);

    // Pass to next layer of middleware
    next();
});



//Start server
//var port = nconf.get('port');;
var port = process.env.PORT || 3000;
var server = require('https').createServer(app),
    io = require('socket.io').listen(server);
server.listen(port, function () {

    console.log('Express server listening on port %d in %s mode', port, app.settings.env);
});

io.on('connection', function (socket) {

    socket.on('notification_count', function (data) {
        console.log(data);
        io.sockets.emit('notification_count', {
            notification_count: data.notification_count,
            to_id: data.to_id,
        });
    });
    
    socket.on('contact_request_count', function (data) {
        console.log(data);
        io.sockets.emit('contact_request_count', {
            contact_request_count: data.contact_request_count,
            contact_to_id: data.contact_to_id,
        });
    });


    socket.on('new_count_message', function (data) {
        io.sockets.emit('new_count_message', {
            new_count_message: data.new_count_message

        });
    });

    socket.on('update_count_message', function (data) {
        io.sockets.emit('update_count_message', {
            update_count_message: data.update_count_message
        });
    });

    socket.on('new_message', function (data) {
        io.sockets.emit('new_message', {
            name: data.name,
            email: data.email,
            subject: data.subject,
            created_at: data.created_at,
            id: data.id
        });
    });


});
