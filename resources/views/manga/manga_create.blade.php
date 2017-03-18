@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1>Up truyện mới</h1>
            </div>
            <div class="col s12">
                <form action="{{route('manga.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="input-field col s6">
                        <input placeholder="tên truyện" name="manga_name" id="name" type="text" class="validate">
                        <label for="name">Tên truyện</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="chap" name="chap_name" type="text" class="validate">
                        <label for="name">tên chap</label>
                    </div>
                    <div class="image-form">
                        <div class="input-field col s6 image-input">
                            <input id="last_name" name="image[]" type="url" class="validate">
                            <label for="last_name">ảnh</label>
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn" id="add-image">Thêm ảnh</button>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        $('#add-image').click(function (e) {
            e.preventDefault();
            $('.image-input').first().clone().appendTo('.image-form');
        });
    </script>
@endsection