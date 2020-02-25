class Subscribe {
    constructor() {
        $('#error_pseudo').hide();
        $('#error_password').hide();
        $('#error_password_verify').hide();
        $('#subscribe_button').on('click', () => { this.verify() });
    }

    verify() {
            console.log($('#inscription_username').val().length);
            let isValid = true;
            if ($('#inscription_username').val().length < 5) {
                isValid = false;
                $('#error_pseudo').show();;
            } else {
                $('#error_pseudo').hide();
            }
            if ($('#inscription_password').val().length < 6) {
                isValid = false;
                $('#error_password').show();;
            } else {
                $('#error_password').hide();
            }
            if ( $('#inscription_password').val() !=  $('#inscription_verifPassword').val()) {
                isValid = false;
                $('#error_password_verify').show();;
            } else {
                $('#error_password_verify').hide();;
            }
            return isValid;
    }
}

