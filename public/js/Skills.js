class Skills {

    constructor(total_skills) {
        this.total_skills= parseInt(total_skills) - 1;
        this.active = true; 
        this.array_frameworks = [0,2,3];
        this.show_cv();
        $('#first_round_skills').on('click', () => { this.show_cv() });
    }

    round(i) {
        $('#skills').append("<div id='round" + i + "' style='animation: opacity 0.5s forwards' class='round_skills'></div>");
    }

    vertical_line(i) {
        $('#skills').append("<div id='line" + i + "' style='animation: line_height 0.5s forwards' class='line_skills'></div>");
    }

    horizontal_line_left(i) {
        $('#skills').append("<div id='image" + i + "' class='one_skill horizontal_line_left'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_left'></div>");
    }

    horizontal_line_right(i) {
        $('#skills').append("<div id='image" + i + "' class='one_skill horizontal_line_right'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_right'></div>");
    }

    framework(i) {
        let number_skills = $('.one_skill').length;
        for (let i2 = 0; i2 <= number_skills; i2++) {
            if (this.array_frameworks[i2] === i)  {
                $("#image" + i).append("<img class='framework' src='/images/languages/" + i + "" + i + "-framework.png'>");
            }
        }
    }

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
 
const cv = new Skills(5);