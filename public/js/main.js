

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





