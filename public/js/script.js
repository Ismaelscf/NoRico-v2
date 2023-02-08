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
    const carouselsort = new bootstrap.Carousel(multipleItemCarousel, {
        interval: false
    });

    var carouselWidthSort = $('#carousel-inner-sort')[0].scrollWidth;
    var cardWidthSort = $('.carousel-item-sort').width();
    var scrollPositionSort = 0;

    $('#carousel-control-next-sort').on('click', function(){
        if(scrollPositionSort < (carouselWidthSort - (cardWidthSort * 4))){
            scrollPositionSort = scrollPositionSort + cardWidthSort;
            $('#carousel-inner-sort').animate({scrollLeft: scrollPositionSort}, 600);
        }
    });
    $('#carousel-control-prev-sort').on('click', function(){
        if(scrollPositionSort > 0){
            scrollPositionSort = scrollPositionSort - cardWidthSort;
            $('#carousel-inner-sort').animate({scrollLeft: scrollPositionSort}, 600);
        }
    });
} else {
    $(multipleItemCarousel).addClass('slide');
}


const multipleItemCarouselStore = document.querySelector('#carouselStore');
if(window.matchMedia("(min-width:576px)").matches){
    const carouselstore = new bootstrap.Carousel(multipleItemCarouselStore, {
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


function showPass(){
    let pass = document.querySelector('#password').type;
    console.log(pass)

    if(pass == 'text'){
        document.querySelector('#password').type = 'password'
    } else {
        document.querySelector('#password').type = 'text'
    }

    console.log(pass);
}