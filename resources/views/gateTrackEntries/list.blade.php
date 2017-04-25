@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li class="active">Gate Track Entries</li>
</ol>

<h4 class="page-title">GATE TRACK ENTRIES</h4>


<iframe src="http://durbanport.gatetrack.co.za/vehiclelist?hideheader=true&uid=1998457089" id="gate-track-entries"></iframe>

@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  });

</script>
@endsection
