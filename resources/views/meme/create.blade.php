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
                        <input placeholder="tiêu đề ảnh" id="title" type="text" class="validate">
                        <label for="title">Tiêu đề</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <input id="image" type="url" class="validate" placeholder="link ảnh">
                        <label for="image">Ảnh</label>
                    </div>
                </div>


                <div class="row">
                    <div class="col s12 m6 l6">
                        <img class="responsive-img" id="preview-image" src="http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg">
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
                        <button class="btn btn-preview col s6" type="submit"><i class="material-icons left">local_see</i>Xem trước</button>
                        <button class="btn green col s6" type="submit"><i class="material-icons left">save</i>Đăng ảnh </button>
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
    <script>
        $('#image').keyup(function (e) {
            if($(this).val()){
                $('#preview-image').attr('src',$(this).val());
            }
        });

        $('#preview-image').on('error',function (e) {
            $('#preview-image').attr('src','/404.png');
        });
        $('.btn-preview').click(function (e) {
            e.preventDefault();
            $.ajax({
                url:'/api/meme/preview',
                method:'POST',
                data:{
                    image:$('#preview-image').attr('src'),
                    up:$('#upper-text').val(),
                    down:$('#bottom-text').val()
                },
                success:function (data) {
                    $('#preview-image').attr('src','/storage/images/temp/'+data+'.jpg');
                }

            });

        });
    </script>
@endsection