// CODE FOR AUTOFILL OF SEARCH KEYWORD START
$(function () {
    $("#tags").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#tags").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#tags").val(ui.item.label);
        }
    });
});
$(function () {
    // alert(data);
    $("#tags1").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#tags1").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#tags1").val(ui.item.label);
        }
    });
});
//CODE FOR AUTOFILL OF SEARCH PLACE START
//CODE FOR AUTOFILL OF SEARCH PLACE END
$(function () {
    $("#searchplace").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data1, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#searchplace").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#searchplace").val(ui.item.label);
        }
    });
});
$(function () {
    $("#searchplace1").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data1, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#searchplace1").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#searchplace1").val(ui.item.label);
        }
    });
});
// CODE FOR AUTOFILL OF SEARCH KEYWORD END
//FUNCTION FOR CHECK VALUE OF SEARCH KEYWORD AND PLACE ARE BLANK START
function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "") {
        return false;
    }
}
function check() {
    var keyword = $.trim(document.getElementById('tags1').value);
    var place = $.trim(document.getElementById('searchplace1').value);
    if (keyword == "" && place == "") {
        return false;
    }
}
//FUNCTION FOR CHECK VALUE OF SEARCH KEYWORD AND PLACE ARE BLANK END
//CODE FOR SAVE USER START
function savepopup(id) {
    save_user(id);

    $('.biderror .mes').html("<div class='pop_content'>Your Freelancer is successfully saved.");
    $('#bidmodal').modal('show');
}
function save_user(abc)
{
    var saveid = document.getElementById("hideenuser" + abc);
    $.ajax({
        type: 'POST',
        url:  base_url + "freelancer/save_user1",
        data: 'user_id=' + abc + '&save_id=' + saveid.value,
        success: function (data) {
            $('.' + 'saveduser' + abc).html(data).addClass('saved');
        }
    });
}
//CODE FOR SAVE USER END
//ALL POPUP CLOSE USING ESC START
 $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    $('#bidmodal').modal('hide');
                }
            });
//ALL POPUP CLOSE USING ESC END