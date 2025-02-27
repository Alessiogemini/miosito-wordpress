<?php //phpcs:disable ?>
<script type="text/javascript">
    (function($) {
        "use strict";

        let buttonText = '';
        $(document).ready(function(){
            $('.stm-boats-expand-filter span').on('click', function(){
                $('.stm-filter-sidebar-boats').toggleClass('expanded');
                $('.stm-boats-longer-filter').slideToggle();

                if(buttonText === '') {
                    buttonText = $(this).text();
                    $(this).text(stm_filter_expand_close);
                } else {
                    $(this).text(buttonText);
                    buttonText = '';
                }
            });

        });

    })(jQuery);
</script>
<?php //phpcs:enable ?>
