class Ajax {
    constructor() {
        this.buttons_cv_click();
        this.ajax_cv('infos_ajax');
        this.subscribe_ajax();
        this.submit_ajax();
        this.subscribe_post();
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
            success : function(html, statut){ 
                $('#cv_ajax').html(html);
            },
            error : function(resultat, statut, erreur){
                alert("Une erreur s'est produite lors de la requête: " + url);
            }
         });
    }

    subscribe_ajax() {
        $('#register').on('click', function() {
            $.ajax({
                url : 'subscribe_ajax',
                type : 'GET',
                dataType : 'html',
                success : function(html, status){
                    $('#form_subscribe_submit').html(html);
                    const subscribe = new Subscribe();
                },
                error : function(resultat, statut,errur) {
                    alert("Une erreur s'est produite lors du chargement du formulaire d'inscription.");
                }
            })
        });
    }

/*     subscribe_post() {
        $('#subscribe_button').on('click', function() {
            $.ajax({
                url : 'subscribe_ajax',
                type : 'POST',
                dataType : 'html',
                success : function(html, status){
                    alert('Tout s\'est bien passé.');
                },
                error : function(resultat, statut,errur) {
                    alert("Une erreur s'est produite lors du chargement du formulaire d'inscription.");
                }
            })
        });
    } */

    submit_ajax() {
        $('#connexion').on('click', function() {
            $.ajax({
                url : 'submit_ajax',
                type : 'GET',
                dataType : 'html',
                success : function(html, status){
                    $('#form_subscribe_submit').html(html);
                },
                error : function(resultat, statut,errur) {
                    alert("Une erreur s'est produite lors du chargement du formulaire de connexion.");
                }
            })
        });
    }
}

const ajax = new Ajax();