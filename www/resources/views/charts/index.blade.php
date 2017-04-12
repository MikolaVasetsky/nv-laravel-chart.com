<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>My Charts</title>

		{!! Charts::assets() !!}

	</head>
	<body>
		@foreach( $renderCharts as $chart )
			<div class="chart container_chart_{{ $chart->id }}">
				<div>
					<input data-chart="{{ $chart->id }}" type="button" value="bar" class="change_chart active">
					<input data-chart="{{ $chart->id }}" type="button" value="line" class="change_chart">
					<input data-chart="{{ $chart->id }}" type="button" value="pie" class="change_chart">
					<a href="{{route('charts.edit', $chart->id)}}">Edit</a>
				</div>

				<div id="chart_{{ $chart->id }}">
					{!! $chart !!}
				</div>
			</div>
		@endforeach

		<script src="{{ asset('js/socket.io.js') }}"></script>

		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			var socket = io(':6001');
			socket.on("charts:changeChart", function(chart){
				console.log(chart);
				var type = $('.container_chart_' + chart).find('.change_chart.active').val();
				console.log(type);
				changeChart(type, chart);
			});

			$(function() {
				$(document).on('click', '.change_chart', function () {
					var chart = $(this).data('chart');
					var type = $(this).val();
					changeChart(type, chart);
				});
			});

			function changeChart(type, chart) {
				$.ajax({
					url: '/charts/change-type',
					type: "POST",
					data: {
						type: type,
						chart: chart
					},
					success: function (response) {
						$('#chart_' + chart).html(response);
					},
					error: function () {
						alert('Error');
					}
				});
			}
		</script>
	</body>
</html>