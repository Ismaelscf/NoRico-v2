function selectSort() {
    let type = document.querySelector('#type').value;
    let lojas = document.querySelector('#store_id');
}

function countDocument(document){

    if(document.value.length >= 14){
        return $(document).mask('00.000.000/0000-00');
    } else {
        return $(document).mask('000.000.000-00');
    }
}

const multipleItemCarousel = document.querySelector('#carouselSorts');
if(window.matchMedia("(min-width:576px)").matches){
    const carousel = new bootstrap.Carousel(multipleItemCarousel, {
        interval: false
    });

    var carouselWidth = $('#carousel-inner-sort')[0].scrollWidth;
    var cardWidth = $('.carousel-item-sort').width();
    var scrollPosition = 0;

    $('#carousel-control-next-sort').on('click', function(){
        if(scrollPosition < (carouselWidth - (cardWidth * 4))){
            scrollPosition = scrollPosition + cardWidth;
            $('#carousel-inner-sort').animate({scrollLeft: scrollPosition}, 600);
        }
    });
    $('#carousel-control-prev-sort').on('click', function(){
        if(scrollPosition > 0){
            scrollPosition = scrollPosition - cardWidth;
            $('#carousel-inner-sort').animate({scrollLeft: scrollPosition}, 600);
        }
    });
} else {
    $(multipleItemCarousel).addClass('slide');
}


const multipleItemCarouselStore = document.querySelector('#carouselStore');
if(window.matchMedia("(min-width:576px)").matches){
    const carouselStore = new bootstrap.Carousel(multipleItemCarouselStore, {
        interval: false
    });

    var carouselWidth = $('#carousel-inner-store')[0].scrollWidth;
    var cardWidth = $('.carousel-item-store').width();
    var scrollPosition = 0;

    $('#carousel-control-next-store').on('click', function(){
        if(scrollPosition < (carouselWidth - (cardWidth * 4))){
            scrollPosition = scrollPosition + cardWidth;
            $('#carousel-inner-store').animate({scrollLeft: scrollPosition}, 600);
        }
    });
    $('#carousel-control-prev-store').on('click', function(){
        if(scrollPosition > 0){
            scrollPosition = scrollPosition - cardWidth;
            $('#carousel-inner-store').animate({scrollLeft: scrollPosition}, 600);
        }
    });
} else {
    $(multipleItemCarouselStore).addClass('slide');
}