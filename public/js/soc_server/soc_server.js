var http = require('http');
var fs = require('fs');

var server = http.createServer(function(req, res) {
	fs.readFile('./index.html', function(err, html) {
		if (err) {
			console.log('[error]\t' + err + 'iets');
		}
	
		if (req.url == '/') {
        	res.writeHead(200, {'Content-Type': 'text/html'});
        	res.write(html);
        	console.log('[ok]\tConnection on the webpage');

        	res.end();
    	} else {
        	res.end('Slechte iets aanvraag en $hit');
    	}
	});
});

var os = require('os');
var ni = os.networkInterfaces();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis({
	port: 6379,
	host: "127.0.0.1",
	db: 0,
});
const PORT = 5000;

io.sockets.setMaxListeners(0);

io.on('connection', function(socket) {
    var client_addr = socket.handshake.address;
    console.log("[ok]\tUser: " + socket.id + " connected\t" + new Date().toLocaleTimeString());
    console.log('[ok]\tClient ip: ' + client_addr);

    socket.on('disconnect', function(msg) {
        console.log("[ok]\tUser: " + socket.id + " disconnected\t" + new Date().toLocaleTimeString());
		if (socket.removeAllListeners()) {
			console.log("[ok]\tAlle clients zijn verwijderd");
		}
    });
    
    socket.on('slide event', function(msg) {
        io.emit('slide event', msg);
    });

    socket.on('widget event', function(msg) {
        io.emit('widget event', msg);
    });

	socket.on('setting event', function(msg) {
		io.emit('setting event', msg);	
	});
});

redis.subscribe('laravel_database_slide-event', function(err, count){
    console.log("[error]\t"+err);
});

redis.on('message', function(channel, message) {
   	var p_message = JSON.parse(message);
   	console.log('[ok]\tConnected to channel: ' + channel);
   	console.log('[ok]\tMessage recieved\t' + new Date().toLocaleTimeString());
   	console.log('[ok]\tTask: ' + p_message.data.task);
        
   	if (typeof p_message.data.slides != 'undefined') {
      	if (p_message.data.slides) {
         	io.emit('slide event', { slides: p_message.data.slides, todo: p_message.data.task });
         	console.log('[ok]\tSlides broadcasted successfully in socket:\tslide event');
      	} else {
          	console.log('[error]\tSlide broadcasting occurred an error');
      	}
   	}

	if (typeof p_message.data.widgets != 'undefined') {
      	if (p_message.data.widgets) {
         	io.emit('widget event', { widgets: p_message.data.widgets, todo: p_message.data.task });
         	console.log('[ok]\tWidgets broadcasted successfully in socket:\twidget event');
      	} else {
          	console.log('[error]\tWidget broadcasting occured an error');
    	}
    }

	if (typeof p_message.data.settings != 'undefinded') {
		if (p_message.data.settings) {
			io.emit('setting event', { settings: p_message.data.settings, todo: p_message.data.task });
			console.log('[ok]\tSettings broadcasted successfully in socket:\tsetting event');
		} else {
			console.log('[error]\tSettings broadcasting occured an error');
		}
	}
});


if(server.listen(PORT, '127.0.0.1' )) {
    console.log('[ok]\tServer connected!!');
    console.log('[ok]\tServer host: '+ '127.0.0.1' + ':' + PORT);
}
