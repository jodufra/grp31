@extends('...layouts.scaffold')
@section('body')
    <div class="container">
        <div>
            @if(Auth::check())

                <br><br>

                <div class="well">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
                        <li><a href="#profile" data-toggle="tab">Statistics</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <form id="tab">
                                <div class="container-fluid well span5">
                                    <div class="row-fluid">
                                        <div class="media">
                                            <a class="media-left">
                                                <img src="{{ Auth::user()->person()->first()->photo}}"
                                                     class="img-tumbnail portrait portrait-l">
                                            </a>
                                            <div class="media-body">
                                                <h2 class="media-heading">{{Auth::user()->username}}</h2>
                                                {{Form::open(array('route' => array('user.store'), 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'))}}


                                               {{Form::file('photo_file',null,array('class'=>'btn-primary'))}}


                                                {{Form::close()}}

                                            </div>
                                        </div>
                                        <div>
                                            <h3>

                                            </h3>
                                        </div>

                                        <div>
                                            <ul class="list-group">
                                                <li class="list-group-item">Email: {{Auth::user()->email}}
                                                    <br>Country: {{ Auth::user()->person()->first()->country}}</li>
                                            </ul>

                                        </div>

                                        <div>
                                            <div class="btn-group">
                                                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                                                    Action
                                                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#"><span class="icon-wrench"></span> Modify</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="bs-example">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Row</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <div class="clearfix well">


                                <div class="col-md-8 col-md-offset-2">
                                    <div class="page-header"><h1>Register</h1></div>
                                    @include('partials.session_messages')

                                    {{ Form::open(array('route' => array('user.store'), 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) }}

                                    <div class="row-item">
                                        <fieldset>
                                            <legend>
                                                <small>Account Information</small>
                                            </legend>
                                            <div class="form-group">
                                                {{Form::label('username','Username', array('class'=>'col-md-3 control-label text-right required'))}}
                                                <div class="col-md-6">
                                                    {{Form::text('username', null,array('class' => 'form-control','min'=>'5','size' => '24','required','placeholder' => 'myusername'))}}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {{Form::label('email','Email', array('class'=>'col-md-3 control-label text-right required'))}}
                                                <div class="col-md-6">
                                                    {{Form::email('email', null,array('class' => 'form-control','min'=>'5','size' => '24','required','placeholder' => 'myemail@example.com'))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password','Password', array('class'=>'col-md-3 control-label text-right required'))}}
                                                <div class="col-md-6">
                                                    {{Form::password('password',array('class' => 'form-control','min'=>'5','size' => '24','required'))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password_confirmation','Password Confirm', array('class'=>'col-md-3 control-label text-right required'))}}
                                                <div class="col-md-6">
                                                    {{Form::password('password_confirmation',array('class' => 'form-control','min'=>'5','size' => '24','required'))}}
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

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
                <h1>You are not allowed to be in this page</h1>
            @endif
        </div>
    </div>
@stop
