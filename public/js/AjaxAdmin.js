
class AjaxAdmin {
    
    constructor() {
        this.delete_comment();
        this.delete_user();
        this.update_user();
        this.delete_xp();
        this.buttons_admin_cv_click();
    }

    delete_comment() {
        $('.admin_delete_comment').each(function() {
            $(this).click((event) => {
                event.preventDefault();
                const id = $(this).parents("th").parents("tr").attr('class');
                const url = this.href;
                axios.get(url).then(function(response) {
                    $("."+ id + "").html("");
                    $('#admin_delete_comment_message').html("<div class='alert alert-success col-4 m-auto text-center'>Le commentaire a bien été supprimé</div>");
                }).catch(function(error) {
                    alert('Une erreur s\'est produite lors de la reqûete ajax.')
                });
            })
        })
    }

    delete_xp() {
        $('.admin_delete_xp').each(function() {
            $(this).click((event) => {
                event.preventDefault();
                const id = $(this).parents("th").parents("tr").attr('class');
                const url = this.href;
                axios.get(url).then(function(response) {
                    $("." + id + "").val(response.data.role)
                    $("."+ id + "").html("");
                    $('#admin_delete_user_message').html("<div class='alert alert-success col-4 m-auto text-center'>L'utilisateur a bien été supprimé</div>");
                }).catch(function(error) {
                    alert('Une erreur s\'est produite lors de la reqûete ajax delete xp.')
                })
            })
        })
    }

    delete_user() {
        $('.admin_delete_user').each(function() {
            $(this).click((event) => {
                event.preventDefault();
                const id = $(this).parents("th").parents("tr").attr('class');
                const url = this.href;
                axios.get(url).then(function(response) {
                    $("."+ id + "").html("");
                    $('#admin_delete_user_message').html("<div class='alert alert-success col-4 m-auto text-center'>L'utilisateur a bien été supprimé</div>");
                }).catch(function(error) {
                    alert('Une erreur s\'est produite lors de la reqûete ajax.')
                });
            })
        })
    }

    update_user() {
        $('.admin_update_user').each(function() {
            $(this).click((event) => {
                event.preventDefault();
                const id = $(this).children('input').attr('id');
                const url = this.href;
                axios.get(url).then(function(response) {
                    $("#" + id + "").val(response.data.role);
                }).catch(function(error) {
                    alert('Une erreur s\'est produite lors de la reqûete ajax.')
                })
            })
        })
    }

    buttons_admin_cv_click() {
        $("#admin_button_infos").on('click', () => this.ajax_cv('admin_infos_ajax'));
        $("#admin_button_diplomes").on('click', () => this.ajax_cv('admin_diplomes_ajax'));
        $("#admin_button_xp").on('click', () => this.ajax_cv('admin_experiences_ajax'));
        $("#admin_button_sskills").on('click', () => this.ajax_cv('admin_softskills_ajax'));
    }

    ajax_cv(url) {
        axios.get(url).then(function(data) {
            $('#admin_content_cv').html(data.data);
        }).catch(function(error) {
            alert('Une erreur s\'est produite lors du chargement du CV.');
        });
    };


}

const ajax_admin = new AjaxAdmin();