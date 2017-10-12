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

$(document).ready(function () {
    business_contacts(slug);

    $(window).scroll(function () {
        //if ($(window).scrollTop() == $(document).height() - $(window).height()) {
//        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7){

            var page = $(".page_number:last").val();
            var total_record = $(".total_record").val();
            var perpage_record = $(".perpage_record").val();
            if (parseInt(perpage_record) <= parseInt(total_record)) {
                var available_page = total_record / perpage_record;
                available_page = parseInt(available_page, 10);
                var mod_page = total_record % perpage_record;
                if (mod_page > 0) {
                    available_page = available_page + 1;
                }
                //if ($(".page_number:last").val() <= $(".total_record").val()) {
                if (parseInt(page) <= parseInt(available_page)) {
                    var pagenum = parseInt($(".page_number:last").val()) + 1;
                    business_contacts(slug, pagenum);
                }
            }
        }
    });
});
var isProcessing = false;
function business_contacts(slug, pagenum) {
    if (isProcessing) {
        /*
         *This won't go past this condition while
         *isProcessing is true.
         *You could even display a message.
         **/
        return;
    }
    isProcessing = true;
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/ajax_bus_contact/" + slug + "?page=" + pagenum,
        data: {total_record: $("#total_record").val()},
        dataType: "html",
        beforeSend: function () {
            if (pagenum == 'undefined') {
                //    $(".business-all-post").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
            } else {
                $('#loader').show();
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        success: function (data) {
            $('.loader').remove();
            $('.contact-frnd-post').append(data);

            // second header class add for scroll
            var nb = $('.post-design-box').length;
            if (nb == 0) {
                $("#dropdownclass").addClass("no-post-h2");
            } else {
                $("#dropdownclass").removeClass("no-post-h2");
            }
            isProcessing = false;
            check_no_contact_list();
        }
    });
}

function business_contacts_header(slug, pagenum) {
    if (isProcessing) {
        /*
         *This won't go past this condition while
         *isProcessing is true.
         *You could even display a message.
         **/
        return;
    }
    isProcessing = true;
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/ajax_bus_contact/" + slug + "?page=" + pagenum,
        data: {total_record: $("#total_record").val()},
        dataType: "html",
        beforeSend: function () {
            if (pagenum == 'undefined') {
                //    $(".business-all-post").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
            } else {
                $('#loader').show();
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        success: function (data) {
            $('.loader').remove();
            $('.contact-frnd-post').append(data);
            // second header class add for scroll
            var nb = $('.post-design-box').length;
            if (nb == 0) {
                $("#dropdownclass").addClass("no-post-h2");
            } else {
                $("#dropdownclass").removeClass("no-post-h2");
            }
            isProcessing = false;
        }
    });
}

// follow user script start 

// follow user script END 
function followuser_two(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/follow_two",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'fr' + clicked_id).html(data);
        }
    });
}
// follow like script end 

// Unfollow user script start 
function unfollowuser_two(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/unfollow_two",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'fr' + clicked_id).html(data);
            check_no_contact_list();
        }
    });
}
// follow like script end 

// scroll page script start 
// For Scroll page at perticular position js Start 
$(document).ready(function () {
    $('html,body').animate({scrollTop: 330}, 100);
});
//For Scroll page at perticular position js End
// scroll page script end 
// contact person script start 


function contact_person_menu(clicked_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/contact_person_menu",
        data: 'toid=' + clicked_id,
        success: function (data) {
            $('#' + 'statuschange' + clicked_id).html(data);
        }
    });
}
// contact person script end 

function removecontactuser(clicked_id) {
    var showdata = window.location.href.split("/").pop();
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/removecontactuser",
        dataType: 'json',
        data: 'contact_id=' + clicked_id + '&showdata=' + showdata,
        success: function (data) {
            
          $('#' + 'statuschange' + clicked_id).html(data.contactdata);
            //$('#' + 'removecontact' + clicked_id).fadeOut(2000);
            if (data.notfound == 1) {
                if (data.notcount == 0) { 
                    $('.contact-frnd-post').html(data.nomsg);
                } else {
                    $('#' + 'removecontact' + clicked_id).fadeOut(2000);
                }
            }
            $('.contactcount').html(data.notcount);
        }
    });
}

function contact_person_cancle(clicked_id, status) {
    if (status == 'confirm') {
        $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='removecontactuser(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    } else if (status == 'pending') {
        $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person_menu(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
}

$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        //$( "#bidmodal" ).hide();
        $('#query').modal('hide');
        //$('.modal-post').show();
    }
});

function contact_person_query(clicked_id, status) {
    $.ajax({
        type: 'POST',
        //url: '<?php echo base_url() . "business_profile/contact_person_query" ?>',
        url: base_url + "business_profile/contact_person_query",
        data: 'toid=' + clicked_id + '&status=' + status,
        success: function (data) { //alert(data);
            // return data;
            contact_person_model(clicked_id, status, data);
        }
    });
}

function contact_person_model(clicked_id, status, data) {

    if (data == 1) {

        if (status == 'pending') {

            $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
            $('#bidmodal').modal('show');

        } else if (status == 'confirm') {

            $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
            $('#bidmodal').modal('show');

        } else {
            contact_person(clicked_id);
        }

    } else {

        $('#query .mes').html("<div class='pop_content'>Sorry, we can't process this request at this time.");
        $('#query').modal('show');

    }
}

function contact_person(clicked_id) {

    $.ajax({
        type: 'POST',
        //url: '<?php echo base_url() . "business_profile/contact_person" ?>',
        url: base_url + "business_profile/contact_person",

        data: 'toid=' + clicked_id,
        success: function (data) {
            //   alert(data);
            $('#contact_per').html(data);

        }
    });
}

function check_no_contact_list() {
    //var numberPost = $('[id^="removepost"]').length;
    var numberList = $('.job-contact-frnd').length;
    if (numberList == 0) {
        $('.contact-frnd-post').html(no_business_contact_html);
    }
}