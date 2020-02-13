class CVFlo {

    constructor() {
        this.active = true; 
        this.show_cv();
    }

    round(i) {
        $('#skills').append("<div id='round" + i + "' style='animation: opacity 0.5s forwards' class='round_skills'></div>");
    }

    vertical_line(i) {
        $('#skills').append("<div id='line" + i + "' style='animation: line_height 0.5s forwards' class='line_skills'></div>");
    }

    horizontal_line_left(i) {
        $('#skills').append("<div class='horizontal_line_left'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_left'></div>");
    }

    horizontal_line_right(i) {
        $('#skills').append("<div class='horizontal_line_right'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_right'></div>");
}

    show_cv() {
        $('#first_round_skills').on('click', () => {
            if (this.active) {
                this.active = false;
                $('.round_skills, .line_skills, .horizontal_line_right, .horizontal_line_left').fadeOut(500,"linear");
            } else {
                this.active = true;
                for(let i=0;i<=4;i++) {
                    this.vertical_line(i);
                    this.round(i);
                    if (i % 2 === 0) {
                        this.horizontal_line_left(i);
                    } else {
                        this.horizontal_line_right(i);
                    } 
                }
            }
        });
    }
}
 
const cv = new CVFlo();