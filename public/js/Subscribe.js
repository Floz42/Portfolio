class Subscribe {
    constructor() {
        $('#error_pseudo').hide();
        $('#error_password').hide();
        $('#error_password_verify').hide();
        $('#subscribe form').on('submit', (e) => { 
            if (this.verify() == false) {
                e.preventDefault();
            } 
        });
    }

    /** @description verify all inputs to form subscribe
     *  @return bool
    */
    verify() {
        let isValid = true;
        if ($('#inscription_username').val().length < 5) {
            isValid = false;
            $('#error_pseudo').show();;
        } 
        if ($('#inscription_password').val().length < 6) {
            isValid = false;
            $('#error_password').show();;
        } 
        if ( $('#inscription_password').val() !=  $('#inscription_verifPassword').val()) {
            isValid = false;
            $('#error_password_verify').show();;
        } 
        return isValid;
    }
}

const subscribe = new Subscribe();