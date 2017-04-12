<script src="{{ asset('js/socket.io.js') }}"></script>
<script>
	var socket = io(':6001');
	socket.on("charts:changeChart", function(id){
		console.log(id);
	});
</script>