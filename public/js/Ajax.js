export default class Ajax {

    /** @description Send email to owner of website and hide contact form
    */
    ajax_post_contact() {
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
            },
            error : function() {
                alert('Une erreur s\'est produite lors de la requête.');
            }, 
            complete : function(){
                $('#content_contact').html('<div class="alert alert-success text-center"> Votre message a bien été envoyé.</div>');
            }
        });
    }

    /** @description Show differents sections to cv 
    */
    ajax_cv(url) {
        $('#cv_ajax').html('<div class="col-md-5 col-xs-8 text-center loading alert alert-info p-2 align-items-center mx-auto">Chargement en cours...</div>');
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

    /** @description Show section submit in ajax
    */
    submit_ajax() {
        $('#form_submit').html('<div class="col-5 text-center loading alert alert-info p-2 align-items-center mt-2 mx-auto">Chargement en cours...</div>');
        $.ajax({
            url : 'login',
            type : 'GET',
            dataType : 'html',
            success : function(html, status){
                $('#form_submit').html("");
                $('#form_submit').html(html);
            },
            error : function(resultat, statut,errur) {
                alert("Une erreur s'est produite lors du chargement du formulaire de connexion.");
            }
        })
    }

    /** @description Show section subscribe in ajax
    */
    subscribe_ajax() {
        $('#form_submit').html('<div class="col-5 text-center loading alert alert-info p-2 align-items-center mt-2 mx-auto">Chargement en cours...</div>');
        $.ajax({
            url : 'subscribe_ajax',
            type : 'GET',
            dataType : 'html',
            success : function(html, status){    
                $('#form_submit').html("");
                $('#form_submit').html(html);
                const subscribe = new Subscribe();
            },
            error : function(resultat, statut,errur) {
                alert("Une erreur s'est produite lors du chargement du formulaire d'inscription.");
            }
        })
    };
    
    /** @description Post comment in ajax and show it with a second ajax call
    */
    post_comment_ajax() {
        let message = encodeURIComponent($("#put_message").val());
        if ($("#put_message").val() === '') {
            $('#all_messages').html("<div class='message_error alert alert-danger col-10 m-auto text-center'>Erreur : la zone de commentaire est vide.</div>");
        } else {
            $.ajax({
                url : 'post_comment',
                type : 'POST',
                data : 'message=' + message,
                success : function(html) {
                    $('#put_message').val('');
                    $.ajax({
                        url : 'show_comments',
                        type : 'GET',
                        success : function(html) {
                            console.log(html);
                            $('#container_comments').html(html);
                        },
                        error : function() {
                            alert('Erreur lors du poste du commentaires');
                        }
                    })
                }, 
                error : function() {
                    $('#all_messages').html("<div class='message_error alert alert-danger col-10 m-auto text-center'>Une erreur s'est produite.</div>").fadeOut(8000);
                    alert('Une erreur s\'est produite.');
                },
                complete : function() {
                    $('#all_messages').css({'display': 'initial', 'margin-top': '2em !important'});
                    $('#all_messages').html("<div class='message_success alert alert-success col-10 m-auto text-center'>Votre commentaire a bien été posté.</div>").fadeOut(8000);
                }
            })
        }
    };
};