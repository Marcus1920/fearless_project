<!-- Modal Default -->
<div class="modal modalReferCase" id="modalReferCase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  id="closeReferCase" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='modalTitle'></h4>
            </div>
            <div class="row">
              <div class="col-md-6">
				 <a class="btn btn-xs btn-alt"   data-toggle="modal" data-target=".modalDueDate" style="margin-left:180px;">Due Date</a>
              </div>
               <div class="col-md-6">
				
                 <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchAddressBookModal();" data-target=".modalAddressBook">Address Book</a>
              </div>
            </div>
            <div class="modal-body" style="margin-top: 10px;">
                {!! Form::open(['url' => 'escalateCase', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"escalateCaseForm" ]) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
                {!! Form::hidden('modalType',NULL,['id' => 'modalType']) !!}
				
				
				<div   id="dialog" title="Due Date">
				
						{!! Form::label('Due Date', 'Date', array('class' => 'col-md-2 control-label')) !!}
						<div class="form-group">
							<div class="col-md-4">
								
								<div class="input-icon datetime-pick date-only">
									<input data-format="yyyy-MM-dd" type="text" id='dialogDate' name ='dob' class="form-control input-sm due-text-color" />
									<span class="add-on">
										<i class="sa-plus"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group" id="dueDateGroup">
							{!! Form::label('Due Date', 'Time', array('class' => 'col-md-2 control-label')) !!}
							<div class="col-md-4">
								<input type="text" id="dialogTime" value="12:00" class="form-control input-sm due-text-color">
								@if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
							</div>
						</div>
		
						<hr class="whiter m-t-20" style="margin-top: 100px; width: 100%;">
					 
					
						<button data-toggle="modal" class="btn-primary btn-sm m-t-10" id="dialogSave" data-target=".modalReferCase">Save</button> 
						<button id="closeDialog" class="btn-danger btn-sm m-t-10">Close</button>
				</div>
				
				

				<div class="form-group" id="dueDateGroup">
                {!! Form::label('Due Date', 'Due Date', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'dueDate']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group" id="dueTimeGroup">
                {!! Form::label('Due Time', 'Due Time', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'dueTime']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
				
				 <hr class="whiter m-t-20">
				<hr class="whiter m-b-20">

				
                <div class="form-group">
                    {!! Form::label('Search Box', 'Search Box', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('addresses',NULL,['class' => 'form-control input-sm','id' => 'addresses']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Message', 'Message', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-8">
                        <textarea rows="5" id="message" name="message" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                       <a type="#" id='submitEscalateCaseForm' class="btn btn-sm"></a>
                    </div>
                </div>

               <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">

                    </div>
                </div>

                {!! Form::close() !!}

            </div>



        </div>
    </div>
</div>
