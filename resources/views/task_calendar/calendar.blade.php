@extends('master')

@section('content')


<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
	<li><a href="{{ url('calendarreal') }}">Calendar-Cases</a></li>
    <li class="active">Calendar</li>
</ol>

<?php

$selectUsers    =  App\User::where('active','=',1)->get();
$user = \Auth::user()->role;

?>

<h4 class="page-title">CALENDAR - TASKS</h4>

<div class="form-group col-md-3" style="display: block; margin-left: 35%;">
<h4>  
	@if($user === 1 || $user === 2 || $user === 3)
	<div class="col-md-6>">
		<select   id="selectUser" class="form-control input-sm" data-live-search="true">
			<option  >-- Select  All --</option>
				@foreach  ($selectUsers as  $selectUsers)
			<option value="{!! $selectUsers -> name !!}">{!! $selectUsers -> name !!}</option>
				@endforeach
		</select>
	</div>
	@endif
</h4>
</div>

<div class="col-md-12 clearfix">

    <div id="calendar" class="p-relative p-10 m-b-20">
        <!-- Calendar Views -->
        <ul class="calendar-actions list-inline clearfix">
            <li class="p-r-0">
                <a data-view="month" href="#" class="tooltips" title="Month">
                    <i class="sa-list-month"></i>
                </a>
            </li>
            <li class="p-r-0">
                <a data-view="agendaWeek" href="#" class="tooltips" title="Week">
                    <i class="sa-list-week"></i>
                </a>
            </li>
            <li class="p-r-0">
                <a data-view="agendaDay" href="#" class="tooltips" title="Day">
                    <i class="sa-list-day"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
</div>

@include('cases.profile')
@include('functions.caseModal')
@endsection
@section('footer')

