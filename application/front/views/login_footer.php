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

                <div class="col-lg-9 col-md-12 col-sm-12 pull-right col-xs-12">
                    <ul class="footer-ul">
                        <li><a title="About Us" href="<?php echo base_url('about-us'); ?>"  target="_blank">About Us</a><span class="mob-none">|</span></li>
                        <li><a href="<?php echo base_url('terms-and-condition'); ?>" title="Terms and Condition" target="_blank">Terms and Condition</a><span class="mob-none">|</span></li>
                        <li><a href="<?php echo base_url('privacy-policy'); ?>" title="Privacy policy" target="_blank">Privacy policy</a><span class="mob-none">|</span></li>
                        <li><a title="Disclaimer" href="<?php echo base_url('Disclaimer'); ?>"  target="_blank">Disclaimer policy</a><span class="mob-none">|</span></li>
                        <li><a title="Contact Us" href="<?php echo base_url('contact-us'); ?>"  target="_blank">Contact Us</a><span class="mob-none">|</span></li>
                        <li><a title="Blog" href="<?php echo base_url('blog'); ?>" target="_blank">Blog</a><span class="mob-none">|</span></li>
                        <li><a title="Send Us Feedback" href="<?php echo base_url('feedback'); ?>" target="_blank">Send Us Feedback</a><span class="mob-none">|</span></li>
                        <li><a title="Sitemap" href="<?php echo base_url('sitemap'); ?>" target="_blank">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ftr-copuright">
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