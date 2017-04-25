

<!-- Modal Default -->
<div class="modal fade modalDueDate due-modal" id="modalDueDate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-due ">
            <div class="modal-header-due">
                <button type="button" class="close" id ="closeListContactModal" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Due Date</h4>
            </div>
           
            <div class="modal-body" style="background-color: #w3f">
               <label> Date </label>
			    <div class="form-group">
                
                <div class="col-md-10">
                <div class="input-icon datetime-pick date-only">
                  <input data-format="yyyy-MM-dd" type="text" id='dueDate' name ='dob' class="form-control input-sm"/>
                  <span class="add-on">
                      <i class="sa-plus"></i>
                  </span>
              </div>
              </div>
            </div>
			<br/>
			
                
				<!--<label style="margin-top: 20px; margin-left: 0px; margin-right: 300px;"> Time </label>
				<div class="form-group">
                    
                    <div class="col-md-6">
                      <p><input class="form-control  input-sm" id="dueTime" type="text" class="time"/></p>
					</div>
                </div>-->
				
				<div class="col-md-10">
				<p>Time: <input type="text" id="defaultEntry" size="10" class="form-control  input-sm"></p>
				</div>
			<script>
$(function () {
	$('#defaultEntry').timeEntry();
});
</script>
		
				
            </div>
			
			 <hr class="whiter m-t-20">
            <hr class="whiter m-b-20">

            <div class="modal-footer" style="0px solid #fff;">
				<div class="col-md-10" class="form-group" style="height: 60%; padding-bottom: 20px;">
				<button type="button"  data-dismiss="modal" id="dueModalSave" class="btn-primary btn-sm m-t-10" style="margin-left: 100px; padding: 10px 20px 10px 20px;">SAVE</button>
				<button type="button"  class="btn-danger btn-sm m-t-10" data-dismiss="modal" style="margin-left: 160px; padding: 10px 20px 10px 20px;">CLOSE</button>
				</div>
            </div>


        </div>
    </div>
</div>

