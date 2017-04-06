@extends('layouts.admin_page')
@section('title','Kiểm tra ảnh chế')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <table>
                    <thead>
                    <tr>
                        <th width="30%">Content</th>
                        <th width="30%">Tiêu đề</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($memes as $meme)
                    <tr>
                        <td><img src="{{$meme->image}}"></td>
                        <td>{{$meme->title}}</td>
                        <td><a href="{{route('meme.check',['id'=>$meme->id])}}" class="btn">Checked</a></td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col s12 center">
                {!! $memes->links() !!}
            </div>
        </div>
    </div>



    @endsection
