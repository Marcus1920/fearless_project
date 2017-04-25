<!-- Modal Default -->
<div class="modal modalCreateCaseAgent" id="modalCreateCaseAgent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create Case</h4>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>

            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'createCaseAgent', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"CreateCaseAgentForm" ]) !!}
                {!! Form::hidden('hseHolderId',NULL,['id' => 'hseHolderId']) !!}
                {!! Form::hidden('gpsAddressLat',NULL,['id' => 'gpsAddressLat','class' => 'latitude']) !!}
                {!! Form::hidden('gpsAddressLong',NULL,['id' => 'gpsAddressLong','class' => 'longitude']) !!}



               <div class="form-group">
                    {!! Form::label('Search Client', 'Refer To', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('hsecellphone',NULL,['class' => 'form-control input-sm','id' => 'hsecellphone']) !!}

                  </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Cell Number', 'Cell Number', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('cellphone',NULL,['class' => 'form-control input-sm','id' => 'cellphone','disabled']) !!}
                      <div id = "hse_error_cellphone"></div>

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Client Name', 'Name', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name','disabled']) !!}
                      <div id = "hse_error_name"></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Client Surname', 'Surname', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('surname',NULL,['class' => 'form-control input-sm','id' => 'surname','disabled']) !!}
                     <div id = "hse_error_surname"></div>
                    </div>
                </div>




                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

                <div class="form-group">
                    {!! Form::label('Enter Address', 'Enter Address', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('autocomplete',NULL,['class' => 'form-control input-sm','id' => 'autocomplete', "onfocus"=>"geolocate()"]) !!}

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Street Number', 'Street Number', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('street_number',NULL,['class' => 'street_number form-control input-sm','id' => 'street_number']) !!}

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Route', 'Route', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('route',NULL,['class' => 'route form-control input-sm','id' => 'route']) !!}

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Locality', 'Locality', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('locality',NULL,['class' => 'locality form-control input-sm','id' => 'locality']) !!}

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Area', 'Area', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('administrative_area_level_1',NULL,['class' => 'administrative_area_level_1 form-control input-sm','id' => 'administrative_area_level_1']) !!}

                    </div>
                </div>



                <div class="form-group">
                    {!! Form::label('Postal Code', 'Postal Code', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('postal_code',NULL,['class' => 'postal_code form-control input-sm','id' => 'postal_code']) !!}

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Country', 'Country', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('country',NULL,['class' => 'country form-control input-sm','id' => 'country']) !!}

                    </div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


            <div class="form-group">
              {!! Form::label('Due Date', 'Due Date', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">
                <div class="input-icon datetime-pick date-only">
                  <input data-format="yyyy-MM-dd" type="text" id='due_date' name ='due_date' class="form-control input-sm"/>
                  <span class="add-on">
                      <i class="sa-plus"></i>
                  </span>
              </div>
                  <div id = "hse_error_due_date"></div>

              </div>

            </div>


            <div class="form-group">
              {!! Form::label('Due Time', 'Due Time', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">
                  <input type="text" id="due_time" size="10" class="form-control  input-sm" value="00:00 AM">
                    <script>
                        $(function () {
                            $('#due_time').timeEntry();
                        });
                    </script>

              </div>

            </div>


			<hr class="whiter m-t-20">
            <hr class="whiter m-b-20">

            <div class="form-group">
              {!! Form::label('Route', 'Estimated Time :', array('class' => 'col-md-3 control-label')) !!}

            </div>

			<div class="form-group">
              {!! Form::label('Date', 'Date', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">
                <div class="input-icon datetime-pick date-only">
                  <input data-format="yyyy-MM-dd" type="text" id='estimatedDate' name ='dob' class="form-control input-sm"/>
                  <span class="add-on">
                      <i class="sa-plus"></i>
                  </span>
                 </div>

                  <div id = "hse_error_estimated_due_date"></div>

              </div>
            </div>


            <div class="form-group">
              {!! Form::label('Time', 'Time', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">
                  <input type="text" id="estimateTime" size="10" class="form-control  input-sm" value="00:00 AM">
                    <script>
                        $(function () {
                            $('#estimateTime').timeEntry();
                        });
                    </script>

              </div>

            </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


				<div class="form-group" >
                    {!! Form::label('Case Type', 'Department', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('department',$selectDepartments,0,['class' => 'form-control input-sm' ,'name' => 'department','id' => 'department']) !!}
                    <div id = "hse_error_type"></div>
                  </div>
                </div>

				<div class="form-group hidden" id="categories_id">
                    {!! Form::label('Case Type', 'Category', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('case_type',$selectCategories,0,['class' => 'form-control input-sm' ,'name' => 'category','id' => 'category']) !!}
                    <div id = "hse_error_type"></div>
                  </div>
                </div>

				<div class="form-group hidden" id="sub_categories_id">
                    {!! Form::label('Case Type', 'Sub Category', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('case_type',$selectCasesTypes,0,['class' => 'form-control input-sm' ,'name' => 'sub_category','id' => 'sub_category']) !!}
                    <div id = "hse_error_type"></div>
                  </div>
                </div>

                <div class="form-group hidden" id="sub_sub_categories_id">
                    {!! Form::label('Case Sub Type', 'Sub Sub Category', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('case_sub_type',$selectCasesTypes,0,['class' => 'form-control input-sm' ,'name' => 'sub_sub_category','id' => 'sub_sub_category']) !!}
                    <div id = "hse_error_sub_type"></div>
                  </div>
                </div>




                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


                <div class="form-group">
                    {!! Form::label('Problem Description', 'Problem Description', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        <textarea rows="5" id="description" name="description" class="form-control" maxlength="500"></textarea>
                    </div>
                    <div id = "hse_error_description"></div>
                </div>

				<div class="hidden" id="message_id">

				<hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

				<p id="message_header" style="margin-bottom: 20px;"></p>

				 <div class="form-group">
                    {!! Form::label('Message', 'Message', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        <textarea rows="5" id="message" name="message" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>
				</div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-8">
                       <a type="#" id='submitCreateCaseAgentForm' class="btn btn-sm">Create Case</a>
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
