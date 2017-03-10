@extends('layouts.master_v2')
@section('content')
    <div class="container-fluid grey lighten-4">
        <section class="container">
            <div class="row">
            <div class="col s12 m12 l12 hide-on-small-only">

                <div class="slide-container slide-1">
                    @each('manga.partial._manga_slider', $latestHotUpdate, 'item')
                </div><!-- slide-container -->
            </div><!-- col-s12 -->
            </div>
        </section>
    </div>
    @endsection