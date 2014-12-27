<div class="modal fade" id="createGameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Game</h4>
      </div>
        {{ Form::open(array('route' => 'game.store', 'class' => 'form-horizontal')) }}
      <div class="modal-body">
            <div class="form-group">
                {{ Form::label('name', 'Name:', array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name of game','pattern'=>'[a-zA-Z0-9]+', 'oninvalid'=>'setCustomValidity("Do not input special caracters")','required')) }}
                  {{Form::hidden('player_id',Auth::user()->player()->first()->id, Input::old('player_id'))}}
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{ Form::submit('Create', array('class' => 'btn btn-info')) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>