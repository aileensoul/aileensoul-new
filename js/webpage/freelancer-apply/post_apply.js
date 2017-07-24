//CODE FOR SAVE USER START            
            function save_post(abc)
            {
                $.ajax({
                    type: 'POST',
                    url:  base_url + "freelancer/save_user",
                    data: 'post_id=' + abc,
                    success: function (data) {
                        $('.' + 'savedpost' + abc).html(data).addClass('saved');
                    }
                });

            }
            function savepopup(id) {
                save_post(id);
                $('.biderror .mes').html("<div class='pop_content'>Post successfully saved.");
                $('#bidmodal').modal('show');
            }
//CODE FOR SAVE USER END             
//CODE FOR AUTOFILL OF SEARCH KEYWORD START            

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
//CODE FOR AUTOFILL OF SEARCH KEYWORD END
//CODE FOR AUTOFILL OF SEARCH PLACE START
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
            // window.location.href = ui.item.value;
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
//CODE FOR AUTOFILL OF SEARCH PLACE END
//CODE FOR CHECK SEARCH KEYWORD AND LOCATION BLANK START
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
//CODE FOR CHECK SEARCH KEYWORD AND LOCATION BLANK END
//CODE FOR APPLY POST START
            function apply_post(abc, xyz) {
                var alldata = 'all';
                var user = xyz;
                $.ajax({
                    type: 'POST',
                    url:  base_url + "freelancer/apply_insert",
                    data: 'post_id=' + abc + '&allpost=' + alldata + '&userid=' + user,
                    success: function (data) {
                        $('.savedpost' + abc).hide();
                        $('.applypost' + abc).html(data);
                        $('.applypost' + abc).attr('disabled', 'disabled');
                        $('.applypost' + abc).attr('onclick', 'myFunction()');
                        $('.applypost' + abc).addClass('applied');
                    }
                });
            }
            function applypopup(postid, userid) {
                $('.biderror .mes').html("<div class='pop_content'>Do you want to apply for this work?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                $('#bidmodal').modal('show');
            }
//CODE FOR APPLY POST END 
//ALL POPUP CLOSE USING ESC START
$(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    $('#bidmodal').modal('hide');
                }
            });
//ALL POPUP CLOSE USING ESC END

//SCRIPT FOR NO POST ADD CLASS DESIGNER RELATED HEADER2 START
$(document).ready(function () {
                var nb = $('div.job-post-detail').length;
                if (nb == 0) {
                    $("#dropdownclass").addClass("no-post-h2");
                }
            });
//SCRIPT FOR NO POST ADD CLASS DESIGNER RELATED HEADER2 END 


