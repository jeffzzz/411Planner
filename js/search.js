  $(document).ready(function() {
    $('#title-search').on('input', function() {
        var srch = $(this).val();
        if (srch.length >= 1) {
            $.post('searchquery.php', {val: srch}, function (data) {
                $('tbody#results').empty()
                $.each(data, function () {
                    var html = "<tr id=\"" + this.id + "\"><td>" + this.id + "</td>";
                    html += "<td>" + this.title + "</td>";
                    html += "<td>" + this.day + "</td>";
                    html += "<td>" + this.stime + "</td>";
                    html += "<td>" + this.etime + "</td>";
                    html += "<td id=\"remove\"><span class=\"center glyphicon glyphicon-remove\"></span></td></tr>"
                    $('#results-table tbody').append(html);
                });
            }, "json");
        }else{
            $('tbody#results').empty()
        }
    });
    $('#results').on("click", "td#remove", function(){
        var pid = $(this).parent().attr("id");
        $.post('deleteevents.php', {id: pid}, function(data){
            $("tr#"+pid).remove();
        });

    });
    $("a#logoff").on("click", function(){
        $.removeCookie('email', {path: '/'});
        window.location.replace("index.php")
  });
});