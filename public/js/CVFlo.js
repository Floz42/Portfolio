class CVFlo {

    constructor(total_skills) {
        this.total_skills= parseInt(total_skills) - 1;
        this.active = true; 
        $('#first_round_skills').on('click', () => { this.show_cv() });
        this.array_frameworks = [0,2,3];
    }

    round(i) {
        $('#skills').append("<div id='round" + i + "' style='animation: opacity 0.5s forwards' class='round_skills'></div>");
    }

    vertical_line(i) {
        $('#skills').append("<div id='line" + i + "' style='animation: line_height 0.5s forwards' class='line_skills'></div>");
    }

    horizontal_line_left(i) {
        $('#skills').append("<div id='image" + i + "' class='horizontal_line_left'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_left'></div>");
    }

    horizontal_line_right(i) {
        $('#skills').append("<div id='image" + i + "' class='horizontal_line_right'><img src='/images/languages/" + i + ".png' alt='language' class='language_skills_right'></div>");
    }

    show_cv() {
        let i;
        if (this.active) {
            this.active = false;
            $('.round_skills, .line_skills, .horizontal_line_right, .horizontal_line_left').fadeOut(500,"linear");
        } else {
            this.active = true;
            for(i=0;i<=this.total_skills;i++) {        
                this.vertical_line(i);
                this.round(i);
                if (i % 2 === 0) {
                    this.horizontal_line_left(i);
                } else {
                    this.horizontal_line_right(i);
                } 
                if (this.array_frameworks[i] === i)  {
                    $("#image" + i).append("<img class='framework' src='/images/languages/" + i + "" + i + "-framework.png'>");
                }
            }


        }
    }
}
 
const cv = new CVFlo(5);