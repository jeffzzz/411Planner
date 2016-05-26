var json;
var json2;
$.ajax({
	    type: 'POST',
	    url: 'charts_info.php',
	    data: {type: 0},
	    success: function(msg){
			json = $.parseJSON(msg);
			new Morris.Bar({
			  // ID of the element in which to draw the chart.
			  element: 'morris-area-chart',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  data: json,
			  // The name of the data record attribute that contains x-values.
			  xkey: 'className',
			  // A list of names of data record attributes that contain y-values.
			  ykeys: ['hours', 'classhours'],
			  // Labels for the ykeys -- will be displayed when you hover over the
			  // chart.
			  labels: ['Your Hours', 'Avg. Class Hours']
			});
			
	    	}
	    });
$.ajax({
	    type: 'POST',
	    url: 'charts_info.php',
	    data: {type: 1},
	    success: function(msg){
			json2 = $.parseJSON(msg);
			new Morris.Donut({
			  // ID of the element in which to draw the chart.
			  element: 'morris-donut-chart',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  data: json2,
			});
			
	    	}
	    });
	