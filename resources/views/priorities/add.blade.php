<!-- Modal Default -->
<div class="modal fade modalAddCasePriority" id="modalAddCasePriority" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Case Priority</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addCasePriority', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addCasePriorityForm" ]) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}
            <div class="form-group">
                {!! Form::label('Name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitAddCasePriorityForm' type="button" class="btn btn-sm">Add Status</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">


            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
