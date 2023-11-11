const allSkeleton = document.querySelectorAll('.skeleton')
window.addEventListener('load', function () {
    allSkeleton.forEach(item => {
        item.classList.remove('skeleton')
        $('.slick-slide').removeClass('skeleton')
    })
})

// const allSkeleton2 = document.querySelectorAll('.skeleton2')
// const popupClick = document.querySelector('#popup-click')
// popupClick.addEventListener('click', function () {
//     if (videoTrailer.load()) {
//         allSkeleton2.forEach(item => {
//             item.classList.remove('skeleton2')
//             $('.videoo').removeClass('skeleton2')
//         });
//     }

// })

$(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
        $('.navbar').addClass('swapnavbar');
    }
    else {
        $('.navbar').removeClass('swapnavbar');
    }
});



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

function randomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

const video = document.querySelector('.videoPlay');
const btnRefresh = document.querySelector('.button-refresh')
const btnMute = document.querySelector('.button-mute')

function toggleRefresh() {
    const method = video.paused ? 'play' : 'pause';
    video[method]();
}

function updatebtnPlay() {
    if (video.paused) {
        btnPlay = '<i class="bx bx-play"></i>';
        $('.left .title').css('font-size', '5.5vw');
        $('.left .title').css('transition', '1s');
        $('.left .title').css('transition-delay', '1s');
        $('.left .content').css('font-size', '1.2vw');
        $('.left .content').css('transition', '1s');
        $('.left .content').css('width', '100%');
        $('.left .content').css('transition-delay', '1s');

    } else {
        btnPlay = '<i class="bx bx-pause"></i>';
        $('.left .title').css('font-size', '3.2vw');
        $('.left .title').css('transition', '1s');
        $('.left .title').css('transition-delay', '5s');
        $('.left .content').css('font-size', '0vw');
        $('.left .content').css('transition', '1s');
        $('.left .content').css('width', '0%');
        $('.left .content').css('transition-delay', '5s');
        $('.poster').css('display', 'none');

    }
    // const btnPlay = video.paused ? '<i class="bx bx-play"></i>' : '<i class="bx bx-pause"></i>';
    btnRefresh.innerHTML = btnPlay;

}
$('.left .title').css('color', 'red');
$('.left .title').css('-webkit-text-stroke', '0.5px' + randomColor());

function toggleMute() {
    if (video.muted) {
        video.muted = false;
        btnMute.innerHTML = '<i class="bx bx-volume-full"></i>';

    } else {
        video.muted = true;
        btnMute.innerHTML = '<i class="bx bx-volume-mute"></i>';

    }
}
function checkVideo1() {
    btnPlay = '<i class="bx bx-play"></i>';
    $('.left .title').css('font-size', '5.5vw');
    $('.left .title').css('transition', '1s');
    $('.left .title').css('transition-delay', '5s');
    $('.left .content').css('transition-delay', '5s');
    $('.left .content').css('font-size', '1.2vw');
    $('.left .content').css('transition', '1s');
    $('.left .content').css('width', '100%');
    $('.poster').css('display', 'block');
}
function checkVideo2() {
    btnRefresh.innerHTML = '<i class="bx bx-pause"></i>';
    $('.left .title').css('font-size', '3.2vw');
    $('.left .title').css('transition', '1s');
    $('.left .title').css('transition-delay', '5s');
    $('.left .content').css('font-size', '0vw');
    $('.left .content').css('transition', '1s');
    $('.left .content').css('width', '0%');
    $('.left .content').css('transition-delay', '5s');
    $('.poster').css('display', 'none');
    video.autoplay = true;
    video.load();

}

video.addEventListener('loadstart', checkVideo1)
video.addEventListener('play', updatebtnPlay)
video.addEventListener('pause', updatebtnPlay)
video.addEventListener("ended", function () {
    $('.left .title').css('font-size', '5.5vw');
    $('.left .title').css('transition', '1s');
    $('.left .title').css('transition-delay', 'font-size', '1.2vw');
    $('.left .content').css('transition', '1s');
    $('.left .content').css('width', '100%');
    $('.left .content').css('transition-delay', '5s');
    $('.poster').css('display', 'block');
});

btnRefresh.addEventListener('click', toggleRefresh)
btnMute.addEventListener('click', toggleMute)
window.addEventListener('load', checkVideo2)

const videoTrailer = document.querySelector('#videoTrailer')
const infoMovie = document.querySelector('#infoMovie')
const popup = document.querySelector('.modal-content')
//xử lý khi popup đóng
document.addEventListener('click', function (event) {
    if (!popup.contains(event.target)) {
        if ($('#infoMovie').is(':visible')) {
            console.log('ngoai');
            videoTrailer.pause();
            video.play();
            updatebtnPlay();

            allSkeleton.forEach(item => {
                item.classList.remove('skeleton')
                $('.load').addClass('skeleton')
            });
        }
    }

});

// const close = document.querySelector('.close-popup')
// close.addEventListener('click', function () {
//     $('.popup').collapse('hide');
// });
// const infoMovie = document.querySelector('#infoMovie')
// infoMovie.addEventListener('click', function () {
//     if (infoMovie.css('display') === 'block') {
//         console.log('open');
//         video.pause();
//         updatebtnPlay();
//     } else {
//         console.log('close');

//     }
// })


// function miniView() {
//     $('.mini-view').css('font-size', '5.5vw');

// }
// miniView.addEventListener('load', checkVideo2)

video.load();


