class Ajax {
    constructor() {
        this.buttons_cv_click();
        this.ajax_cv('infos_ajax');
     }


    buttons_cv_click() {
        $("#button_diplomes").on('click', () => this.ajax_cv('diplomes_ajax'));
        $("#button_infos").on('click', () => this.ajax_cv('infos_ajax'));
        $("#button_experiences").on('click', () => this.ajax_cv('experiences_ajax'));
        $("#button_skills").on('click', () => this.ajax_cv('softskills_ajax'));

    }
    ajax_cv(url) {
        $.ajax({
            url : url,
            type : 'GET',
            dataType : 'html',
            success : function(code_html, statut){ 
                $('#cv_ajax').html(code_html);
            },
            error : function(resultat, statut, erreur){
                alert("Une erreur sest produite lors de la requête: " + url);
            }
         });
    }
}

const ajax = new Ajax();