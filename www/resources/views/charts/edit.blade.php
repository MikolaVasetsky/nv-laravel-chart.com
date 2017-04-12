<!DOCTYPE html>
<html>
<head>
	<title>Edit chart</title>
</head>
<body>
	{!! Form::open(['route' => ['charts.update', $chart['id']], 'method' => 'PUT']) !!}
		<div>
			@foreach(json_decode($chart['values']) as $key => $value)
				{!! Form::number($key, $value, []) !!}
			@endforeach
		</div>
		{!! Form::submit('submit', []) !!}
	{!! Form::close() !!}
</body>
</html>