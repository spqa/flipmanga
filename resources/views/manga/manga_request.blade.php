@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1>Yêu cầu truyện</h1>
                <p class="grey-text">Các bạn có thể tự up truyện tại <a href="{{route('manga.create')}}">Đăng truyện</a></p>
                @if(session('success'))
                    <p class="green-text">Chúng tôi đã nhận được yêu cầu truyện của bạn <i class="material-icons">done</i></p>
                @endif
            </div>
            <div class="col s12">
                <form action="{{route('request.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="input-field col s12">
                        <input placeholder="tên truyện" name="manga_name" id="name" type="text" class="validate" required>
                        <label for="name">Tên truyện</label>
                    </div>

                        <div class="input-field col s12">
                            <textarea id="last_name" name="description" class="materialize-textarea"></textarea>
                            <label for="last_name">Chú thích</label>
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

@endsection