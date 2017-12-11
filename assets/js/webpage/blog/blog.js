$('document').ready(function(){
    
});

//Click on Read more Process Start

$(document).on("click", '#read_more', function() { 
    var  blog_id = $(this).attr('blog_id');
    var  blog_slug = $(this).attr('blog_slug');
    $.ajax({
        type: 'POST',
        url: base_url + 'blog/read_more',
        data: 'blog_id=' + blog_id,
        success: function (data) {
            if (data == 1)
            {
                window.location = base_url + "blog/" + blog_slug;
            }

        }
    });
});


function read_more(blog_id, slug) {
    
    $.ajax({
        type: 'POST',
        url: base_url + 'blog/read_more',
        data: 'blog_id=' + blog_id,
        success: function (data) {
            if (data == 1)
            {
                window.location = base_url + "blog/" + slug;
            }

        }
    });
}
//Click on Read more Process Start

// FOR SEARCH VALIDATION FOR EMAPTY SEARCH START 
function checkvalue()
{
    var searchkeyword = $.trim(document.getElementById('q').value);
    if (searchkeyword == "")
    {
        return false;
    }
}
// FOR SEARCH VALIDATION FOR EMAPTY SEARCH END 

// THIS SCRIPT IS USED FOR SCRAP IMAGE FOR FACEBOOK POST TO GET REAL IMAGE START
$(document).ready(function () {
//   $(".fbk").on('click', function() { alert("facebook");
//   
//         var url= $(this).attr('url');
//         var url_encode= $(this).attr('url_encode');
//         var title=$(this).attr('title');
//         var summary= $(this).attr('summary');
//         var image=$(this).attr('image');
//   
//          $.ajax({
//          type: 'POST',
//          url: 'https://graph.facebook.com?id='+url+'&scrape=true',
//              success: function(data){
//                 console.log(data);
//             }
//   
//      });
//           window.open('http://www.facebook.com/sharer.php?s=100&p[title]='+title+'&p[summary]='+summary+'&p[url]='+ url_encode+'&p[images][0]='+image+'', 'sharer', 'toolbar=0,status=0,width=620,height=280');
//   });

});
function facebookcheck()
{
    var url = $(this).attr('url');
    var url_encode = $(this).attr('url_encode');
    var title = $(this).attr('title');
    var summary = $(this).attr('summary');
    var image = $(this).attr('image');

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com?id=' + url + '&scrape=true',
        success: function (data) {
            console.log(data);
        }

    });
    window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + summary + '&p[url]=' + url_encode + '&p[images][0]=' + image + '', 'sharer', 'toolbar=0,status=0,width=620,height=280');
}

function googlecheck()
{ 
    alert($(this).attr('id'));
    return false;
   var url = $(this).attr('url');
    var url_encode = $(this).attr('url_encode');
    var title = $(this).attr('title');
    
    window.open('https://plus.google.com/share?url=' + url_encode + '", "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
}

$(document).on("click", '#google_link', function(event) { 
    var  url = $(this).attr('url_encode');
    window.open('https://plus.google.com/share?url=' + url +'', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
});

$(document).on("click", '#linked_link', function(event) { 
    var  url = $(this).attr('url_encode');
    window.open('https://www.linkedin.com/cws/share?url=' + url +'', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
});

$(document).on("click", '#twitter_link', function(event) { 
    var  url = $(this).attr('url_encode');
    window.open('https://twitter.com/intent/tweet?url=' + url +'', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
});

$(document).on("click", '#facebook_link', function(event) { 
    var url = $(this).attr('url');
    var url_encode = $(this).attr('url_encode');
    var title = $(this).attr('title');
    var summary = $(this).attr('summary');
    var image = $(this).attr('image');

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com?id=' + url + '&scrape=true',
        success: function (data) {
            console.log(data);
        }

    });
    window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + summary + '&p[url]=' + url_encode + '&p[images][0]=' + image + '', 'sharer', 'toolbar=0,status=0,width=620,height=280');
});


// THIS SCRIPT IS USED FOR SCRAP IMAGE FOR FACEBOOK POST TO GET REAL IMAGE END