
var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap-sass');

// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    callAjax("/checkBuilds", function (response) {});
});

window.callAjax = function(url, fun){
    $.ajax({
        async: false,
        type: "POST",
        url: url,
        data: '{ }',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: fun
    });
};
window.build_number_id = 0;
window.build = function(id){

    function addBuild(name, time) {
        var id  = 'build_'+build_number_id;
        var box = '<tr><td>'+name+'</td><td id="'+id+'"></td></tr>';
        
        $("#builds_in_progress").append(box);
        build_number_id++;
        timer(id,time);
    }

    callAjax("/build/"+id, function (response) {
        if (response.result == "fail") {
            $("#info").css({"background-color":"#ff0c003d"}).html(response.info);
        } else {
            $("#info").html(response.info);
            addBuild(response.data.name,response.data.build_time);
        }
    });
};

window.timer = function (id, time){
    var myVar = setInterval(myTimer, 1000);

    function myTimer() {
        if (!time) {
            document.getElementById(id).innerHTML = "Zrobione";
            myStopFunction();
        } else {
            document.getElementById(id).innerHTML = time;
            time--;
        }
    }
    function myStopFunction() {
        clearInterval(myVar);
    } 
}
