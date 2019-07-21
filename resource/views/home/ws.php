<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
	<h1>webscoketdddddddddd.html文件内容</h1>


	<div>
		<div>请输入发送内容:<input id="input" type="text" name="send" value="" ></div>
		<div onclick="send()">发送</div>
		<div id="data"></div>
	</div>


	<script>
		var url = "ws://127.0.0.1:18308/test";
		var scoket = new WebSocket(url);

		scoket.onopen = function(evt){
			scoket.send('{"cmd":"test.index","data":"say hello","ext":"optional ext"}');
			console.log("Connection open ..."); 
		}

		scoket.onmessage = function(evt){
			console.log('server receive data'+evt.data);
			var show = document.getElementById('data');
			show.append('<div>'+evt.data+'</div>');
		}

		scoket.onclose = function(evt){
			console.log("Connection closed ..."); 
		}

		function send()
		{
			var input = document.getElementById('input');
            var msg = '{"cmd":"test.index","data":"'+input.value+'","ext":"optional ext"}';
			scoket.send(msg);
		}

	</script>

</body>
</html>