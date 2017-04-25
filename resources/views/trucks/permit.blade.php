<!-- Modal Default -->
<div class="modal fade modalPrintPermit" id="modalPrintPermit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="btnClose"type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Print Permit</h4>
            </div>
            <div class="modal-body" id="permit">
            {!! Form::open(['url' => 'addCompany', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"updateDepartmentForm" ]) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}
            
			<div >
			<div>
				<img style="float: left" width="100px" height="100px" src="{{ asset('images/transnet_transp_light_bg_small.png') }}"/>
				<h1 style="float: left; margin-top: 30px; margin-left: 50px;"> TRUCK PERMIT</h1>
				<img style="float: right;" width="100px" height="100px" src="{{ asset('images/transnet_transp_light_bg_small.png') }}"/>
			</div>
			
			<img id="img" style="visibility:hidden;" width="100px" height="50px" src="{{ asset('images/transnet_transp_light_bg_small.png') }}"/>
			
			<div style="margin-left: 25%; margin-bottom: 50px;">
			<div class="form-group">
                {!! Form::label('Company Name', 'Company Name', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblCompany")) !!}
            </div>
			
			<div class="form-group">
                {!! Form::label('Physical Address', 'Physical Address', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblPhysicalAddress")) !!}
            </div>
			
			<div class="form-group">
                {!! Form::label('Contact Person', 'Contact Person', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblPerson")) !!}
            </div>
			
			<div class="form-group">
                {!! Form::label('Phone Number', 'Phone Number', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblPhoneNumber")) !!}
            </div>
			
			<div class="form-group">
                {!! Form::label('Registration Number', 'Registration Number', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblRegNumber")) !!}
            </div>
			
			<div class="form-group">
                {!! Form::label('Engin Number', 'Engin Number', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblEnginNumber")) !!}
            </div>
			
			<div class="form-group">
                {!! Form::label('Registration Year', 'Registration Year', array('class' => 'col-md-4 control-label')) !!}
				{!! Form::label('', '', array('class' => 'col-md-6 control-label', 'id'=>"lblRegYear")) !!}
            </div>
			</div>
			
			<div class="_disk_">
				<img src="{{ asset('images/license disk bg.png') }}"/>
				
				<div class="form-group" id="reg_number">
				
					<label>Registration Number : </label>
					<label id="diskRegNumber"> </label>
				</div>
				<div class="form-group" id="vin" style="font-size:300%;">
				
					<label>Vin Number : </label>
					<label id="diskVinNumber"> </label>
				</div>
				
				
				
				<div class="form-group" id="ma_ke">
					<label>Make : </label>
					<label id="diskMake"> </label>
				</div>
				
				<div  style="margin-top: 10px;" id="bar_code"></div>
			
				<div class="form-group" id="mo_del">
					<label>Model : </label>
					<label id="diskModel"> </label>
				</div>
				
				<div class="form-group" id="co_lour">
					<label>Colour : </label>
					<label id="diskColour"> </label>
				</div>
			</div>
		
       <script>
			 function launchPrintPermitModal(id)
				{
				  $.ajax({
					type    :"GET",
					dataType:"json",
					url     :"{!! url('/printPermit/" + id +"')!!}",
					success : function(data){
						
						lblCompany.innerHTML =".......................   " + data[0].company_trading_name;
						lblPhysicalAddress.innerHTML = ".......................   " + data[0].physical_address;
						lblPerson.innerHTML = ".......................   " +  data[0].contact_person;
						lblPhoneNumber.innerHTML = ".......................   " + data[0].contact_phone_number;
						lblRegNumber.innerHTML = ".......................   " + data[0].registration_number;
						lblEnginNumber.innerHTML = ".......................   " +  data[0].engine_number;
						lblRegYear.innerHTML = ".......................   " + data[0].registration_year;
						
						diskVinNumber.innerHTML = data[0].vin_number.toUpperCase();
						diskMake.innerHTML = data[0].make.toUpperCase();
						diskModel.innerHTML = data[0].model.toUpperCase();
						diskColour.innerHTML = data[0].colour.toUpperCase();
						diskRegNumber.innerHTML = data[0].registration_number;
						_barcode = data[0].vin_number;
					
						var settings = {
						  bgColor: "#ffffff",
						  color: '#000',
						  barWidth: 2,
						  barHeight: 50,
						  moduleSize: 5,
						  posX: 0,
						  posY: 0,
						  addQuietZone: false,
						  showHRI: false
						};
					
						$('#modalPrintPermit #bar_code').barcode(
								_barcode,
								"code39",
							settings
						);
					}
					
				  });
				}
				
  
			 
		</script>

			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">
			</div>
            <div class="form-group">
                <div class="col-md-offset-4 col-md-10">
                    <button onclick="printPermit();" id='print' type="button" class="btn btn-sm">Print Permit</button>
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
