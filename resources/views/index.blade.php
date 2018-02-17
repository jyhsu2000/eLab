@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <style>
        .jumbotron {
            border-radius: 40px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            color: inherit;
            padding-left: 60px;
            padding-right: 60px;
        }

        .lab-name {
            text-align: center;
            text-shadow: 0 0 10px white, 0 0 20px white, 0 0 30px white, 0 0 40px white, 0 0 70px white, 0 0 80px white, 0 0 100px white;
        }

        #app {
            padding: 56px 0 0;
        }

        .flash {
            -webkit-animation-duration: 2s;
            -webkit-animation-delay: 1s;
            -webkit-animation-iteration-count: infinite;
        }

        .text-border {
            text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -2px white;
        }

        .profile-card {
            min-height: 160px;
        }

        #section-title {
            height: 100vh; /* 避免loading時頁面閃爍 */
            background: url("https://i.imgur.com/GjscCgG.jpg") no-repeat fixed center;
        }

        #section-intro {
            background: url("https://i.imgur.com/ZOcLM7h.jpg") no-repeat fixed center;
        }

        #section-teacher {
            background: url("https://i.imgur.com/2OmYzOU.jpg") no-repeat fixed center;
        }

        #section-member {
            background: url("https://i.imgur.com/EhWls2N.jpg") no-repeat fixed center;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.6/jquery.fullpage.min.css">
@endsection
@section('container-class', 'container-fluid')
@section('content')
    <div id="fullpage">
        <div class="section" id="section-title">
            <div class="d-flex flex-column" style="min-height: 80%">
                <div class="my-auto jumbotron align-self-center">
                    <h1 class="display-1 lab-name">{{ Setting::get('lab_name', config('app.name')) }}</h1>
                    <h1 class="display-2 lab-name">{{ Setting::get('lab_full_name', config('app.cht_name')) }}</h1>
                </div>
                <div class="mt-auto animated flash align-self-center text-center">
                    <a href="javascript:void(0)" style="text-decoration: none; color: white"
                       onclick="$.fn.fullpage.moveSectionDown();">
                        <h3>START</h3>
                        <i class="fa fa-angle-double-down fa-5x"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="section" id="section-intro">
            <div class="d-flex flex-column" style="min-height: 80%">
                <h1 class="display-3 align-self-center text-border">實驗室簡介</h1>
                <div class="container mt-2">
                    <div class="jumbotron" style="min-height: 40vh;">
                        實驗室簡介
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="section-teacher">
            <div class="d-flex flex-column" style="min-height: 80%">
                <h1 class="display-3 align-self-center text-border">指導教授</h1>
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-4">
                            <div
                                style="height: 100%; background: url('https://i.imgur.com/ijlqQ2a.png') no-repeat center center / contain">
                            </div>
                        </div>
                        <div class="jumbotron col" style="height: 40vh;">
                            指導教授
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="section-member">
            <div class="d-flex flex-column" style="min-height: 80%">
                <h1 class="display-3 align-self-center text-border">實驗室成員</h1>
                <div class="container-fluid mt-2" style="padding-bottom: 60px">
                    <div class="main-carousel">
                        @foreach($members as $member)
                            <div class="carousel-cell" style="width: 300px; height: 500px">
                                <div class="card m-1 profile-card" style="height: 100%">
                                    <div class="card-block text-center">
                                        @if($member->photoUrl)
                                            <div class="img-thumbnail d-inline-flex justify-content-center"
                                                 style="height: 280px; width: 280px; background: url('{{ $member->photoUrl }}') no-repeat center center / contain">
                                            </div>
                                        @else
                                            <div class="img-thumbnail d-inline-flex justify-content-center"
                                                 style="height: 280px; width: 280px; background-image: repeating-linear-gradient(-45deg, #dddddd 0px, #dddddd 25px, transparent 25px, transparent 50px, #dddddd 50px);">
                                                <div class="align-self-center">無相片</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-block text-center">
                                        <h4 class="card-title">
                                            <a href="{{ route('user-profile.show', $member) }}">{{ $member->name }}</a>
                                        </h4>
                                        @if($member->nickname)
                                            <h4 class="card-title">
                                                （{{ $member->nickname }}）
                                            </h4>
                                        @endif
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{--{!! nl2br(str_limit(e($member->info), 100, '...')) !!}--}}
                                                {{ str_limit($member->info, 100, '...') }}
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $member->type }}
                                                @if($member->in_year || $member->graduate_year)
                                                    （{{ $member->in_year }} ～ {{ $member->graduate_year }}）
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.6/vendors/scrolloverflow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.6/jquery.fullpage.min.js"></script>
    <script>
        $(function () {
            $('.main-carousel').flickity({
                // options
                cellAlign: 'center',
                contain: true,
                // wrapAround: true,
                autoPlay: true
            });
            $('#fullpage').fullpage({
                scrollBar: true,
                scrollOverflow: true
            });
        })
    </script>
@endsection
