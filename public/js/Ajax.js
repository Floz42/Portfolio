class Ajax {
    constructor() {
        this.buttons_cv_click();
        this.ajax_cv('infos_ajax');
        this.subscribe_ajax();
        this.submit_ajax();
        this.ajax_post_contact();
        //this.navigation_ajax();
        this.post_comment_ajax();
        this.confirm_submit_ajax();
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
                },
                error : function() {
                    alert('Une erreur s\'est produite lors de la requête.');
                }, 
                complete : function(){
                    $('#content_contact').html('<div class="alert alert-success text-center"> Votre message a bien été envoyé.</div>');
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

/*     navigation_ajax() {
        $('.page-link').each(function() {
            $(this).on('click', function(event) {
                event.preventDefault();
                let page = $(this).attr("href");
                console.log(page);
                $.ajax({
                    url : 'change_page_comments',
                    type : 'POST',
                    data : 'page=' + page,
                    success: function(html) {
                        $('#container_comments').html(html);
                    },
                    complete : function() {
                        $('.page-link').each(function() {
                            var oldUrl = $(this).attr("href");
                            if (oldUrl) {
                                var newUrl = oldUrl.replace("/change_page_comments", "/"); 
                                $(this).attr("href", newUrl); 
                            } 
                        });
                    }
                });
            });
        })
    } */

    submit_ajax() {
        $('#connexion').on('click', function() {
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
        });
    }

    subscribe_ajax() {
        $('#register').on('click', function() {
            $.ajax({
                url : 'subscribe_ajax',
                type : 'POST',
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
        });
    }
    
    post_comment_ajax() {
        $('#button_confirm_comment').on('click', function(e) {
            e.preventDefault();
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
        })
    }

    confirm_submit_ajax() {
        $('#submit_button').click((e) => {
            e.preventDefault();
            console.log("haha");
        })
    }

}

const ajax = new Ajax();