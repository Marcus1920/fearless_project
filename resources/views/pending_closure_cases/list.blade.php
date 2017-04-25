@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li class="active">Pending Closure Cases Listing</li>

</ol>

<h4 class="page-title">PENDING CLOSURE CASES</h4>


<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Pending Closure Cases Listing</h3>
    <a class="btn btn-sm" data-toggle="modal"  data-target=".modalCreateCaseAgent">
        Create Case
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
        <table class="table tile table-striped" id="deletedCasesTable">
                <thead>
                    <tr>
                    <th>Case Number</th>
                    <th>Created At</th>
                    <th>Description</th>
                    <th>Source</th>
                    <th>Priority</th>
                        <th>Actions</th>

                </tr>
            </thead>
        </table>
    </div>
</div>
@include('cases.profile')
@include('cases.refer')
@include('cases.report')
@include('cases.allocation')
@include('cases.create')
@include('cases.createCase')
@include('cases.closeRequest')
@include('addressbook.list')
@include('addressbook.add')
@include('casenotes.add')
@include('casefiles.add')
@include('users.edit')
@include('cases.workflow')
@include('cases.poi')
@include('cases.dueDate')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var oTable     = $('#provincesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/provinces-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-districts/" + d.id + "') !!}' class='btn btn-sm'>" + d.name + "</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateProvinceModal(id)
    {

       $(".modal-body #provinceID").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/provinces/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditProvince #name").val(data[0].name);

            }
            else {
               $("#modalEditProvince #name").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalDepartment').modal('show');

    @endif


</script>
@endsection
