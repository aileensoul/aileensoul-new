//ALL POPUP CLOSE USING ESC START
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});
//ALL POPUP CLOSE USING ESC END

//CODE FOR DESIGNATION START
function divClicked() {
    var divHtml = $(this).html();
    var editableText = $("<textarea />");
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
    editableText.blur(editableTextBlurred);
}
function capitalize(s){
    return s[0].toUpperCase() + s.slice(1);
}
function editableTextBlurred() {
    var html = $(this).val();
    var viewableText = $("<a>");
    if (html.match(/^\s*$/) || html == '') {
        html = "Current Work";
    }
    viewableText.html(capitalize(html));
    $(this).replaceWith(viewableText);
    // setup the click event for this new div
    viewableText.click(divClicked);

    $.ajax({
        url: base_url + "freelancer/hire_designation",
        type: "POST",
        data: {"designation": html},
        success: function (response) {

        }
    });
}
$(document).ready(function () {
    $("a.designation").click(divClicked);
});
//CODE FOR DESIGNATION END


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


//CODE FOR SHOW POPUP OF WHEN PROFILE PIC OR COVER PIC IMG TYPE NOT SUPPORED START
function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>Please select only Image File Type.(jpeg,jpg,png,gif)");
    $('#bidmodal').modal('show');
}
//CODE FOR SHOW POPUP OF WHEN PROFILE PIC AND COVER PIC IMG TYPE NOT DUPPORTED END


//FOR SCROLL PAGE AT PERTICULAR POSITION IS START
$(document).ready(function () {
    $('html,body').animate({scrollTop: 265}, 100);
});
//FOR SCROLL PAGE AT PERTICUKAR POSITION IS END
