
class AjaxAdmin {
    
    constructor() {
        this.delete_comment();
        this.delete_user();
        this.update_user();
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
                    console.log(response.data.role);
                    console.log(id);
                    $("#" + id + "").val(response.data.role);
                }).catch(function(error) {
                    alert('Une erreur s\'est produite lors de la reqûete ajax.')
                });
            })
        })
    }


}

const ajax_admin = new AjaxAdmin();