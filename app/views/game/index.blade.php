@extends('layouts.scaffold')
@section('body')
<div class="col-md-1"></div>
<div class="col-md-7">
	<table>
		{{ Form::open(array('route'=>'game','method' => 'post', 'class'=>'form-horizontal')) }}
		<td>{{ Form::number('1',null,array('class' => 'form-control unstyled', 'required', 'min'=>'0', 'max' => '6')) }}</td>
		<td>{{ Form::number('2',null,array('class' => 'form-control unstyled', 'required', 'min'=>'0', 'max' => '6')) }}</td>
		<td>{{ Form::number('3',null,array('class' => 'form-control unstyled', 'required', 'min'=>'0', 'max' => '6')) }}</td>
		<td>{{ Form::number('4',null,array('class' => 'form-control unstyled', 'required', 'min'=>'0', 'max' => '6')) }}</td>
		<td>{{ Form::number('5',null,array('class' => 'form-control unstyled', 'required', 'min'=>'0', 'max' => '6')) }}</td>
		<td>{{ Form::submit('Roll',array('class' => 'form-control'))}}</td>
		{{ Form::close() }}
	</table>
</div>
<div class="col-md-3">
	<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>Score Table</th>
					<th>You</th>
					<th>Opponent</th>
				</tr>
			</thead>
			<tbody>
				<tr id="ones">
					<th>Ones</th>
					<td>{{$result['one']}}</td>
					<td></td>
				</tr>
				<tr id="twos">
					<th>Twos</th>
					<td>{{$result['two']}}</td>
					<td></td>
				</tr>
				<tr id="threes">
					<th>Threes</th>
					<td>{{$result['three']}}</td>
					<td></td>
				</tr>
				<tr id="fours">
					<th>Fours</th>
					<td>{{$result['four']}}</td>
					<td></td>
				</tr>
				<tr id="fives">
					<th>Fives</th>
					<td>{{$result['five']}}</td>
					<td></td>
				</tr>
				<tr id="sixes" class="info" style="border-bottom: solid 2px #333">
					<th>Sixes</th>
					<td>{{$result['six']}}</td>
					<td></td>
				</tr>
				<tr id="sum">
					<th>Sum</th>
					<td>{{$result['sum']}}</td>
					<td></td>
				</tr>
				<tr id="bonus" class="info" style="border-bottom: solid 2px #333">
					<th>Bonus</th>
					<td>{{$result['bonus']}}</td>
					<td></td>
				</tr>
				<tr id="three-of-a-kind">
					<th>Three of a kind</th>
					<td>{{$result['threeOfaKind']}}</td>
					<td></td>
				</tr>
				<tr id="four-of-a-kind">
					<th>Four of a kind</th>
					<td>{{$result['fourOfaKind']}}</td>
					<td></td>
				</tr>
				<tr id="full-house">
					<th>Full House</th>
					<td>{{$result['fullHouse']}}</td>
					<td></td>
				</tr>
				<tr id="small-straight">
					<th>Small straight</th>
					<td>{{$result['smallStraight']}}</td>
					<td></td>
				</tr>
				<tr id="large-straight">
					<th>Large straight</th>
					<td>{{$result['largeStraight']}}</td>
					<td></td>
				</tr>
				<tr id="chance">
					<th>Chance</th>
					<td>{{$result['chance']}}</td>
					<td></td>
				</tr>
				<tr id="yahtzee" class="info" style="border-bottom: solid 2px #333">
					<th>YAHTZEE</th>
					<td>{{$result['yahtzee']}}</td>
					<td></td>
				</tr>
				<tr id="total-score">
					<th>TOTAL SCORE</th>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

@stop
