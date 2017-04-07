@extends('layouts.admin_page')
@section('title','Kiểm tra ảnh chế')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <table class="bordered highlight">
                    <thead>
                    <tr>
                        <th width="5%">id</th>
                        <th width="30%">Content</th>
                        <th width="30%">Tiêu đề</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($memes as $meme)
                    <tr class="{{$meme->check?'':'teal lighten-4'}}" >
                        <td >{{$meme->id}}</td>
                        <td><img class="responsive-img" src="{{$meme->image}}"></td>
                        <td>{{$meme->title}}</td>
                        <td>
                            @if($meme->check)
                                <a href="{{route('meme.uncheck',['id'=>$meme->id])}}" class="btn orange">chưa kiểm tra</a>
                            @else
                                <a href="{{route('meme.check',['id'=>$meme->id])}}" class="btn">đã kiểm tra</a>
                            @endif
                                <a href="{{route('meme.delete',['id'=>$meme->id])}}" class="btn red">xóa</a>
                        </td>
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
