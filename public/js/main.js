    // ADD CLASS TO SYMFONY DIV FORM
    $('form div ul').addClass('col-12 alert alert-danger');

    //CLASS EFFECTS WHO CONTAIN GENERALS EFFECTS TO PORTFOLIO
    import Effects from './Effects.js';
    const effect = new Effects();

    effect.logo_hover();
    effect.presentation_card();
    effect.show_logo_cv();
    effect.hide_logo_cv();
    effect.hide_flash_success();
    effect.scrollTo_anchor();

    //CLASS SKILLS WHO DESCRIBE THE LANGUAGES THAT I KNOW
    import Skills from './Skills.js';
    const skills = new Skills(5); 
    skills.active = true; 
    skills.array_frameworks = [0,2,3];
    skills.show_cv();
    $('#first_round_skills').on('click', () => { skills.show_cv() });

    // CLASS AJAX WITH ALL AJAX CALL IN FRONTEND SECTION
    import Ajax from './Ajax.js';
    const ajax = new Ajax();
    ajax.ajax_cv('infos_ajax');

    $('#register').on('click', () => {
        ajax.subscribe_ajax();
    });

    $("#button_diplomes").on('click', () => ajax.ajax_cv('diplomes_ajax'));
    $("#button_infos").on('click', () => ajax.ajax_cv('infos_ajax'));
    $("#button_experiences").on('click', () => ajax.ajax_cv('experiences_ajax'));
    $("#button_skills").on('click', () => ajax.ajax_cv('softskills_ajax'));

    $('#connexion').on('click', () => {
        ajax.submit_ajax();
    });

    $('#button_confirm_comment').on('click', (e) => {
        e.preventDefault();
        ajax.post_comment_ajax();
    });

    $('#contact form').on('submit', (e) => {
        e.preventDefault();
        ajax.ajax_post_contact();
    });

    // CLASS SLIDER
    import Slider from './Slider.js';
    const slider = new Slider();

    $('#chevron_left').on('click', slider.prev.bind(slider));
    $('#chevron_right').on('click', slider.next.bind(slider));

    $(document).on('keydown', slider.arrows.bind(slider));






    







