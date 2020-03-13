export default class Slider {

    constructor() {
        this.index = 0;
        this.getInfos(this.index);
        this.getLength();
        this.length = 0;
        this.view_thumbnails();
        this.effect;
    }

    /** @description switch to next project or return to the first
    */
    next() {
        if (this.index < this.length -1) {
            this.index++;
        } else {
            this.index = 0;
        }
        this.getInfos(this.index);
    };

    /** @description switch to previous project or return to the last
    */
    prev() {
        if (this.index > 0) {
            this.index--;
        } else {
            this.index = this.length -1;
        }
        this.getInfos(this.index);
    };

    /** @description get the total project number
    */
    getLength() {
        $.getJSON('http://floz-workshop.fr/projects.php', (data) => {
            $.each(data, (i) => {
                this.length++;
            });
        });
    }

    /** @description collect informations to the API
    */
    getInfos(i) {
        $.getJSON('http://floz-workshop.fr/projects.php', (data) => {
            let infos = data[i];
            $('.image_project').html('<img class="opacity img_project" src="/images/projects/' + infos.picture + '.png" alt="project">');
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

    /** @description switch project with keyboard arrows
    */
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

    /** @description show or hide thumbnails project
    */
    view_thumbnails() {
        $('.thumbnails .thumb').on('click', function() {
            let attribut = $(this).find('img').attr('src');
            $('#large_image').css('display', 'inherit');
            $('#large_picture').html('<img src="' + attribut + '">');
            $('.informations_project').css('display', 'none');
            $('html, body').animate({scrollTop:$(".thumbnails").offset().top - 130}, 1000);
        })
        $('#close_image, #large_image').on('click', function() {
            $('#large_image').css('display', 'none');
            $('.informations_project').css('display', 'inherit');
        })
    }
}

