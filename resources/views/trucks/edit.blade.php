<!-- Modal Default -->
<div class="modal fade modalEditTruck" id="modalEditTruck" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Truck</h4>
            </div>
            <div class="modal-body">

            {!! Form::open(['url' => 'updateTruck', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"updateCategoryForm" ]) !!}
            {!! Form::hidden('truckID',NULL,['id' => 'truckID']) !!}

            <div class="form-group">
                {!! Form::label('Registration Number', 'Registration Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('registration_number',NULL,['class' => 'form-control input-sm','id' => 'registration_number']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Reference Number', 'Reference Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('reference_number',NULL,['class' => 'form-control input-sm','id' => 'reference_number']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Vin Number', 'Vin Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('vin_number',NULL,['class' => 'form-control input-sm','id' => 'vin_number']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
			
			<div class="form-group">
                {!! Form::label('Chassis Number', 'Chassis Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('chassis_number',NULL,['class' => 'form-control input-sm','id' => 'chassis_number']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Engine Number', 'Engine Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('engine_number',NULL,['class' => 'form-control input-sm','id' => 'engine_number']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Registration Year', 'Registration Year', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
					<div class="input-icon datetime-pick date-only">
						<input data-format="yyyy-MM-dd" type="text" id='registration_year' name ='registration_year' class="form-control input-sm"/>
						<span class="add-on">
							<i class="sa-plus"></i>
						</span>
					</div>
                </div>
            </div>
			
			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
			
			<div class="form-group">
                {!! Form::label('Make', 'Make', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('make',NULL,['class' => 'form-control input-sm','id' => 'make']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Model', 'Model', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('model',NULL,['class' => 'form-control input-sm','id' => 'model']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Colour', 'Colour', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('colour',NULL,['class' => 'form-control input-sm','id' => 'colour']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Speed Limit', 'Speed Limit', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('speed_limit',NULL,['class' => 'form-control input-sm','id' => 'speed_limit']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Date Inactive', 'Date Inactive', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  <div class="input-icon datetime-pick date-only">
						<input data-format="yyyy-MM-dd" type="text" id='date_inactive' name ='date_inactive' class="form-control input-sm"/>
						<span class="add-on">
							<i class="sa-plus"></i>
						</span>
					</div>
                </div>
            </div>
			
			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitUpdateCategorytForm' type="button" class="btn btn-sm">Save Changes</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">

                <!-- <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button> -->
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
