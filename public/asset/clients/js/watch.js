const player = document.querySelector('.player');
const back = player.querySelector('.back')
const playerControl = player.querySelector('.player__controls');
const video = player.querySelector('.viewer');
const progress = player.querySelector('.progresss');
const progressBar = player.querySelector('.progresss__filled');
const toggle = player.querySelector('.pause');
const btnRewind = player.querySelector('.rewind');
const btnfast = player.querySelector('.fast');
const time = player.querySelector('.time');
const btnVolume = player.querySelector('.volume-on');
const btnFull = player.querySelector('.full');
const skipButtons = player.querySelectorAll('[data-skip]');
const ranges = player.querySelectorAll('.player__slider');

back.addEventListener('click', function () {
    window.history.back();
})

function togglePlay() {
    const method = video.paused ? 'play' : 'pause';
    video[method]();
}

function updateBtn() {
    if (video.paused) {
        btnPlay = '<i class="bi bi-play"></i>';
    } else {
        btnPlay = '<i class="bi bi-pause"></i>';
    }
    toggle.innerHTML = btnPlay;
}

function secondsToHMS(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds % 3600) / 60);
    var remainingSeconds = Math.floor(seconds % 60);

    var hoursStr = (hours < 10) ? "0" + hours : hours.toString();
    var minutesStr = (minutes < 10) ? "0" + minutes : minutes.toString();
    var secondsStr = (remainingSeconds < 10) ? "0" + remainingSeconds : remainingSeconds.toString();

    var formattedTime = hoursStr + ":" + minutesStr + ":" + secondsStr;
    if (formattedTime === 'NaN:NaN:NaN') {
        formattedTime = "00:00:00"
    }
    return formattedTime;
}

function secondsToHMSCurrent(seconds) {
    var hours = Math.floor(seconds / 3600);
    var minutes = Math.floor((seconds % 3600) / 60);
    var remainingSeconds = Math.floor(seconds % 60);

    var hoursStr = (hours < 10) ? "0" + hours : hours.toString();
    var minutesStr = (minutes < 10) ? "0" + minutes : minutes.toString();
    var secondsStr = (remainingSeconds < 10) ? "0" + remainingSeconds : remainingSeconds.toString();

    var formattedTime = hoursStr + ":" + minutesStr + ":" + secondsStr;
    return formattedTime;
}

function skip() {
    video.currentTime += parseFloat(this.dataset.skip);
    if (this.dataset.skip < 0) {
        $('.rewind').css('transform', 'rotate(-360deg)');
        $('.rewind').css('transition', '1s')

    } else {
        $('.fast').css('transform', 'rotate(360deg)');
        $('.fast').css('transition', '1s')
    }
}

function handleRangeUpdate() {
    video[this.name] = this.value;
}

function handleProgress() {
    const percent = (video.currentTime / video.duration) * 100;
    progressBar.style.width = `${percent}%`;
    const totalTime = secondsToHMS(video.duration);
    const currentTime = secondsToHMSCurrent(video.currentTime);
    time.innerText = currentTime + ' / ' + totalTime;
}

function seek(e) {
    const seekTime = (e.offsetX / progress.offsetWidth) * video.duration;
    video.currentTime = seekTime * video.duration;
}

video.addEventListener('click', togglePlay)
video.addEventListener('pause', updateBtn)
video.addEventListener('play', updateBtn)
video.addEventListener('timeupdate', handleProgress);

toggle.addEventListener('click', togglePlay);
skipButtons.forEach(button => button.addEventListener('click', skip))

ranges.forEach(ranges => ranges.addEventListener('change', handleRangeUpdate));
ranges.forEach(ranges => ranges.addEventListener('mousemove', handleRangeUpdate));

let mousedown = false;
progress.addEventListener('click', seek);
progress.addEventListener('mousemove', (e) => mousedown && seek(e));
progress.addEventListener('mousedown', () => mousedown = true);
progress.addEventListener('mouseup', () => mousedown = false);


$('.volume-on').hover(function () {
    $('.player__slider').css('width', '200px')
    $('.player__slider').css('opacity', '1')
}, function () {
    $('.player__slider').css('width', '0px')
    $('.player__slider').css('opacity', '0')

});

$(document).ready(function () {
    $("#fullscreen-btn").click(function () {
        // Set the dimensions of the element to match the viewport
        console.log('sđa');
        $("#element-to-fullscreen").css({
            "width": $(window).width() + "px",
            "height": $(window).height() + "px"
        });
    });
});



$("#fullscreen-btn").click(function () {
    var elem = document.documentElement;
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
        /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        /* IE/Edge */
        elem.msRequestFullscreen();
    }
    $("#fullscreen-btn").attr("id", "exit-fullscreen-btn");
});


$("#exit-fullscreen-btn").click(function () {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        /* Firefox */
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        /* Chrome, Safari & Opera */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        /* IE/Edge */
        document.msExitFullscreen();
    }
    $("#exit-fullscreen-btn").attr("id", "fullscreen-btn");
});