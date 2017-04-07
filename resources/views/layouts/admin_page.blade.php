@extends('layouts.admin_master')
@section('body')
    <nav>
        <div class="nav-wrapper grey darken-4">
            <a href="#" class="brand-logo">Kiểm tra ảnh chế</a>
            {{--<ul id="nav-mobile" class="right hide-on-med-and-down">--}}
                {{--<li><a href="sass.html">Sass</a></li>--}}
                {{--<li><a href="badges.html">Components</a></li>--}}
                {{--<li><a href="collapsible.html">JavaScript</a></li>--}}
            {{--</ul>--}}
        </div>
    </nav>

    @yield('content')
    @endsection