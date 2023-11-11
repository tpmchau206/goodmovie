$(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
        $('.navbar').addClass('swapnavbar');
    }
    else {
        $('.navbar').removeClass('swapnavbar');
    }
});

const allSkeleton = document.querySelectorAll('.skeleton')
window.addEventListener('load', function () {
    allSkeleton.forEach(item => {
        item.classList.remove('skeleton')
        $('.slick-slide').removeClass('skeleton')
    })
})

$(document).ready(function () {
    $(".navbar-togglerr").click(function () {
        $(".navbar-collapse").collapse('toggle');
    });
});

const cenbutton = document.querySelector('.cenbutton');
const search = document.querySelector('.search');
cenbutton.onclick = function () {
    search.classList.toggle('active')
    $('.cenbutton').css('display', 'none')
    $('.bx-search').css('color', '#141414')
}