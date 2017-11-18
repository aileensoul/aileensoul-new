

<!--<ul>  
<li onclick="switchColors(this);">Link 1</li>  
<li onclick="switchColors(this);">Link 2</li>  
<li onclick="switchColors(this);">Link 3</li>  
</ul>  -->
<ul>  
    <li>Link 1</li>  
    <li>Link 2</li>  
    <li>Link 3</li>  
</ul>  


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.0.3.min.js?ver=' . time()); ?>"></script> 

<script>
    //http://jsfiddle.net/t7L6d7b4/ // alert(links);
    $('li').on('click', function () {

        var links = $("li").length;
        selectedli = $(this).index() + 1;

        $('li').each(function (li) {

            li = li + 1;
            if (li <= selectedli) {
                $(this).addClass('highlight_stay');
            }
            if (li > selectedli) {
                $(this).removeClass('highlight_stay');
            }
        });
//
//      $("li").addClass('highlight_all');
//     $(this).addClass('highlight_stay');
//for (var i = 0 ; i < selectedli ; i ++)  
//links.item(i).style.color = 'yellow' ;  
//element.style.color='orange' ;
    });
</script>