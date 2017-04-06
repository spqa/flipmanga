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
            <form class="col s12" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input name="title" placeholder="tiêu đề ảnh" id="title" type="text" class="validate" required>
                        <label for="title">Tiêu đề</label>
                        <input name="encode-image" type="hidden" id="encode-image">
                    </div>
                    <div class="input-field col s12 m6 l6">

                        <input name="image-link" value="http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg" id="image" type="url"
                               class="validate" placeholder="link ảnh" required>
                        <label for="image">Ảnh</label>
                    </div>
                </div>


                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="progress hide">
                            <div class="indeterminate"></div>
                        </div>
                        <img crossOrigin="anonymous" class="responsive-img" id="preview-image"
                             src="http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg">
                    </div>
                    <div class="col s12 m6 l6">
                        <button class="btn btn-preview col s6" type="button"><i class="material-icons left">local_see</i>chỉnh sửa
                        </button>
                        <button class="btn green col s6" type="submit"><i class="material-icons left">save</i>Đăng ảnh
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="s12 col m6 l6">
                        <canvas id="editor"></canvas>
                    </div>
                    <div class="s12 col m6 l6 editor-control hide">
                        <button class="btn btn-add-text" type="button"><i class="material-icons left">format_color_text</i>thêm text
                        </button>

                            <input id="upper-text" type="text" placeholder="điền text">

                        <button class="btn btn-generate" type="button"><i class="material-icons left">create</i>lưu lại
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <div class="row " id="search-memeful">
            <div class="col s12">
                <iframe src="https://memefulsearch.github.io" frameborder="0"></iframe>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.3/fabric.min.js"></script>
    <script>
        $('#image').keyup(function (e) {
            console.log('haha');
            $('.process').removeClass('hide');
            if ($(this).val()) {
                $('#preview-image').attr('src', 'http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image%2F*&url='+$(this).val());
            }
        });

        $('#preview-image').on('error', function (e) {
            $('#preview-image').attr('src', '/404.png');
        }).on('load', function (e) {
            console.log('added');
            $('.process').addClass('hide');
        });
    </script>
    <script src="/js/meme_editor.js"></script>
@endsection