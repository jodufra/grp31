@extends('...layouts.scaffold')
@section('body')
    <div class="container">
        <div>
            @if(Auth::check() && Auth::user()->id == $user->id)

                <br><br>

                <div>
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#edit" data-toggle="tab">Edit</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="profile">
                            <div id="tab">
                                <div class="container-fluid well span5">
                                    <div class="row-fluid">
                                        <div class="media">
                                            <a class="media-left">
                                                <img src="{{ Auth::user()->person()->first()->photo}}"
                                                     class="img-tumbnail portrait portrait-l">
                                            </a>

                                            <div class="media-body">
                                                <h2 class="media-heading">{{Auth::user()->username}}</h2>

                                                <div>
                                                    {{Form::open(array('route' => array('user.update'), 'method' => 'PUT', 'enctype' => 'multipart/form-data'))}}
                                                    {{Form::file('photo_update')}}
                                                    {{Form::submit('Update', array('class' => 'btn btn-info'))}}
                                                    {{Form::close()}}
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                        </div>

                                        <div>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    Name: {{ Auth::user()->person()->first()->name}}</li>
                                                <li class="list-group-item">
                                                    Birthday: {{ Auth::user()->person()->first()->birthdate}}</li>
                                                <li class="list-group-item">
                                                    Country: {{ Auth::user()->person()->first()->country}}</li>
                                                <li class="list-group-item">
                                                    Address: {{ Auth::user()->person()->first()->address}}</li>
                                                <li class="list-group-item">
                                                    Phone: {{ Auth::user()->person()->first()->phone}}</li>
                                                <li class="list-group-item">Email: {{Auth::user()->email}}</li>
                                                <li class="list-group-item">Twitter: <a
                                                            href="{{ Auth::user()->person()->first()->twitter_url}}">{{ Auth::user()->person()->first()->twitter_url}}</a>
                                                </li>
                                                <li class="list-group-item">Facebook: <a
                                                            href="{{ Auth::user()->person()->first()->facebook_url}}">{{ Auth::user()->person()->first()->facebook_url}}</a>
                                                </li>


                                            </ul>

                                        </div>

                                        <div>
                                        </div>
                                        <div class="bs-example well" style="background-color: #ffffff">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Games Played</th>
                                                    <th>Wins</th>
                                                    <th>Losses</th>
                                                    <th>Yahtzees</th>
                                                    <th>Tournaments Played</th>
                                                    <th>Tournaments Won</th>
                                                    <th>Tournaments Lost</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>4</td>
                                                    <td>2</td>
                                                    <td>2</td>
                                                    <td>2</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>0</td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="edit">
                            <div class="clearfix well">


                                <div class="col-md-8 col-md-offset-2">
                                    @include('partials.session_messages')
                                    {{Form::open(array('route' => array('user.update'), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

                                    <div class="row-item">
                                        <fieldset>
                                            <legend>
                                                <small>Account Information</small>
                                            </legend>

                                            <div class="form-group">
                                                {{Form::label('email','Email', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::email('email', null,array('class' => 'form-control','min'=>'5','size' => '24','placeholder' => Auth::user()->email))}}
                                                </div>
                                            </div>
                                            <div id="date" class="form-group date">
                                                {{Form::label('birth_date','Birth Date', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{ Form::text('birth_date', null, array('type' => 'text', 'class' => 'form-control datepicker','placeholder' => Auth::user()->person()->first()->birthdate)) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password','Password', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::password('password',array('class' => 'form-control','min'=>'5','size' => '24'))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password_confirmation','Password Confirm', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::password('password_confirmation',array('class' => 'form-control','min'=>'5','size' => '24'))}}
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>


                                    <div class="row-item">
                                        <fieldset>
                                            <legend>
                                                <small>User Information</small>
                                            </legend>
                                            <div class="form-group">
                                                {{Form::label('name_update','Name', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('name_update',null,array('class' => 'form-control' ,'placeholder' => Auth::user()->person()->first()->name))}}
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                {{Form::label('country','Country', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    <div ng-controller="CountriesController"
                                                         ng-init="selected = '{{Auth::user()->person()->first()->country}}'">
                                                        <select name="country" class="form-control col-md-4" required>
                                                            <option ng-repeat="country in countries()"
                                                                    ng-selected="selected == country"
                                                                    value="[[country]]" title="[[country]]"
                                                                    ng-bind="country"></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {{Form::label('address','Address', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('address',null ,array('class' => 'form-control','placeholder' => Auth::user()->person()->first()->address))}}

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('phone','Phone', array('class'=>'col-md-3 control-label text-right' ))}}
                                                <div class="col-md-6">
                                                    {{Form::text('phone', null,array('class' => 'form-control', 'style' => 'margin-top: 5px;' ,'placeholder' => Auth::user()->person()->first()->phone))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('facebook_url','Connect to Facebook', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('facebook_url', null,array('class' => 'form-control', 'placeholder' => Auth::user()->person()->first()->facebook_url))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('twitter_url','Connect to Twitter', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('twitter_url', null,array('class' => 'form-control', 'placeholder' => Auth::user()->person()->first()->twitter_url))}}
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <table>
                                                <ul>
                                                    <td>{{link_to('/','Cancel', array('class' => 'btn btn-default'))}}</td>
                                                    <td>{{Form::submit('Update', array('class' => 'btn btn-primary'))}}</td>
                                                </ul>
                                            </table>
                                        </div>
                                    </div>

                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            @else
                <div class="container-fluid well span5">
                    <div class="row-fluid">
                        <div class="media">
                            <a class="media-left">
                                <img src="{{ $person->photo}}"
                                     class="img-tumbnail portrait portrait-l">
                            </a>

                            <div class="media-body">
                                <h2 class="media-heading">{{$user->username}}</h2>
                            </div>
                        </div>
                        <div>
                        </div>

                        <div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Country: {{ $person->country }} </li>
                                <li class="list-group-item">Birthday: {{ $person->birthdate}} </li>
                                <li class="list-group-item">Facebook: <a
                                            href="{{$person->facebook_url}}">{{$person->facebook_url}}</a></li>
                                <li class="list-group-item">Twitter: <a
                                            href="{{$person->twitter_url}}">{{$person->twitter_url}}</a></li>
                            </ul>

                        </div>

                        <div>
                        </div>
                        <div class="bs-example well" style="background-color: #ffffff">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Games Played</th>
                                    <th>Wins</th>
                                    <th>Losses</th>
                                    <th>Yahtzees</th>
                                    <th>Tournaments Played</th>
                                    <th>Tournaments Won</th>
                                    <th>Tournaments Lost</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
