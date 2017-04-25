<!-- Modal Default -->
<div class="modal fade modalAddCompany" id="modalAddCompany" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Company</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addCompany', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"updateDepartmentForm" ]) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}
            <div class="form-group">
                {!! Form::label('Registered Company Name', 'Registered Company Name', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('reg_company_name',NULL,['class' => 'form-control input-sm','id' => 'reg_company_name']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
			
            <div class="form-group">
                {!! Form::label('Company Trading Name', 'Company Trading Name', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('company_trading_name',NULL,['class' => 'form-control input-sm','id' => 'company_trading_name']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Company Reg. Number', 'Company Reg. Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('company_reg_number',NULL,['class' => 'form-control input-sm','id' => 'company_reg_number']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Company Tax Number', 'Company Tax Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('company_tax_number',NULL,['class' => 'form-control input-sm','id' => 'company_tax_number']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
			
			<div class="form-group">
                {!! Form::label('Company Physical Address', 'Company Physical Address', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                        <textarea rows="5" id="physical_address" name="physical_address" class="form-control" maxlength="500"></textarea>
                </div>
                <div id = "hse_error_description"></div>
            </div>
			
			<div class="form-group" style="margin-top: 20px;">
                {!! Form::label('Company Postal Address', 'Company Postal Address', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                        <textarea rows="5" id="postal_address" name="postal_address" class="form-control" maxlength="500"></textarea>
                </div>
                <div id = "hse_error_description"></div>
            </div>
			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
			
			<div class="form-group">
                {!! Form::label('Contact Person', 'Contact Person', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('contact_person',NULL,['class' => 'form-control input-sm','id' => 'contact_person']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Contact Email', 'Contact Email', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('contact_email',NULL,['class' => 'form-control input-sm','id' => 'contact_email']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Contact Phone Number', 'Contact Phone Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('contact_phone_number',NULL,['class' => 'form-control input-sm','id' => 'contact_phone_number']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			
			<div class="form-group">
                {!! Form::label('Fax Number', 'Fax Number', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('fax_number',NULL,['class' => 'form-control input-sm','id' => 'fax_number']) !!}
                  @if ($errors->has('acronym')) <p class="help-block red">*{{ $errors->first('acronym') }}</p> @endif
                </div>
            </div>
			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
			
            <div class="form-group">
                <div class="col-md-offset-4 col-md-10">
                    <button type="submit" id='submitAddCompanyForm' type="button" class="btn btn-sm">Add Company</button>
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
