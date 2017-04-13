<?php

namespace App\Http\Controllers;

use App\ChartsResult;
use Illuminate\Http\Request;
use App\Events\ChangeChart;
use Charts;

class ChartsResultController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// ChartsResult::create([
		//  'type' => 'bar',
		//  'title' => 'My chart 2',
		//  'labels' => json_encode([
		// 	 'label 5',
		// 	 'label 6',
		// 	 'label 7'
		//  ]),
		//  'values' => json_encode([
		// 	 14,
		// 	 36,
		// 	 55
		//  ])
		// ]);
		// die;
		$charts = ChartsResult::all();
		$countCharts = count($charts);
		$renderCharts = [];
		$showChartsIds = [];

		for ( $i = 0; $i < $countCharts; ++$i ) {
			$questionsId[$i] = $charts[$i]['question_id'];
			$renderCharts[$i] = Charts::create($charts[$i]['type'], 'highcharts')
				->title($charts[$i]['title'])
				->labels(json_decode($charts[$i]['labels']))
				->values(json_decode($charts[$i]['values']))
				->dimensions(0,500)
				->render();
			$renderCharts[$i]['id'] = $showChartsIds[] = $charts[$i]['id'];
		}
		return view('charts.index', compact('renderCharts', 'questionsId'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\ChartsResult  $chartsResult
	 * @return \Illuminate\Http\Response
	 */
	public function show(ChartsResult $chartsResult)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\ChartsResult  $chartsResult
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ChartsResult $chart)
	{
		return view('charts.edit', compact('chart'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\ChartsResult  $chartsResult
	 * @return \Illuminate\Http\Response
	 */
	public function update($id)
	{
		$chart = ChartsResult::find($id);
		$chart->values = json_encode(request()->except(['_method', '_token']));
		$chart->save();

		event(new ChangeChart($id));

		return redirect()->route('charts.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\ChartsResult  $chartsResult
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ChartsResult $chartsResult)
	{
		//
	}

	public function changeType()
	{
		$chart = ChartsResult::find(request('chart'));

		return Charts::create(request('type'), 'highcharts')
			->title($chart['title'])
			->labels(json_decode($chart['labels']))
			->values(json_decode($chart['values']))
			->dimensions(0,500)
			->render();
	}
}
