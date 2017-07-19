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
//CODE FOR AUTOFILL OF SEARCH KEYWORD END
//CODE FOR AUTOFILL OF SEARCH LOCATION START
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
//CODE FOR AUTOFILL OF SEARCH LOCATION END
//CHECK SEARCH KEYWORD AND LOCATION BLANK START
function checkvalue() {
                    var searchkeyword = $.trim(document.getElementById('tags').value);
                    var searchplace = $.trim(document.getElementById('searchplace').value);
                    if (searchkeyword == "" && searchplace == "") {
                        return  false;
                    }
                }
//CHECK SEARCH KEYWORD AND LOCATION BLANK END
//FOR PREELOADER START
 jQuery(document).ready(function ($) {
                    $(window).load(function () {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                });
//FOR PREELOADER END
//FORM FILL UP VALIDATION START
  $(document).ready(function () {

                    $("#freelancer_post_avability").validate({
                        rules: {
                            work_hour: {
                                required: false,
                                number: true,
                                max: 168
                            },
                        },
                        messages: {
                            work_hour: {
                                max: "Number should be between 0-168"
                            },
                        }
                    });
                });
//FORM FILL UP VALIDATION END
//FLASH MESSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MESSAGE SCRIPT END


