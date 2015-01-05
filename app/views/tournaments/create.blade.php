@extends('layouts.scaffold_sidebar')
@section('sidebar')
<?php $sidebar_home = true ?>
@include('partials.common_sidebar')
@endsection
@section('body')


<div class="col-md-12" ng-controller="TournamentController">
  {{ Form::open(array('route' => array('tournaments.store'), 'method' => 'post', 'class' => 'form-horizontal')) }}
  <fieldset>
        <legend><small>Tournament Information</small></legend>

        <div class="form-group">
          {{Form::label('name','Name', array('class'=>'col-md-3 control-label text-right required'))}}
          <div class="col-md-6">
            {{Form::text('name', null,array('class' => 'form-control','required'))}}
          </div>
        </div>
        <div class="form-group">

         {{Form::label('begins','Begins', array('class'=>'col-md-3 control-label text-right required'))}}
            <div class="col-md-8">
                 <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">

                   {{ Form::text('begin', null, array('type' => 'text', 'class' => 'form-control','placeholder' => '31/12/1900','value'=>'','readonly'=>'','required')) }}
                         <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                 </div>
             </div>
        </div>

        <div class="form-group">

         {{Form::label('ends','Ends', array('class'=>'col-md-3 control-label text-right required'))}}
            <div class="col-md-8">
                 <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">

                   {{ Form::text('ends', null, array('type' => 'text', 'class' => 'form-control','placeholder' => '31/12/1900','value'=>'','readonly'=>'','required')) }}
                         <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                 </div>
             </div>
        </div>
        <div class="form-group">
          {{Form::label('description','Description', array('class'=>'col-md-3 control-label text-right required'))}}
          <div class="col-md-6">
            {{Form::textArea('description', null,array('class' => 'form-control','required'))}}
          </div>
        </div>
        <div class="form-group">
          {{Form::label('prizes','Prize', array('class'=>'col-md-3 control-label text-right required'))}}
          <div class="col-md-6">
            {{Form::textArea('prize', null,array('class' => 'form-control','required'))}}
          </div>
        </div>
       <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <table>
                  <ul>
                    <td>{{link_to('tournaments','Cancel', array('class' => 'btn btn-default'))}}</td>
                    <td>{{Form::submit('Create', array('class' => 'btn btn-primary'))}}</td>
                  </ul>
                </table>
              </div>
            </div>
          </fieldset>
        {{ Form::close() }}
</div>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        format: 'yyyy-mm-dd hh:ii',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        format: 'yyyy-mm-dd hh:ii',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
@endsection