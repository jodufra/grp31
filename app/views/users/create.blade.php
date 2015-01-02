@extends('...layouts.scaffold')

@section('body')
<div class="col-md-8 col-md-offset-2">
  <div class="page-header"><h1>Register</h1></div>
  @include('partials.session_messages')

  {{ Form::open(array('route' => array('user.store'), 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) }}

  <div class="row-item">
    <fieldset>
      <legend><small>Account Information</small></legend>
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






  <div class="row-item">
    <fieldset>
      <legend><small>User Information</small></legend>
      <div class="form-group">
        {{Form::label('photo_file','Profile Photo', array('class'=>'col-md-3 control-label text-right'))}}
        <div class="col-md-6">
          {{ Form::file('photo_file', null,array('class' => 'form-control'))}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('first_name','First Name', array('class'=>'col-md-3 control-label text-right required'))}}
        <div class="col-md-6">
          {{Form::text('first_name', null,array('class' => 'form-control', 'required'))}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('last_name','Last Name', array('class'=>'col-md-3 control-label text-right required'))}}
        <div class="col-md-6">
          {{Form::text('last_name', null,array('class' => 'form-control', 'required'))}}
        </div>
      </div>

      <div id="date" class="form-group date">
        {{Form::label('birth_date','Birth Date', array('class'=>'col-md-3 control-label text-right required'))}}
        <div class="col-md-6">
          {{ Form::text('birth_date', null, array('type' => 'text', 'class' => 'form-control datepicker','placeholder' => '31/12/1900','required')) }}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('country','Country', array('class'=>'col-md-3 control-label text-right required'))}}
        <div class="col-md-6">
          @include('partials.countries')
        </div>
      </div>
      <div class="form-group">
        {{Form::label('address','Address', array('class'=>'col-md-3 control-label text-right'))}}
        <div class="col-md-6">
          {{Form::text('address_1', null,array('class' => 'form-control'))}}
          {{Form::text('address_2', null,array('class' => 'form-control', 'style' => 'margin-top: 5px;'))}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('facebook_url','Connect to Facebook', array('class'=>'col-md-3 control-label text-right'))}}
        <div class="col-md-6">
          {{Form::text('facebook_url', null,array('class' => 'form-control', 'placeholder' => 'https://www.facebook.com/yourfacebook'))}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('twitter_url','Connect to Twitter', array('class'=>'col-md-3 control-label text-right'))}}
        <div class="col-md-6">
          {{Form::text('twitter_url', null,array('class' => 'form-control', 'placeholder' => 'https://www.twitter.com/yourtwitter'))}}
        </div>
      </div>
    </fieldset>
  </div>




  <div class="row-item">
    <fieldset>
      <legend><small>Payment Information</small></legend>
      <div class="form-group">
        {{Form::label('credit_card_type','Credit Card Type', array('class'=>'col-md-3 control-label text-right required'));}}
        <div class="col-md-6">
          <table>
            <tr>
              <td>{{Form::radio('credit_card_type', 'Visa', true, array('class' => ''));}}</td>
              <td><img height="46px" width="63px" src="{{asset('img/visa.png')}}" alt="VISA" title="VISA"></td>
              <td>{{Form::radio('credit_card_type', 'Mastercard', false, array('class' => ''));}}</td>
              <td><img height="46px" width="63px" src="{{asset('img/master.png')}}" alt="MasterCard" title="MasterCard"></td>
              <td>{{Form::radio('credit_card_type', 'American Express', false, array('class' => ''));}}</td>
              <td><img height="46px" width="63px" src="{{asset('img/amex.png')}}" alt="American Express" title="American Express"></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="form-group">
        {{Form::label('credit_card_titular','Credit Card Titular', array('class'=>'col-md-3 control-label text-right required'));}}
        <div class="col-md-6">
          {{Form::text('credit_card_titular', null,array('class' => 'form-control','placeholder' => 'Credit Card Titular', 'required'))}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('credit_card_num','Credit Card Number', array('class'=>'col-md-3 control-label text-right required'));}}
        <div class="col-md-6">
          {{Form::number('credit_card_num', null,array('class' => 'form-control','placeholder' => 'Credit Card Number', 'required'))}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('credit_card_valid_month','Valid until', array('class'=>'col-md-3 control-label text-right required', 'required'))}}
        <div class="col-md-6">
          <?php
          $min_year = date('Y');
          $max_year = $min_year + 5;
          ?>
          {{Form::selectYear('credit_card_valid_year', $min_year, $max_year)}}
          {{Form::selectMonth('credit_card_valid_month')}}
        </div>
      </div>
      <div class="form-group">
        {{Form::label('credit_card_cvc','CVC', array('class'=>'col-md-3 control-label text-right required'));}}
        <div class="col-md-6">
          {{Form::number('credit_card_cvc', null,array('class' => 'form-control','placeholder' => 'Credit Card CVC', 'required'))}}
          <img src="{{asset('img/cvc2.png')}}" alt="CVC">
        </div>
      </div>
      <hr>
      <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
          <table>
            <ul>
              <td>{{link_to('/','Cancel', array('class' => 'btn btn-default'))}}</td>
              <td>{{Form::submit('Register', array('class' => 'btn btn-primary'))}}</td>
            </ul>
          </table>
        </div>
      </div>
    </fieldset>
  </div>
  {{ Form::close() }}
  @stop
