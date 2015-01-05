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
                                                <li class="list-group-item">Email: {{Auth::user()->email}}</li>
                                                <li class="list-group-item">Country: {{ Auth::user()->person()->first()->country}}</li>
                                                <li class="list-group-item">Birthday: {{ Auth::user()->person()->first()->birthdate}}</li>
                                                <li class="list-group-item">Twitter: <a href="{{ Auth::user()->person()->first()->twitter_url}}">{{ Auth::user()->person()->first()->twitter_url}}</a></li>
                                                <li class="list-group-item">Facebook:   <a href="{{ Auth::user()->person()->first()->facebook_url}}">{{ Auth::user()->person()->first()->facebook_url}}</a> </li>


                                            </ul>

                                        </div>

                                        <div>
                                        </div>
                                        <div class="bs-example">
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
                                                    <td>1</td>
                                                    <td>John</td>
                                                    <td>Carter</td>
                                                    <td>johncarter@mail.com</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Peter</td>
                                                    <td>Parker</td>
                                                    <td>peterparker@mail.com</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>John</td>
                                                    <td>Rambo</td>
                                                    <td>johnrambo@mail.com</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
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


                                            {{--<div class="form-group">--}}
                                            {{--{{Form::label('country','Country', array('class'=>'col-md-3 control-label text-right required'))}}--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--@include('partials.countries')--}}
                                            {{--</div>--}}
                                            {{--</div>--}}

                                            <div class="form-group">
                                                {{Form::label('address','Address', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('address_1', Auth::user()->person()->first()->address1,array('class' => 'form-control'))}}
                                                    {{Form::text('address_2', Auth::user()->person()->first()->address2,array('class' => 'form-control', 'style' => 'margin-top: 5px;'))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('facebook_url','Connect to Facebook', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('facebook_url', Auth::user()->person()->first()->facebook_url,array('class' => 'form-control', 'placeholder' => 'https://www.facebook.com/yourfacebook'))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('twitter_url','Connect to Twitter', array('class'=>'col-md-3 control-label text-right'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('twitter_url', Auth::user()->person()->first()->twitter_url,array('class' => 'form-control', 'placeholder' => 'https://www.twitter.com/yourtwitter'))}}
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>




                                    {{--<div class="row-item">--}}
                                    {{--<fieldset>--}}
                                    {{--<legend><small>Payment Information</small></legend>--}}
                                    {{--<div class="form-group">--}}
                                    {{--{{Form::label('credit_card_type','Credit Card Type', array('class'=>'col-md-3 control-label text-right'));}}--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<table>--}}
                                    {{--<tr>--}}
                                    {{--<td>{{Form::radio('credit_card_type', 'Visa', true, array('class' => ''));}}</td>--}}
                                    {{--<td><img height="46px" width="63px" src="{{asset('img/visa.png')}}" alt="VISA" title="VISA"></td>--}}
                                    {{--<td>{{Form::radio('credit_card_type', 'Mastercard', false, array('class' => ''));}}</td>--}}
                                    {{--<td><img height="46px" width="63px" src="{{asset('img/master.png')}}" alt="MasterCard" title="MasterCard"></td>--}}
                                    {{--<td>{{Form::radio('credit_card_type', 'American Express', false, array('class' => ''));}}</td>--}}
                                    {{--<td><img height="46px" width="63px" src="{{asset('img/amex.png')}}" alt="American Express" title="American Express"></td>--}}
                                    {{--</tr>--}}
                                    {{--</table>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    {{--{{Form::label('credit_card_titular','Credit Card Titular', array('class'=>'col-md-3 control-label text-right'));}}--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--{{Form::text('credit_card_titular', null,array('class' => 'form-control','placeholder' => 'Credit Card Titular'))}}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    {{--{{Form::label('credit_card_num','Credit Card Number', array('class'=>'col-md-3 control-label text-right required'));}}--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--{{Form::number('credit_card_num', null,array('class' => 'form-control','placeholder' => 'Credit Card Number'))}}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    {{--{{Form::label('credit_card_valid_month','Valid until', array('class'=>'col-md-3 control-label text-right required'))}}--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<?php--}}
                                    {{--$min_year = date('Y');--}}
                                    {{--$max_year = $min_year + 5;--}}
                                    {{--?>--}}
                                    {{--{{Form::selectYear('credit_card_valid_year', $min_year, $max_year)}}--}}
                                    {{--{{Form::selectMonth('credit_card_valid_month')}}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                    {{--{{Form::label('credit_card_cvc','CVC', array('class'=>'col-md-3 control-label text-right required'));}}--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--{{Form::number('credit_card_cvc', null,array('class' => 'form-control','placeholder' => 'Credit Card CVC', 'required'))}}--}}
                                    {{--<img src="{{asset('img/cvc2.png')}}" alt="CVC">--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<hr>--}}
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
                                    {{--</fieldset>--}}
                                    {{--</div>--}}
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{--<div class="container-fluid well span5" style="background: #000000">--}}
                {{--<div class="row-fluid">--}}
                {{--<div class="media">--}}
                {{--<a class="media-left" href="#" style="color:#ffffff">--}}

                {{--<img src="{{ Auth::user()->person()->first()->photo}}"--}}
                {{--class="img-responsive portrait portrait-l">--}}

                {{--</a>--}}

                {{--<div class="media-body" style="width:100%">--}}
                {{--<br>--}}

                {{--<h3 class="media-heading" style="color:#ffffff">{{Auth::user()->username}}</h3>--}}
                {{--<br>--}}
                {{--<ul class="list-unstyled">--}}
                {{--<li class="list-group-item">Email: {{Auth::user()->email}}</li>--}}
                {{--<li class="list-group-item">--}}
                {{--Country: {{ Auth::user()->person()->first()->country}}</li>--}}
                {{--<li class="list-group-item">Morbi leo risus</li>--}}
                {{--<li class="list-group-item">Porta ac consectetur ac</li>--}}
                {{--<li class="list-group-item">Vestibulum at eros</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}


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
                                    Country: {{ $person->country }}
                                    <br>Birthday: {{ $person->birthdate}}
                                    <br>Facebook: <a href="{{$person->facebook_url}}">{{$person->facebook_url}}</a>
                                    <br>Twitter: <a href="{{$person->twitter_url}}">{{$person->twitter_url}}</a>
                                </li>
                            </ul>

                        </div>

                        <div>
                        </div>
                        <div class="bs-example">
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
                                    <td>1</td>
                                    <td>John</td>
                                    <td>Carter</td>
                                    <td>johncarter@mail.com</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Peter</td>
                                    <td>Parker</td>
                                    <td>peterparker@mail.com</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>John</td>
                                    <td>Rambo</td>
                                    <td>johnrambo@mail.com</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
