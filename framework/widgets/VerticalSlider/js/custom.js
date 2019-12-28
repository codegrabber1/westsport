jQuery(document).ready(function($){
    $('.widget_block .tab').click(function(){
        $('.widget_block .tab').removeClass('active').eq($(this).index()).addClass('active');
        $('.tab_item').hide().eq($(this).index()).fadeIn();
    }).eq(0).addClass('active');
});