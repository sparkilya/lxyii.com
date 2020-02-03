authors = [];



function getAuthors() {
    $.ajax({
        url: "/admin/getjsonauthors",
        type: 'GET',
        success: function(res) {
            
            var res = JSON.parse(res);

            if(res.length==0) {
                $('#login-form').html('<h2>Please add an author first.</h2>')
            }
            
            $.each(res,function(index, value){
                $('.load-authors').append('<div class="author-select"><input type="checkbox" value="'+value.id+'"><span>'+value.name+'</span></div>');
            });
        }
    });
}


function checkboxCheck(data) {


    thisid = $(data).val();

    if($(data).prop("checked") == true){
        
        authors.push(thisid);

        console.log(authors);

    }
    else if($(data).prop("checked") == false){
        authors = jQuery.grep(authors, function(value) {
            return value != thisid;
          });
        console.log(authors);
    }

    $('#books-authors').val(authors);

}


if (window.location.href.indexOf("addbook") > -1) {

    $(document).ready(function(){
        getAuthors();
    });
}



if (window.location.href.indexOf("editbook") > -1) {

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
              tmp = item.split("=");
              if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }

    var getId = findGetParameter('id');

    var authors = [];


    getAuthors();

    setTimeout(function(){
        $.ajax({
            url: "/admin/getjsonauthorsbyid",
            type: 'GET',
            data: {'id': getId},
            success: function(res) {
                var res = JSON.parse(res);
                $.each(res,function(index, value){
                    console.log(value.author.name);
                    $('.load-authors span').each(function(){
                        if($(this).html() == value.author.name) {
                            $(this).parent().find('input').prop("checked", true);
                        }
                    });
                });

                $('.load-authors input[type=checkbox]').each(function(){
                    checkboxCheck($(this));
                });
            }
        });
    }, 1000);
}




$(document).on("click", 'input[type="checkbox"]', function(event) {

    checkboxCheck($(this));
    
});




$('.book-delete-action').click(function(){
    data = $(this).attr('data');

    thiss = $(this);

    $.ajax({
        url: "/admin/deletebook",
        type: 'POST',
        data: {'id': data},
        success: function(res) {
            $(thiss).parent().parent().css({'opacity': "0.3"});
            $(thiss).parent().html('<span>Deleted</span>');
        }
    });
});



$('.author-delete-action').click(function(){
    data = $(this).attr('data');

    thiss = $(this);

    $.ajax({
        url: "/admin/deleteauthor",
        type: 'POST',
        data: {'id': data},
        success: function(res) {
            $(thiss).parent().parent().css({'opacity': "0.3"});
            $(thiss).parent().html('<span>Deleted</span>');
        }
    });
});

$('.author-edit-action').click(function(){
    data = $(this).attr('data');
    window.location.replace("/admin/editauthor?id="+data);
});


$('.book-edit-action').click(function(){
    data = $(this).attr('data');
    window.location.replace("/admin/editbook?id="+data);
});