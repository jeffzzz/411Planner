/**
 * Created by enriqueespaillat on 4/15/15.
 */
function checkdate(input){
    var date_regex = /^\d{4}-\d{1,2}-\d{1,2}$/ ;
    return date_regex.test(input);
}
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function embedData(id)
{
    var clas = $("#class").val();
    var desc = $("#desc").val();
    var due = $("#due").val();
    var est = $("#est").val();
    var hoursWorked = $("#hoursworked").val();
    var progress = $('percentcomplete').val();
    if(progress >= 100) progress = 100;
    var html = "<td>" + clas + "</td>";
    html += "<td>" + desc  + "</td>";
    html += "<td><div class=\"progress\"><div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\""+ progress +"\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " + progress + "%\"></div></div></td>";
    html += "<td id=\"remove\"><span class=\"button\"><button class=\"btn btn-default btn-sm\"><i class=\"glyphicon glyphicon-remove\"></i></button></span></td></tr>";
    alert(html);
    $('#task-table tbody').append(html);

}
function validData()
{
    var clas = $("#class").val();
    var desc = $("#desc").val();
    var due = $("#due").val();
    var est = $("#est").val();
    var hoursWorked = $("#hoursworked").val();
    var perComplete = $("#percentcomp").val();
    var ret = true;
    var string = "Fix the following:\n";
    if(clas == "")
    {
        $("#class").parent().addClass("has-error");
        string += "Your class is empty.\n";
        ret = false;
    }
    if(desc == "")
    {
        $("#desc").parent().addClass("has-error");
        string += "Your description is empty.\n";
        ret = false;

    }
    if(!checkdate(due))
    {
        $("#due").parent().addClass("has-error");
        string += "Invalid Date.\n";
        ret = false;

    }
    if(est == "")
    {
        $("#est").parent().addClass("has-error")
		string += "Your estimated time is empty.\n";
        ret = false;
    }
    if(hoursWorked == "")
    {
        $("#hoursworked").parent().addClass("has-error")
        string += "Your hours worked is empty.\n";
        ret = false;
    }
    if(perComplete == "")
    {
        $("#percentcomp").parent().addClass("has-error");
        string += "Your percentcomp is empty.\n";
        ret = false;
    }
    if(!ret)
    	alert(string);
    return ret;
}
$(document).ready(function(){
    var result = false;
    $("#add_row").click(function(){
        if(validData())
        {
            dat = {
                "clas" : $("#class").val(),
                "desc" : $("#desc").val(),
                "due" : $("#due").val(),
                "est" : $("#est").val(),
                "hoursWorked" : $("#hoursworked").val(),
                "percentComplete" : $("#percentcomp").val()
            };
		    $.ajax({
		    type: 'POST',
		    url: 'add_hw.php',
		    data: dat}).done(function(msg){
		    	window.location.reload();
		    });

        }
    });
    $(".progress_cell").click(function(){
    	var process = true;
    	var id = $(this).parent().attr('id');
    	var logHours = prompt("Log more hours", "i.e. 1");
    	while(logHours == "" || !isNumeric(logHours))
    	{
    		if(logHours == null)
    		{
    			process = false;
	    		break;
    		}
	    	logHours = prompt("Log more hours (Enter a number!)", "i.e. 1");
    	}
    	if(process)
    	{
	    	var progress = prompt("Whats your progress?", "[0-100]");
	    	while(progress == "" || !isNumeric(progress) || progress < 0 || progress > 100)
	    	{
	    	if(progress == null)
    		{
    			process = false;
	    		break;
    		}
		    	progress = prompt("Whats your progress? (Enter a number from 0-100!)", "i.e. 1");
	    	}
	    	if(process)
	    	{
	    	dat = {
		    	"id" : id,
		    	"hours" : logHours,
		    	"progress" : progress	
	    	};
	    	$.ajax({
		    	type: 'POST',
			    url: 'update_hw.php',
			    data : dat,
			    success: function(msg){
				    window.location.reload();

			    }
	    	});
	    	}
    	}
    });
    $(".remove-btn").click(function(){
    	var row = $(this).parent().parent();
		var id = row.attr('id');
		confirm("Are you sure?");
		$.ajax({
		    	type: 'POST',
			    url: 'remove_hw.php',
			    data : {"id" : id},
			    success: function(msg){
				    row.remove();
			    }
	    	});

    });

});