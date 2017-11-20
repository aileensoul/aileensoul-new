<?php
if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'main') {
    ?>
    <footer class="footer">
        <?php
    } else {
        ?>
        <footer>    
            <?php
        }
        ?>
        <div class="container pt20">
            <div class="row">

                <div class="col-md-6 col-sm-8 pull-right col-xs-12">
                    <ul>
                        <li><a href="<?php echo base_url('about-us'); ?>" target="_blank">About Us</a>|</li>
                        <li><a href="<?php echo base_url('contact-us'); ?>" target="_blank">Contact Us</a>|</li>
                        <li><a href="<?php echo base_url('blog'); ?>" target="_blank">Blog</a>|</li>
                        <li><a href="<?php echo base_url('feedback'); ?>" target="_blank">Send Us Feedback</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-4 col-xs-12">
                    <span>    &#9400; 2017 | by Aileensoul </span>
                </div>
            </div>
        </div>
    </footer>

   <!-- IMAGE PRELOADER SCRIPT -->
<script type="text/javascript">
//  function preload(arrayOfImages) {
//     $(arrayOfImages).each(function () {
//         $('<img />').attr('src',this).appendTo('body').css('display','none');
//     });
// }

$.fn.preload = function (fn) {
    var len = this.length, i = 0;
    return this.each(function () {
        var tmp = new Image, self = this;
        if (fn) tmp.onload = function () {
            fn.call(self, 100 * ++i / len, i === len);
        };
        tmp.src = this.src;
    });
};

$('img').preload(function(perc, done) {
    console.log(this, perc, done);
});
</script>
<!-- IMAGE PRELOADER SCRIPT -->