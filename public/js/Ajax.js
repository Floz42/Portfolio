class Ajax {
    constructor() {
        this.buttons_cv_click();
        this.ajax_cv('infos_ajax');
        this.subscribe_ajax();
        this.submit_ajax();
        this.ajax_post_contact();
        this.navigation_ajax();
    }

    buttons_cv_click() {
        $("#button_diplomes").on('click', () => this.ajax_cv('diplomes_ajax'));
        $("#button_infos").on('click', () => this.ajax_cv('infos_ajax'));
        $("#button_experiences").on('click', () => this.ajax_cv('experiences_ajax'));
        $("#button_skills").on('click', () => this.ajax_cv('softskills_ajax'));
    }

    ajax_post_contact() {
        $('#contact form').on('submit', function(e) {
            e.preventDefault();
            let form = $('#contact form').get(0);
            let url = $(this).attr("action");
            let formData = new FormData(form);
            $.ajax({
                type : 'POST',
                url : url,
                data : formData,
                processData: false,
                contentType: false, 
                success : function(data) {
                    $('#content_contact').html('<div class="alert alert-success text-center"> Votre message a bien été envoyé.</div>');
                },
                error : function() {
                    alert('Une erreur s\'est produite lors de la requête.');
                }
            });
        })
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

    navigation_ajax() {
        $('.page-link').each(function() {
            $(this).on('click', function(event) {
                event.preventDefault();
                let url = 'http://localhost:8000/?page=2';
                console.log(this);
 
                console.log(url);
                $.ajax({
                    url : url,
                    type : 'GET',
                    dataType: 'html'
                });
            });
        })
    }

    submit_ajax() {
        $('#connexion').on('click', function() {
            $.ajax({
                url : 'login',
                type : 'GET',
                dataType : 'html',
                success : function(html, status){
                    $('#form_submit').html(html);
                },
                error : function(resultat, statut,errur) {
                    alert("Une erreur s'est produite lors du chargement du formulaire de connexion.");
                }
            })
        });
    }

    subscribe_ajax() {
        $('#register').on('click', function(e) {
            $.ajax({
                url : 'subscribe_ajax',
                type : 'GET',
                dataType : 'html',
                success : function(html, status){
                    $('#form_subscribe').html(html);
                    const subscribe = new Subscribe();
                },
                error : function(resultat, statut,errur) {
                    alert("Une erreur s'est produite lors du chargement du formulaire d'inscription.");
                }
            })
        });
    }

}

const ajax = new Ajax();