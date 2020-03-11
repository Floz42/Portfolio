export default class Effects {

    /** @description Change colors of logo when it's hover
    */
    logo_hover() {
        $("#logo1").hover(function(){  
            $(this).attr('src','/images/logo2.png');  
            }, function(){  
            $(this).attr('src','/images/logo.png');  
        });  
    }

    /** @description Change presentation card to another with animate library
    */
    presentation_card() {
        $('#presentation_card').hover( function(){
            $(this).addClass('animated  bounceOutRight');
            setTimeout(function() {
                $('#presentation_card2').css('opacity', '1');
                $('#presentation_card2').addClass('animated bounceInRight');
            },1000);
        })
    }

    /** @description Show logo "CV" at right when user start scrol
    */
    show_logo_cv() {
        $(window).scroll(function() {
            $('#download_cv').css('animation', 'opacity 2s forwards');
        });    
    }

    /** @description Hide logo "CV" on click on it
    */
    hide_logo_cv() {
        $('#download_cv').on('click', function() {
            $(this).hide("slow");
        });
    }

    /** @description Hide all message_success class after 8 seconds
    */
    hide_flash_success() {
        if ($('.message_success')) {
            setTimeout(() => {
                $('.message_success').hide("slow");
            },8000);
        }
    }

    /** @description To scroll to each anchor when user click on navbar links
    */
    scrollTo_anchor() {
        $('.scrollTo').on('click', function() {
            let anchor = $(this).attr('href');
            $('html, body').animate({ scrollTop: $(anchor).offset().top - 80 }, 1000 );
            return false;
        });
    }
}
