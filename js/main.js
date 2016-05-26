$(document).ready(function() {
  $("a#logoff").on("click", function(){
        $.removeCookie('email', {path: '/'});
        window.location.replace("index.php")
  });
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	var url = "http://myplanner.web.engr.illinois.edu/";
	var calendar = $('#calendar');
	calendar.fullCalendar({
	
   header: {
		left: 'prev,next today',
		center: 'title',
      // month,agendaWeek,
      right: 'agendaDay'
   },

   editable: true,
   selectable: true,
   selectHelper: true,
   defaultView: 'agendaDay',
   allDaySlot: false,

   events: {
            url: 'events.php',
            type: 'POST', // Send post data
            error: function() {
                alert("Sorry we couldn\'t display your events, contact support");
            }
        },
   // Convert the allDay from string to boolean
   eventRender: function(event, element, view) {
   	if (event.allDay === 'true') {
   		event.allDay = true;
   	} else {
   		event.allDay = false;
   	}
   },
   select: function(start, end, allDay) {
   	var title = prompt('Input Title:');
      var idnum;
   	if (title) {
         var start = moment(start).format("YYYY-MM-DD HH:mm:ss");
         var end = moment(end).format("YYYY-MM-DD HH:mm:ss");
         $.ajax({
            url: url + 'addevents.php',
            data: 'title='+ title+'&start='+ start +'&end='+ end,
            type: "POST",
            success: function(json) {
				 calendar.fullCalendar('refetchEvents');
           }
       	 });
   	}
      calendar.fullCalendar('unselect');
   },
   editable: true,

   eventDrop: function(event, delta) {
   	var start = moment(event.start).format("YYYY-MM-DD HH:mm:ss");
   	var end = moment(event.end).format("YYYY-MM-DD HH:mm:ss");
   	$.ajax({
   		url: url + 'updateevents.php',
   		data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
   		type: "POST",
   		success: function(json) {
   			alert("Updated Successfully");
   		}
   	});
   },
   eventResize: function(event) {
   	var start = moment(event.start).format("YYYY-MM-DD HH:mm:ss");
    var end = moment(event.end).format("YYYY-MM-DD HH:mm:ss");
    $.ajax({
       url: url + 'updateevents.php',
       data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
       type: "POST",
       success: function(json) {
         alert("Updated Successfully");
      }
   });
 },
 eventClick: function(event) {
  var decision = confirm("Do you really want to do that?"); 
  if (decision) {
    $.ajax({
      type: "POST",
      url: url + "deleteevents.php",

      data: "&id=" + event.id
   });
    $('#calendar').fullCalendar('removeEvents', event.id);

 } else {
 }
}
});
});
