
class Effects {

    constructor() {
        this.logo_hover();
        this.presentation_card();
        this.show_logo_cv();
        this.hide_logo_cv();
        this.hide_flash_success();
    }

    logo_hover() {
        $("#logo1").hover(function(){  
            $(this).attr('src','/images/logo2.png');  
            }, function(){  
            $(this).attr('src','/images/logo.png');  
        });  
    }

    presentation_card() {
        $('#presentation_card').hover( function(){
            $(this).addClass('animated  bounceOutRight');
            setTimeout(function() {
                $('#presentation_card2').css('opacity', '1');
                $('#presentation_card2').addClass('animated bounceInRight');
            },1000);
        })
    }

    show_logo_cv() {
        $(window).scroll(function() {
            $('#download_cv').css('animation', 'opacity 2s forwards');
        });    
    }

    hide_logo_cv() {
        $('#download_cv').on('click', function() {
            $(this).hide("slow");
        });
    }

    hide_flash_success() {
        if ($('.message_success')) {
            setTimeout(() => {
                $('.message_success').hide("slow");
            },8000);
        }
    }
}
