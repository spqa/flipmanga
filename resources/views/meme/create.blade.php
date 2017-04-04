@extends('layouts.master')
@section('content')
    <div class="container">
        <nav class="white z-depth-0 nav-breadcrumb">
            <div class="nav-wrapper ">
                <div class="col s12 scroll-breadcrumb">
                    <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>
                    <a href="{{route('meme.index')}}" class="breadcrumb grey-text"> Ảnh chế | Meme </a>
                    <a href="{{route('meme.create')}}" class="breadcrumb grey-text active">Tạo ảnh chế | Meme</a>
                </div>
            </div>
        </nav>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input placeholder="tiêu đề ảnh" id="title" type="text" class="validate" required>
                        <label for="title">Tiêu đề</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <input value="http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg" id="image" type="url"
                               class="validate" placeholder="link ảnh" required>
                        <label for="image">Ảnh</label>
                    </div>
                </div>


                <div class="row">
                    <div class="col s12 m6 l6">
                        <img class="responsive-img" id="preview-image"
                             src="http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg">
                        <canvas id="editor"></canvas>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="input-field">
                            <input id="upper-text" type="text">
                            <label for="upper-text">text phía trên</label>
                        </div>
                        <div class="input-field">
                            <input id="bottom-text" type="text">
                            <label for="bottom-text">text phía dưới</label>
                        </div>
                        <button class="btn btn-preview col s6"><i
                                    class="material-icons left">local_see</i>chỉnh sửa
                        </button>
                        <button class="btn btn-add-text col s6 hide"><i
                                    class="material-icons left">format_color_text</i>thêm text
                        </button>
                        <button class="btn btn-generate col s6 hide"><i
                                    class="material-icons left">create</i>xem trước
                        </button>
                        <button class="btn green col s6" type="submit"><i class="material-icons left">save</i>Đăng ảnh
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <div class="row search-memeful">
            <div class="col s12">
                <iframe src="https://memefulsearch.github.io" frameborder="0"></iframe>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script src="//cdn.jsdelivr.net/g/masonry@4.1.1,fabric.js@1.7.9(fabric.min.js)"></script>
    <script>
        $('#image').keyup(function (e) {

            if ($(this).val()) {
                $('#preview-image').attr('src', $(this).val());
            }
        });

        $('#preview-image').on('error', function (e) {
            $('#preview-image').attr('src', '/404.png');
        });
    </script>
    <script src="/js/meme_editor.js"></script>
@endsection