<script type="text/javascript">
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		var url =  'cases-calendar-list';
		
		$('#refresh').click(function() {
			var moment = $('#calendar').fullCalendar('getDate');
			//var tomorrow = new Date.today().addDays(1).toString("dd-mm-yyyy");
			var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000)
			
			if(moment > tomorrow){
				alert("greater");
			}{
				alert("lesser");
			}
			//alert('hey');
		});
		
        $('#calendar').fullCalendar({
            header: {
                 center: 'title',
                 left: 'prev, next',
                 right: ''
            },
        eventClick: function(calEvent, jsEvent, view) {
			
			var id = calEvent.title;
			//var due_date = calEvent.due_date;
			var caseid = id.substring(9,id.length);
			/*var moment = $('#calendar').fullCalendar('getDate');
			var iMoment = new Date(moment);
			var iDue_date = new Date(due_date.substring(0,4),due_date.substring(5,7),due_date.substring(8,10));
			if(iMoment > iDue_date){
				alert("greater");
			}else{
				alert("lesser" + moment.getDate());
			}*/
			
			launchCaseModal(caseid);
			$('#modalCase').modal('show');
			 
			
             // alert('Event: ' + calEvent.title);
              //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
              //alert('View: ' + view.name);
              // change the border color just for fun
              $(this).css('border-color', 'red');

          },

            selectable: true,
            selectHelper: true,
            editable: false,
			
			events: {
				url: "{!! url('/" + url+ "/')!!}",
				error: function() {
					$('#script-warning').show();
				}
			},
			
			/*events: [
				{
					title: 'All Day Event',
					start: '2016-12-01'
				},
				{
					title: 'Long Event',
					start: '2016-12-07',
					end: '2016-12-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-12-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-12-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2016-12-11',
					end: '2016-12-13'
				},
				{
					title: 'Meeting',
					start: '2016-12-12T10:30:00',
					end: '2016-12-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2016-12-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2016-12-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2016-12-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2016-12-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2016-12-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-12-28'
				}
			],*/
			
			
            /*eventSources: [

                {

                    headers : { 'X-CSRF-Token': '{{ csrf_token() }}' },
                    url: "{!! url('/cases-calendar-list/')!!}",
                    type: 'GET',
                    data: {
                        custom_param1: 'something',
                        custom_param2: 'somethingelse'
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: 'yellow',
                    textColor: 'black'
                }


            ],*/

            //On Day Select
            /*select: function(start, end, allDay) {
                $('#addNew-event').modal('show');
                $('#addNew-event input:text').val('');
                $('#getStart').val(start);
                $('#getEnd').val(end);
            },*/

            eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
                $('#editEvent').modal('show');

                var info =
                    "The end date of " + event.title + "has been moved " +
                    dayDelta + " days and " +
                    minuteDelta + " minutes."
                ;

                $('#eventInfo').html(info);


                $('#editEvent #editCancel').click(function(){
                     revertFunc();
                })
            }
        });

        $('body').on('click', '#addEvent', function(){
             var eventForm =  $(this).closest('.modal').find('.form-validation');
             eventForm.validationEngine('validate');

             if (!(eventForm).find('.formErrorContent')[0]) {

                  //Event Name
                  var eventName = $('#eventName').val();

                  //Render Event
                  $('#calendar').fullCalendar('renderEvent',{
                       title: eventName,
                       start: $('#getStart').val(),
                       end:  $('#getEnd').val(),
                       allDay: true,
                  },true ); //Stick the event

                  $('#addNew-event form')[0].reset()
                  $('#addNew-event').modal('hide');
             }
        });
    });
	
	$("#selectUser").change(function(){
		$('#calendar').fullCalendar('destroy');
		var user = $("#selectUser option:selected").text();
		
		var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		var url = "";
		
		if(user == "-- Select  All --"){
			url = "cases-calendar-list";
		}else{
			url = "cases-calendar-list-perUser/" + user;
		}
		
		
		 $.ajax({
			type    :"GET",
			dataType:"json",
			url     : "{!! url('/" + url+ "')!!}",
			success :function(data) {

				$('#calendar').fullCalendar({
					header: {
					 center: 'title',
					 left: 'prev, next',
					 right: ''
				},
				eventClick: function(calEvent, jsEvent, view) {
				
					var id = calEvent.title;
					var caseid = id.substring(9,id.length);
					launchCaseModal(caseid,1);
					$('#modalCase').modal('show');
					 
				
					 // alert('Event: ' + calEvent.title);
					  //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
					  //alert('View: ' + view.name);
					  // change the border color just for fun
					  $(this).css('border-color', 'red');

				},

				selectable: true,
				selectHelper: true,
				editable: false,
			
				events: {
					url: "{!! url('/" + url+ "')!!}",
					error: function() {
						$('#script-warning').show();
					}
				},
			

				eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
					$('#editEvent').modal('show');

					var info =
						"The end date of " + event.title + "has been moved " +
						dayDelta + " days and " +
						minuteDelta + " minutes."
					;

					$('#eventInfo').html(info);


					$('#editEvent #editCancel').click(function(){
						 revertFunc();
					})
				}
			});

			$('body').on('click', '#addEvent', function(){
				 var eventForm =  $(this).closest('.modal').find('.form-validation');
				 eventForm.validationEngine('validate');

				 if (!(eventForm).find('.formErrorContent')[0]) {

					  //Event Name
					  var eventName = $('#eventName').val();

					  //Render Event
					  $('#calendar').fullCalendar('renderEvent',{
						   title: eventName,
						   start: $('#getStart').val(),
						   end:  $('#getEnd').val(),
						   allDay: true,
					  },true ); //Stick the event

					  $('#addNew-event form')[0].reset()
					  $('#addNew-event').modal('hide');
				 }
			});
			}
		});
		
		
		
        
	});

    //Calendar views
    $('body').on('click', '.calendar-actions > li > a', function(e){
        e.preventDefault();
        var dataView = $(this).attr('data-view');
        $('#calendar').fullCalendar('changeView', dataView);

        //Custom scrollbar
        var overflowRegular, overflowInvisible = false;
        overflowRegular = $('.overflow').niceScroll();
    });

</script>

@endsection

