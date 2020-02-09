
class Effects {

    constructor() {
        this.logo_hover();
    }

    logo_hover() {
        $("#logo1").hover(function(){  
            $(this).attr('src','/images/logo2.png');  
            }, function(){  
            $(this).attr('src','/images/logo.png');  
        });  
    }
}
/* $(document).ready(function(){  
).attr('src','/images/logo.png');  
    });  
  });   */