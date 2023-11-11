<script>
    $(document).ready(function() {
        $(document).on('click', '.popup-click-main', function() {
            var movId = this.getAttribute("data-custom-attribute");
            event.preventDefault();
            // console.log(movId);
            $('#infoMovie').modal('show');
            $.ajax({
                type: 'GET',
                url: '/movie/' + movId,

                success: function(response) {

                    $('#nameMovie').text(response.movie[0].name);
                    $("#videoTrailer source").attr("src", "{!! asset('asset/clients/video/" + response.movie[0].trailer + "') !!}");
                    $("#videoTrailer").attr("poster", "{!! asset('asset/clients/images/"+ response.movie[0].poster +"') !!}");
                    $('#button-play').attr("href", "/watch/movie/" + movId);
                    $('#minutes-movie').text(response.movie[0].length);
                    $('#content-movie').text(response.movie[0].content);
                    $('#performer-movie').text(response.movie[0].performer);
                    $('#nation-movie').text(response.movie[0].nation);
                    $('#category-movie').text(response.movie[0].category_movie);
                    $("#videoTrailer")[0].load();
                    video.pause();
                    videoTrailer.play();
                    updatebtnPlay();
                    videoTrailer.addEventListener("loadedmetadata", function() {
                        // Kiểm tra nếu video đã tải xong
                        if (!videoTrailer.paused && videoTrailer.duration > 0) {
                            allSkeleton.forEach(item => {
                                item.classList.remove('skeleton')
                                $('.load').removeClass('skeleton')
                            });
                        } else {
                            console.log("Video đang tải...");
                        }
                    });
                }
            });
        });
    });
    $(document).ready(function() {
        $(document).on('click', '.popup-click', function() {
            var movId = this.getAttribute("data-custom-attribute");
            event.preventDefault();
            // console.log(movId);
            $('#infoMovie').modal('show');

            $.ajax({
                type: 'GET',
                url: '/movie/' + movId,

                success: function(response) {
                    // console.log(response);
                    $('#nameMovie').text(response.movie[0].name);
                    $("#videoTrailer source").attr("src", "{!! asset('asset/clients/video/" + response.movie[0].trailer + "') !!}");
                    $("#videoTrailer").attr("poster", "{!! asset('asset/clients/images/"+ response.movie[0].poster +"') !!}");
                    $('#button-play').attr("href", "/watch/movie/" + movId);
                    $('#minutes-movie').text(response.movie[0].length);
                    $('#content-movie').text(response.movie[0].content);
                    $('#performer-movie').text(response.movie[0].performer);
                    $('#nation-movie').text(response.movie[0].nation);
                    $('#category-movie').text(response.movie[0].category_movie);
                    $("#videoTrailer")[0].load();
                    video.pause();
                    videoTrailer.play();
                    updatebtnPlay();
                    // if (videoTrailer.is) {
                    //   allSkeleton2.forEach(item => {
                    //       item.classList.remove('skeleton2')
                    //       $('.videoo').removeClass('skeleton2')
                    //   });
                    // }   
                    videoTrailer.addEventListener("loadedmetadata", function() {
                        // Kiểm tra nếu video đã tải xong
                        if (!videoTrailer.paused && videoTrailer.duration > 0) {
                            allSkeleton.forEach(item => {
                                item.classList.remove('skeleton')
                                $('.load').removeClass('skeleton')
                            });
                        } else {
                            console.log("Video đang tải...");
                        }
                    });
                }
            });
        });
    });
</script>
