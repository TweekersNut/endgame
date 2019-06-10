<?php

use APP\Helpers\URL_Helper as URL;
use APP\Models\Settings as Settings;
?>
</div>
<!-- Copyright -->
<div class="copyright-w3layouts py-xl-3 py-2 mt-xl-5 mt-4 text-center">
    <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All Rights Reserved | Develop By <a href="https://tweekersnut.com">TweekersNut Network</a>
    </p>
</div>
<!--// Copyright -->
</div>
</div>

<script type='text/javascript'>var URL_ROOT = "<?= URL_ROOT ?>";</script>
<!-- Required common Js -->
<script src='<?= URL_ROOT ?>admin/js/jquery-2.2.3.min.js'></script>
<!-- //Required common Js -->

<!-- Core -->
<script src='<?= URL_ROOT ?>admin/js/core.js'></script>
<!-- //Core -->

<!-- loading-gif Js -->
<script src="<?= URL_ROOT ?>admin/js/modernizr.js"></script>
<script>
    //paste this code under head tag or in a seperate js file.
    // Wait for window load
    $(window).load(function () {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
        ;
    });
</script>
<!--// loading-gif Js -->

<!-- Sidebar-nav Js -->
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<!--// Sidebar-nav Js -->

<!-- Calender -->
<script src="<?= URL_ROOT ?>admin/js/moment.min.js"></script>
<script src="<?= URL_ROOT ?>admin/js/pignose.calender.js"></script>
<script>
    //<![CDATA[
    $(function () {
        $('.calender').pignoseCalender({
            select: function (date, obj) {
                obj.calender.parent().next().show().text('You selected ' +
                        (date[0] === null ? 'null' : date[0].format('YYYY-MM-DD')) +
                        '.');
            }
        });

        $('.multi-select-calender').pignoseCalender({
            multiple: true,
            select: function (date, obj) {
                obj.calender.parent().next().show().text('You selected ' +
                        (date[0] === null ? 'null' : date[0].format('YYYY-MM-DD')) +
                        '~' +
                        (date[1] === null ? 'null' : date[1].format('YYYY-MM-DD')) +
                        '.');
            }
        });
    });
    //]]>
</script>
<!--// Calender -->

<!-- profile-widget-dropdown js-->
<script src="<?= URL_ROOT ?>admin/js/script.js"></script>
<!--// profile-widget-dropdown js-->

<!-- dropdown nav -->
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
        );
    });
</script>
<!-- //dropdown nav -->

<!-- Js for bootstrap working-->
<script src="<?= URL_ROOT ?>admin/js/bootstrap.min.js"></script>
<!-- //Js for bootstrap working -->

<!-- Tiny MCE -->
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=<?= (new Settings)->getValue('editor.tinymce')->_val ?>"></script> 
<script>tinymce.init({selector: '#postDesc'});</script>
</body>

</html>