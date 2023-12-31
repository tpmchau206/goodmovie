<!-- Modal -->
<div class="modal fade" id="infoMovie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-2 border-bottom-0">
                <h2 class="load skeleton" id="nameMovie"></h2>
                <button type="button" class="close bg-transparent text-light fs-5 border-0" data-dismiss="modal"
                    aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="load skeleton">
                    <video id="videoTrailer" autoplay controls>
                        <source src="" type="video/mp4">
                        Không có dữ liệu!!!
                    </video>

                </div>
                <div class="d-flex align-items-center">
                    <a href="" type="" id="button-play"
                        class="button-play d-flex align-items-center btn btn-light">
                        <i class='bx bx-play'></i>
                        Phát
                    </a>
                    <div class="fw-bold load skeleton"><i class="bi bi-clock"></i> <i id="minutes-movie"></i> phút</div>
                </div>
                <div class="grid-container">
                    <div class="grid-item">Nội dung</div>
                    <div class="grid-item load skeleton" id="content-movie"></div>
                    <div class="grid-item">Diễn viên</div>
                    <div class="grid-item load skeleton" id="performer-movie"></div>
                    <div class="grid-item">Quốc gia</div>
                    <div class="grid-item load skeleton" id="nation-movie"></div>
                    <div class="grid-item">Thể loại</div>
                    <div class="grid-item load skeleton" id="category-movie"></div>
                </div>
            </div>
        </div>
    </div>
</div>
