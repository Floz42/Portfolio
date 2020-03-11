export default class Skills {

    constructor(total_skills) {
        this.total_skills= parseInt(total_skills) - 1;
    }

    /** @description add "round" to the section (serve to add a language)
    */
    round(i) {
        $('#skills').append("<div id='round" + i + "' style='animation: opacity 0.5s forwards' class='round_skills'></div>");
    }

    /** @description add "vertical line'" to te section (serve to add a language)
    */
    vertical_line(i) {
        $('#skills').append("<div id='line" + i + "' style='animation: line_height 0.5s forwards' class='line_skills'></div>");
    }

    /** @description add "horizontal line'" to te section (serve to add a language)
    */
    horizontal_line_left(i) {
        $('#skills').append("<div id='image" + i + "' class='one_skill horizontal_line_left'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_left'></div>");
    }

    /** @description add "horizontal line'" to te section (serve to add a language)
    */
    horizontal_line_right(i) {
        $('#skills').append("<div id='image" + i + "' class='one_skill horizontal_line_right'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_right'></div>");
    }

    /** @description if number of skill is in the array_framework, we ad one.
    */
    framework(i) {
        let number_skills = $('.one_skill').length;
        for (let i2 = 0; i2 <= number_skills; i2++) {
            if (this.array_frameworks[i2] === i)  {
                $("#image" + i).append("<img class='framework' src='/images/languages/" + i + "" + i + "-framework.png'>");
            }
        }
    }

    /** @description variable i will serve here to construct the cv section 
    */
    show_cv() {
        if (this.active) {
            $('#skills').html('');
            this.active = false;
        } else {
            for(let i=0;i<=this.total_skills;i++) {        
                this.vertical_line(i);
                this.round(i);
                if (i % 2 === 0) {
                    this.horizontal_line_left(i);
                } else {
                    this.horizontal_line_right(i);
                } 
                this.framework(i);
                this.active = true;
            }
        }
    }
}
