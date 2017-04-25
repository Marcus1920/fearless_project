@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-trucks-companies') }}">Companies</a></li>
    <li class="active">Companies Listing</li>
</ol>

<h4 class="page-title">TRUCK COMPANIES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Truck Companies Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" onClick="launchAddDepartmentModal();" data-target=".modalAddCompany">
     Add Company
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
        <table class="table tile table-striped" id="truckCompaniesTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@include('truckCompanies.edit')
@include('truckCompanies.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var oTable     = $('#truckCompaniesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/truck-companies-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-trucks/" + d.id + "') !!}' class='btn btn-sm'>" + d.company_trading_name + "</a>";

                },"name" : 'name'},
                {data: 'contact_email', name: 'contact_email'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateCompanyModal(id)
    {

       $(".modal-body #companyID").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/companies/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditCompany #reg_company_name").val(data[0].reg_company_name);
			   $("#modalEditCompany #company_trading_name").val(data[0].company_trading_name);
			   $("#modalEditCompany #company_reg_number").val(data[0].company_reg_number);
			   $("#modalEditCompany #company_tax_number").val(data[0].company_tax_number);
			   $("#modalEditCompany #physical_address").val(data[0].physical_address);
			   $("#modalEditCompany #postal_address").val(data[0].postal_address);
			   
			   $("#modalEditCompany #contact_person").val(data[0].contact_person);
			   $("#modalEditCompany #contact_email").val(data[0].contact_email);
			   $("#modalEditCompany #contact_phone_number").val(data[0].contact_phone_number);
			   $("#modalEditCompany #fax_number").val(data[0].fax_number);
			   
               


            }
            else {
               $("#modalEditDepartment #name").val('');
               $("#modalEditDepartment #acronym").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalEditDepartment').modal('show');

    @endif


</script>
@endsection
