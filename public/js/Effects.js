
class Effects {

    constructor() {
        this.logo_hover();
        this.presentation_card();
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
}
