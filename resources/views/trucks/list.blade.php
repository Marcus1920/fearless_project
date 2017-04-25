@extends('master')

@section('content')

<!-- Breadcrumb -->

<div id="truck_page_">

<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-trucks-companies') }}">Truck Companies</a></li>
    <li><a href="#">{{ $truckCompObj->company_trading_name }}</a></li>
    <li class="active">Trucks Listing</li>
</ol>

<h4 class="page-title">{{ $truckCompObj->company_trading_name }} TRUCKS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Truck Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddTruck">
     Add Truck
    </a>
</div>

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
    @if(Session::has('success'))
      <div class="alert alert-success alert-icon">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ Session::get('success') }}
          <i class="icon">&#61845;</i>
      </div>
    @endif
    <div class="table-responsive overflow">

        <table class="table tile table-striped" id="trucksTable">

            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>

</div>
@include('trucks.edit')
@include('trucks.add')
@include('trucks.permit')

@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var id = {!! $truckCompObj->id !!};

  var oTable     = $('#trucksTable').DataTable({

                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/truck-list/" + id +"')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'make', name: 'make'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

  function preparePrint(){
		document.getElementById('img').style.height = '150px';
		document.getElementById('print').style.visibility = 'hidden';
		document.getElementById('truck_page_').style.visibility = 'hidden';				  
		document.getElementById('btnClose').style.visibility = 'hidden';
		document.getElementById('depTitle').style.visibility = 'hidden';
		document.getElementById('home').style.visibility = 'hidden';
	}
				
	function restorePage(){
		document.getElementById('img').style.height = '0px';
		document.getElementById('print').style.visibility = 'visible';
		document.getElementById('truck_page_').style.visibility = 'visible';	  
		document.getElementById('btnClose').style.visibility = 'visible';
	    document.getElementById('depTitle').style.visibility = 'visible';
	    document.getElementById('home').style.visibility = 'visible';
	}
	
	function printPermit(){
		preparePrint();
		window.print();
		restorePage();
	}
  


   function launchUpdateTruck(id)
    {


      $(".modal-body #truckID").val(id);


        var cell = $("#case_" + id ).data('mmcell');
        $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/truck/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

				$("#modalEditTruck #registration_number").val(data[0].registration_number);
				$("#modalEditTruck #reference_number").val(data[0].reference_number);
				$("#modalEditTruck #vin_number").val(data[0].vin_number);
				$("#modalEditTruck #chassis_number").val(data[0].chassis_number);
				$("#modalEditTruck #engine_number").val(data[0].engine_number);
				$("#modalEditTruck #registration_year").val(data[0].registration_year);
				$("#modalEditTruck #make").val(data[0].make);
				$("#modalEditTruck #model").val(data[0].model);
				$("#modalEditTruck #colour").val(data[0].colour);
			    $("#modalEditTruck #speed_limit").val(data[0].speed_limit);
				$("#modalEditTruck #date_inactive").val(data[0].date_inactive);

            }
            else {
               $("#modalEditCategory #name").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalAddCategory').modal('show');

    @endif
</script>
@endsection
