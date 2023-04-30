$(document).ready(function() {
    $("#result").submit();
});

$("#result").submit(function(e) {
    e.preventDefault();
    var formURL = $(this).attr("action");
    var postData = $(this).serializeArray();
    $.ajax({
        url: formURL,
        type: "post",
        data : postData,
        datatype: "html"
    }).done(function(data) {
        renderTable(data);
    }).fail(function(jqXHR, ajaxOptions, thrownError) {
        alert('No response from server');
    });
});

$(document).on('click','.btnact',function(e) {
    var url_data = $(this).attr('link');
    $.post(url_data,'',function(res){
        $("#result").submit();
    });
});

$(document).on('click','.req_detail',function(e) {
    var url_data = $(this).attr('link');
    $.post(url_data,'',function(res){
        $(".modal-header").removeClass('bg-green');
        $(".modal-header").addClass('bg-blue');
        $('#genModel').modal();
        $(".modal-title").html('Item Detail');
        $(".modal-body").html(res);
    });
});

$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getData(page);
        }
    }
});
$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    });
});

function getData(page) {
    var postData = $("#result").serializeArray();
    console.log(postData);
    $.ajax({
        url: '?page=' + page,
        type: "post",
        data : postData,
        datatype: "html"
    }).done(function(data) {
        renderTable(data);
    }).fail(function(jqXHR, ajaxOptions, thrownError) {
        alert('No response from server');
    });
}

function renderTable(data) {
    domObj = $("#resultdata");
    domObj.empty().html(data);
    if(domObj.attr('isDT')=="true") {
        if(domObj.attr('isExport')=="true") {
            DynkdDTExp('kdTable');
        } else {
            DynkdDT('kdTable');
        }
    }
}
