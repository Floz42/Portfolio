class Slider {

    constructor() {
        this.index = 0;
        this.getInfos(this.index);
        this.getLength();
        this.length = 0;
        this.view_thumbnails();

        $('#chevron_left').on('click', this.prev.bind(this));
        $('#projects').on("swipeleft", this.prev.bind(this));

        $('#chevron_right').on('click', this.next.bind(this));
        $('#projects').on('swiperight', this.next.bind(this));

        $(document).on('keydown', this.arrows.bind(this));
    }

    next() {
        if (this.index < this.length -1) {
            this.index++;
        } else {
            this.index = 0;
        }
        this.getInfos(this.index);
    };

    prev() {
        if (this.index > 0) {
            this.index--;
        } else {
            this.index = this.length -1;
        }
        this.getInfos(this.index);
    };
    
    getLength() {
        $.getJSON('http://floz-workshop.fr/projects.php', (data) => {
            $.each(data, (i) => {
                this.length++;
            });
        });
    }

    getInfos(i) {
        $.getJSON('http://floz-workshop.fr/projects.php', (data) => {
            let infos = data[i];
            $('.image_project').html('<img class="img_project" src="/images/projects/' + infos.picture + '.png" alt="project">');
            $('.thumbnail1_project').html('<img class="img-fluid" src="/images/projects/' + infos.thumbnail1 + '.png" alt="project">');
            $('.thumbnail2_project').html('<img class="img-fluid" src="/images/projects/' + infos.thumbnail2 + '.png" alt="project">');
            $('.thumbnail3_project').html('<img class="img-fluid" src="/images/projects/' + infos.thumbnail3 + '.png" alt="project">');
            $('.title_project').text(infos.name).css('color', 'rgb(92, 173, 211)');
            $('.description_project').text(infos.description);
            $('.languages_project').text(infos.languages);
            $('.link_project').html('<a href="' + infos.link + '"target="_blank"> ' + infos.link + '</a>');
            if (infos.github_link != "N/A") {
                $('.github_link_project').html('<a href="' + infos.github_link + '"target="_blank"> ' + infos.github_link + '</a>');
            } else {
                $('.github_link_project').html(infos.github_link);
            }
        });
    }

    arrows(e) {
        switch(e.keyCode) {
            case 37: 
                this.prev();
            break;
            case 39: 
                this.next();
            break;
        }
    }

    view_thumbnails() {
            $('.thumbnails .thumb').on('click', function() {
                let attribut = $(this).find('img').attr('src');
                $('#large_image').css('display', 'inherit');
                $('#large_picture').html('<img src="' + attribut + '">');
                $('.informations_project').css('display', 'none');
                $('html, body').animate({scrollTop:$(".thumbnails").offset().top }, 1000);
            })
            $('#close_image').on('click', function() {
                $('#large_image').css('display', 'none');
                $('.informations_project').css('display', 'inherit');
            })
            $('#large_image').on('click', function() {
                $(this).css('display', 'none');
                $('.informations_project').css('display', 'inherit');
            });
    }
}

const slider = new Slider;