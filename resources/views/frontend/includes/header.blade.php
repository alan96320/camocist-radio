@php
$logo = App\Models\LogoSetting::where('key','header_logo')->first();
@endphp
<header class="section page-header bg-pattern bg-gray-800" style="min-height: 172.517px;">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar" data-layout="rd-navbar-fixed pb-xl-0 pb-sm-5" data-sm-layout="rd-navbar-fixed"
            data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-xl-layout="rd-navbar-static"
            data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static"
            data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="200px" data-xl-stick-up-offset="120px"
            data-xxl-stick-up-offset="120px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <div class="rd-navbar-panel pt-md-3 pt-xl-0">
                        <button class="rd-navbar-toggle"
                            data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                            <span></span>
                        </button>
                        <div class="rd-navbar-brand">

                            @if($logo)
                            <a class="brand" href="{{ url('/') }}">
                                <img src="{{ asset('upload/Logo_Images/289_56_'.$logo->logo_image) }}" alt=""
                                    width="333" height="72" />
                            </a>
                            @else
                            <a class="brand" href="{{ url('/') }}">
                                <img src="{{asset('img/frontend/Logo.png')}}" alt="" width="333" height="72" />
                            </a>
                            @endif

                        </div>
                    </div>
                    <div class="rd-navbar-main-element">
                        <div class="rd-navbar-nav-wrap">
                            <ul class="rd-navbar-nav">
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="{{ url('883jia') }}" style="text-decoration:none;">
                                        88.3JIA
                                    </a>
                                </li>
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="{{ url('power98') }}"
                                        style="text-decoration:none;">POWER 98
                                    </a>
                                </li>
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="{{ url('music_drama') }}"
                                        style="text-decoration:none;">MUSIC & DRAMA COMPANY
                                    </a>
                                </li>
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="https://www.sodrama.sg/#aboutsde" target="_blank"
                                        style="text-decoration:none;">ABOUT US
                                    </a>
                                </li>
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="#">
                                        <img src="{{ asset('img/frontend/header_img.png') }}">
                                    </a>
                                    <ul class="rd-menu rd-navbar-dropdown">
                                        <li class="rd-dropdown-item">
                                            <span>LISTEN LIVE</span>
                                        </li>
                                        <li v-for="(x, index) in radios" :key="index" class="rd-dropdown-item">
                                            <a class="rd-dropdown-link" :id="`radio${index+1}`"
                                                @click="playRadio(x.uuid)" href="#">@{{ x.display_name }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div style="width: 100%; text-align: center;">
        <div class="box-live-wrap d-lg-flex d-none">
            <div class="box-live-col-2 box-live-content d-lg-flex d-md-none d-none">
                <div class="box-live-onair bg-gray-600 py-0">
                    <div class="h-100 align-items-center justify-content-center justify-content-sm-start">
                        <div class="h-100">
                            <img class="" :src="banner_image" alt="" style="height: 112px;max-width: 344px" />
                        </div>
                    </div>
                </div>
                <div class="button-listen-wrap bg-gray-700">
                    <a class="button-listen-main" v-if="header_audio == 0" v-on:click="playRadio()">Listen Live
                        <span style="background-color:#ffffff;">
                            <img src="/img/frontend/Mini-Player-Button-Listen.png" alt=""
                                class=" img-responsive image_favicon" />
                        </span>
                    </a>
                    <a class="button-listen-main" v-else-if="header_audio != 0" v-on:click="pause()">Listen
                        Live
                        <span style="background-color:#ffffff;">
                            <img src="/img/frontend/Mini-Player-Button-Stop.png" alt=""
                                class="img-responsive image_favicon_stop" />
                        </span>
                    </a>
                </div>
            </div>

            <div class="box-live-col-1 bg-gray-500">
                <div class="row">
                    <div class="col-3" style="padding-right: 0px;">
                        <img :src="cover_art" height="100px" width="100px" class="cover_art">
                    </div>
                    <div class="col-9" style="padding-left: 3px;">
                        <span class="big pull-left" style="font-size:15px">
                            NOW PLAYING ON
                            <a style="color:rgb(155, 164, 177);">@{{ player_name | remove_underscore }}</a>
                        </span><br>

                        <span class="big text-white pull-left" style="font-size:18px; text-align:left;">
                            <span style="font-weight:bold" id="artist_name">@{{ artist_name }} - </span>
                            <span class="" id="song_title">@{{ song_title  }}</span>
                            <span class="" id="time_start" style="display:none">@{{ time_start }}</span>
                        </span>

                        <div class="col-12 lyric-section" style="margin-top: 5px">
                            <button type="button" class="btn lyric lyricType" :class="{ 'active': lyric_type == 'lyric' && lyric.jsons }" id="lyrics" data-type="lyric"
                                v-on:click="showLyric" :disabled="!lyric.jsons">LYRICS
                            </button>
                            <button type="button" class="btn lyric syncType" :class="{ 'active': lyric_type == 'sync' && lyric.jsons }" id="lyrics" data-type="sync"
                                v-on:click="showLyric" :disabled="!lyric.jsons">
                                LYRICS SYNC
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="show-box-live-wrap d-lg-none d-block bg-white">
        <div class="equalizer">
            <span class="column" id="volume-1"></span>
            <span class="column" id="volume-2"></span>
            <span class="column" id="volume-3"></span>
            <span class="column" id="volume-4"></span>
            <span class="column" id="volume-5"></span>
            <span class="column" id="volume-6"></span>
            <span class="column" id="volume-7"></span>
        </div>
    </div>
    <div id="mobile-height" class="box-live-wrap mobile-tablet d-lg-none d-flex"
        :style="[show_lyric ? { 'height': '550px' } : {'height': '80px'}]">
        <div class="box-live-col-1">
            <div class="row">
                <div class="col-3" style="padding-right: 0px;">
                    <img :src="cover_art" class="live-image">
                </div>

                <div class="col-9" style="padding-left: 3px;">
                    <span class="big pull-left player-name" style="font-size:14px; height: 16px;">NOW PLAYING ON
                        <a style="color: #9ba4b1;">@{{ player_name | remove_underscore }}</a>
                    </span>
                    <div class="spacer"></div>

                    <span class="big pull-left artist-song-name" style="color:white;font-size: 14px;height: 20px;">
                        <span style="font-weight:bold;color:white" id="artist_name">@{{ artist_name }} - </span>
                        <span class="" id="time_start" style="display:none">@{{ time_start }}</span>
                        <span class="" id="song_title" style="color:#FFF">@{{ song_title  }}</span>
                    </span>

                    <div class="col-12 lyric-section" id="lyric_section">
                        <span class="inline-block">
                            <button type="button" class="btn lyric lyricType" id="lyricsMobile" data-type="lyric"
                                v-on:click="showLyric" :disabled="!lyric.jsons" :class="{ 'active': lyric_type == 'lyric' && lyric.jsons }">
                                LYRICS
                            </button>
                            <button type="button" class="btn lyric syncType" id="lyricsMobile" data-type="sync"
                                v-on:click="showLyric" :disabled="!lyric.jsons" :class="{ 'active': lyric_type == 'sync' && lyric.jsons }">
                                -LYRICS SYNC
                            </button>
                        </span>
                    </div>
                    <div class="button-listen-wrap d-flex align-self-center">
                        <a onclick="playeqplay()" v-if="header_audio == 0" v-on:click="playRadio()">
                            <img src="{{asset('images/player-play.png')}}" alt="" />
                        </a>
                        <a onclick="playeqpause()" v-else-if="header_audio != 0" v-on:click="pause()">
                            <img src="{{asset('images/player-pause.png')}}" alt="" />
                        </a>
                    </div>
                </div>
            </div>

            <div style="width: 100%; text-align: center;" id="lyric-div-mobile"
                :style="[show_lyric && lyric.jsons ? { 'opacity': '1' } : {'opacity': '0'}]">
                <div style="text-align-last: center;" id="box-live-wrap-mobile">
                    <div class="box-live-col-1 bg-gray-500  lyric-div" style="background:#000000eb !important"
                        id="box-live-mobile-child">
                        <div class="row">
                            <div class="col-12" style="padding-left: 3px;">
                                <div>
                                    <mq-layout mq="sm">
                                        {{-- <div id="full-lyrics-mobile"></div> --}}
                                        <div>LYRICS</div>
                                        <div class="hr-seprator">&nbsp;</div>

                                        <div v-if="lyricLoading">
                                            <div class="lds-ellipsis">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                        <div v-else-if="lyric.jsons">
                                            <div id="lyrics-load" class="scrollbar">
                                                <div class="display-lyrics">
                                                    <lyric-component :jsons="lyric.jsons"
                                                        :time="algorithm.time_spend_in_second" :type="lyric_type">
                                                    </lyric-component>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div id="lyrics-load" class="scrollbar">
                                                <div class="display-lyrics">NO LYRICS FOUND</div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="hr-seprator margin-top-270">&nbsp;</div>
                                            <span class="no-decoration" style="color:white; cursor: pointer;"
                                                @click="closeLyric">
                                                CLOSE
                                                <i class="fal fa-angle-up"></i>
                                            </span>
                                        </div>
                                    </mq-layout>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Lyric Div -->
    <div style="width: 100%; text-align: center;" id="lyric-div" class="lyricsbox"
        :style="[show_lyric && lyric.jsons ? { 'opacity': '1' } : {'opacity': '0'}]">
        <div class="box-live-wrap d-lg-flex d-none text-center" style="text-align-last: center;" id="box-live-wrap">
            <div class="box-live-col-1 bg-gray-500  lyric-div" style="background:#000000eb !important"
                id="box-live-child">
                <div class="row">
                    <div class="col-12" style="padding-left: 3px;">
                        <div>
                            <mq-layout mq="md+">
                                {{-- <div id="full-lyrics"></div> --}}
                                <div>LYRICS</div>
                                <div class="hr-seprator">&nbsp;</div>
                                
                                <div v-if="lyricLoading">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                <div v-else-if="lyric.jsons">
                                    <div id="lyrics-load" class="scrollbar">
                                        <div class="display-lyrics">
                                            <lyric-component :jsons="lyric.jsons" :time="algorithm.time_spend_in_second"
                                                :type="lyric_type" :now="algorithm.now" :start="algorithm.startTime"></lyric-component>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <div id="lyrics-load" class="scrollbar">
                                        <div class="display-lyrics">NO LYRICS FOUND</div>
                                    </div>
                                </div>

                                <div>
                                    <div class="hr-seprator margin-top-270">&nbsp;</div>
                                    <span class="no-decoration" style="color:white; cursor: pointer;"
                                        @click="closeLyric">
                                        CLOSE
                                        <i class="fal fa-angle-up"></i>
                                    </span>
                                </div>
                            </mq-layout>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>