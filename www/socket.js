var io = require('socket.io')(6001, {
		origins: 'nv-laravel-events-test.com:*'
	}),
	Redis = require('ioredis'),
	redis = new Redis();

redis.subscribe('charts', function(err, count) {
});

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data.chartId);
});