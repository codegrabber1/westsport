(function($) {
    "use strict";
    $( document ).ready( function () {
        //$('select.styled').customSelect();

        $(".tab_block").hide();
        $(".tabs ul li:first").addClass("active").show();
        $(".tab_block:first").show();

        $(".tabs ul li").click(function() {
            $(".tabs ul li").removeClass("active");
            $(this).addClass("active");
            $(".tab_block").hide();
            var activeTab = $(this).find("a").attr("href");
            $(activeTab).fadeIn(200);
            return false;
        });

        setTimeout(function () {
            $(".fade").fadeOut("slow", function () {
                $(".fade").remove();
            });
        }, 2000);

        //Top header colorpicker
        $('#cg_topheader_color_selector').ColorPicker({
  				onChange: function (hsb, hex, rgb) {
  						$('#cg_topheader_color_selector div').css('backgroundColor', '#' + hex);
  						$('#cg_topheader_color').val('#'+hex);
  				}
  			});

        //Links colorpicker
        $('#cg_links_color_selector').ColorPicker({
  				onChange: function (hsb, hex, rgb) {
  						$('#cg_links_color_selector div').css('backgroundColor', '#' + hex);
  						$('#cg_links_color').val('#'+hex);
  				}
  			});

    })
})(jQuery);
