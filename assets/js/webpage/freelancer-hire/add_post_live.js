//SCRIPT FOR DATEPICKER START
$(function () {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var today = yyyy;
    $("#example2").dateDropdowns({
        submitFieldName: 'last_date',
        submitFormat: "yyyy-mm-dd",
        minYear: today,
        maxYear: today + 1,
        daySuffixes: false,
        monthFormat: "short",
        dayLabel: 'DD',
        monthLabel: 'MM',
        yearLabel: 'YYYY',
        //startDate: today,
    });
    $(".day").attr('tabindex', 8);
    $(".day").attr('onChange', 'check_datevalidation();');
    //$(".day").attr('required', 'required');
    $(".month").attr('tabindex', 9);
    $(".month").attr('onChange', 'check_datevalidation();');
    //$(".month").attr('required', 'required');
    $(".year").attr('tabindex', 10);
    $(".year").attr('onChange', 'check_datevalidation();');
    //$(".year").attr('required', 'required');
});
//SCRIPT FOR DATEPICKER END 

function login_profile() {

    $('#register_profile').modal('hide');
    $('#login').modal('show');
}
function register_profile() {
    $('#login').modal('hide');
    $('#register_profile').modal('show');
}
function forgot_profile() {
    $('#forgotPassword').modal('show');
}
$(function () {
    function split(val) {
        return val.split(/,\s*/);
    }
    function extractLast(term) {
        return split(term).pop();
    }

    $("#skills2").bind("keydown", function (event) {
        if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
            event.preventDefault();
        }
    })
            .autocomplete({
                minLength: 2,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    $.getJSON(base_url + "general/get_skill", {term: extractLast(request.term)}, response);
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {

                    var text = this.value;
                    var terms = split(this.value);

                    text = text == null || text == undefined ? "" : text;
                    var checked = (text.indexOf(ui.item.value + ', ') > -1 ? 'checked' : '');
                    if (checked == 'checked') {

                        terms.push(ui.item.value);
                        this.value = terms.split(", ");
                    }//if end

                    else {
                        if (terms.length <= 20) {
                            // remove the current input
                            terms.pop();
                            // add the selected item
                            terms.push(ui.item.value);
                            // add placeholder to get the comma-and-space at the end
                            terms.push("");
                            this.value = terms.join(", ");
                            return false;
                        } else {
                            var last = terms.pop();
                            $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                            $(this).effect("highlight", {}, 1000);
                            $(this).attr("style", "border: solid 1px red;");
                            return false;
                        }
                    }
                }//end else


            });
});
$.validator.addMethod("regx", function (value, element, regexpr) {
    //return value == '' || value.trim().length != 0; 
    if (!value)
    {
        return true;
    } else
    {
        return regexpr.test(value);
    }
    // return regexpr.test(value);
}, "Only space, only number and only special characters are not allow");
$.validator.addMethod("regx_num_space", function (value, element, regexpr) {
    //return value == '' || value.trim().length != 0; 
    if (!value)
    {
        return true;
    } else
    {
        return regexpr.test(value);
    }
    // return regexpr.test(value);
}, "Please add proper Estimated time. Eg: '3 month' or '3 Year' ");
$(document).ready(function () {
    $("#postinfo").validate({
        ignore: '*:not([name])',
        rules: {
            post_name: {
                required: true,
                regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
            skills: {
                required: true,
                regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
            fields_req: {
                required: true,
            },
            post_desc: {
                required: true,
                regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
//            last_date: {
//                last_date_require: true,
//                isValid: true
//            },
//            currency: {
//                required: true,
//            },
            rate: {
                number: true,
            },
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            est_time: {
                regx_num_space: /[0-9\s][a-zA-Z]/
            }

        },
        messages: {
            post_name: {
                required: "Project name is required."
            },
            skills: {
                required: "Skill is required."
            },
            fields_req: {
                required: "Please select field of requirement."
            },
            post_desc: {
                required: "Project description  is required."
            },
//            last_date: {
//                //required: "Last Date of apply is required.",
//            },
//            currency: {
//                required: "Please select currency type",
//            },
          
            country: {
                required: "Please select country."
            },
            state: {
                required: "Please select state."
            }

        },
         submitHandler: submitaddpostForm
    });
});
// FORM FILL UP VALIDATION END
function submitaddpostForm() {
    register_profile();
}
function check_datevalidation() {
    var day = $('.day').val();
    var month = $('.month').val();
    var year = $('.year').val();
    if (day == '' || month == '' || year == '') {
        if (day == '') {
            $('.day').addClass('error');
        }
        if (month == '') {
            $('.month').addClass('error');
        }
        if (year == '') {
            $('.year').addClass('error');
        }
        $('.date-dropdowns .last_date_error').remove();
        $('.date-dropdowns').append('<label for="example2" class="error last_date_error">Last Date of apply is required.</label>');
        return false;
        //<label for="example2" class="error">Last Date of apply is required.</label>
    } else {
        var todaydate = new Date();
        var dd = todaydate.getDate();
        var mm = todaydate.getMonth() + 1; //January is 0!
        var yyyy = todaydate.getFullYear();
        var todaydate_in_str = yyyy.toString() + mm.toString() + dd.toString();


        var selected_date_in_str = "" + year + month + day;

        if (parseInt(todaydate_in_str) > parseInt(selected_date_in_str)) {
            $('.day').addClass('error');
            $('.month').addClass('error');
            $('.year').addClass('error');

            $('.date-dropdowns .last_date_error').remove();
            $('.date-dropdowns').append('<label for="example2" class="error last_date_error">Last date should be grater than and equal to today date</label>');
            return false;
        } else {
            $('.day').removeClass('error');
            $('.month').removeClass('error');
            $('.year').removeClass('error');
            $('.date-dropdowns .last_date_error').remove();
            return true;
        }
    }
}

$("form").submit(function () {
    var day = $('.day').val();
    var month = $('.month').val();
    var year = $('.year').val();
    if (day == '' || month == '' || year == '') {
        if (day == '') {
            $('.day').addClass('error');
        }
        if (month == '') {
            $('.month').addClass('error');
        }
        if (year == '') {
            $('.year').addClass('error');
        }
        $('.date-dropdowns .last_date_error').remove();
        $('.date-dropdowns').append('<label for="example2" class="last_date_error" style="display: block;">Last Date of apply is required.</label>');
        return false;

    } else {
        var todaydate = new Date();
        var dd = todaydate.getDate();
        var mm = todaydate.getMonth() + 1; //January is 0!
        var yyyy = todaydate.getFullYear();
        var todaydate_in_str = yyyy.toString() + mm.toString() + dd.toString();


        var selected_date_in_str = "" + year + month + day;

        if (parseInt(todaydate_in_str) > parseInt(selected_date_in_str)) {
            $('.day').addClass('error');
            $('.month').addClass('error');
            $('.year').addClass('error');

            $('.date-dropdowns .error').show();
            $('.date-dropdowns').append('<label for="example2" class="error last_date_error">Last date should be grater than and equal to today date</label>');
            $('.date-dropdowns .last_date_error').removeAttr('style');
            return false;
        } else {
            $('.day').removeClass('error');
            $('.month').removeClass('error');
            $('.year').removeClass('error');
            $('.date-dropdowns .last_date_error').remove();
            return true;
        }
    }
});
    $.validator.addMethod("lowercase", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Email should be in small character");
    $("#register_form").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
//            email_reg: {
//                required: true,
//                email: true,
//              //  lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
//                remote: {
//                    url: base_url + "registration/check_email",
//                    type: "post",
//                    data: {
//                        email_reg: function () {
//                            // alert("hi");
//                            return $("#email_reg").val();
//                        },
//                        csrf_token_name: csrf_hash,
//                    },
//                },
//            },
            password_reg: {
                required: true,
            },
            selday: {
                required: true,
            },
            selmonth: {
                required: true,
            },
            selyear: {
                required: true,
            },
            selgen: {
                required: true,
            }
        },

        groups: {
            selyear: "selyear selmonth selday"
        },
        messages:
                {
                    first_name: {
                        required: "Please enter first name",
                    },
                    last_name: {
                        required: "Please enter last name",
                    },
//                    email_reg: {
//                        required: "Please enter email address",
//                        remote: "Email address already exists",
//                    },
                    password_reg: {
                        required: "Please enter password",
                    },

                    selday: {
                        required: "Please enter your birthdate",
                    },
                    selmonth: {
                        required: "Please enter your birthdate",
                    },
                    selyear: {
                        required: "Please enter your birthdate",
                    },
                    selgen: {
                        required: "Please enter your gender",
                    }

                },
        submitHandler: submitRegisterForm
    });
       function submitRegisterForm()
    {
      
        var postid = '';
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email_reg = $("#email_reg").val();
        var password_reg = $("#password_reg").val();
        var selday = $("#selday").val();
        var selmonth = $("#selmonth").val();
        var selyear = $("#selyear").val();
        var selgen = $("#selgen").val();
        var postid = $(".post_id_login").val();
//alert(postid);
        var post_data2 = {
            'first_name': first_name,
            'last_name': last_name,
            'email_reg': email_reg,
            'password_reg': password_reg,
            'selday': selday,
            'selmonth': selmonth,
            'selyear': selyear,
            'selgen': selgen,
            csrf_token_name: csrf_hash
        }


        var todaydate = new Date();
        var dd = todaydate.getDate();
        var mm = todaydate.getMonth() + 1; //January is 0!
        var yyyy = todaydate.getFullYear();

        if (dd < 10) {
            dd = '0' + dd
        }

        if (mm < 10) {
            mm = '0' + mm
        }

        var todaydate = yyyy + '/' + mm + '/' + dd;
        var value = selyear + '/' + selmonth + '/' + selday;


        var d1 = Date.parse(todaydate);
        var d2 = Date.parse(value);
        if (d1 < d2) {
            $(".dateerror").html("Date of birth always less than to today's date.");
            return false;
        } else {
            if ((0 == selyear % 4) && (0 != selyear % 100) || (0 == selyear % 400))
            {
                if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {
                    if (selday == 31) {
                        $(".dateerror").html("This month has only 30 days.");
                        return false;
                    }
                } else if (selmonth == 2) { //alert("hii");
                    if (selday == 31 || selday == 30) {
                        $(".dateerror").html("This month has only 29 days.");
                        return false;
                    }
                }
            } else {
                if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {
                    if (selday == 31) {
                        $(".dateerror").html("This month has only 30 days.");
                        return false;
                    }
                } else if (selmonth == 2) {
                    if (selday == 31 || selday == 30 || selday == 29) {
                        $(".dateerror").html("This month has only 28 days.");
                        return false;
                    }
                }
            }
        }
        $.ajax({
            type: 'POST',
            url: base_url + 'registration/reg_insert',
            dataType: 'json',
            data: post_data2,
            beforeSend: function ()
            {
                $("#register_error").fadeOut();
                $("#btn1").html('Create an account ...');
            },
            success: function (response)
            {

                var userid = response.userid;
                if (response.okmsg == "ok") {
                    var post_name = $("#post_name").val();
                    var post_desc = $("#post_desc").val();
                    var skill = $("#skills2").val();
                    var fields_req = $("#fields_req").val();
                    var year = $("#year").val();
                    var month =  $("#month").val();
                    var est_time = $("#est_time").val();
                    var datepicker = $("#example2").val();

                    var post_data1 = {
                        'post_name': post_name,
                        'skills': post_desc,
                        'skill': skill,
                        'field': fields_req,
                        'year': year,
                        'month': month,
                        'est_time': est_time,
                        'last_date': datepicker,
                        csrf_token_name: csrf_hash
                    }
                    if(post_name != ''){
                          $.ajax({
                        type: 'POST',
                        url: base_url + 'freelancer/add_post_added',
                        data: post_data1,
                        dataType: "json",
                        success: function (response) {
                            if (response.data == "ok") {
                                window.location = base_url + "recruiter/registration/live-post";
                            }
                        }
                    });
                    }else{
                        window.location = base_url + "dashboard";
                    }
                  

                    return false;

                } else {
                    $("#register_error").fadeIn(1000, function () {
                        $("#register_error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
                        $("#btn1").html('Create an account');
                    });
                }

            }
        });
        return false;
    }