@extends('frontend.layouts.front')

@section('title', 'Camokakis Music Stations' . ' | ' . __('navs.general.home'))

@section('content')
<div class="main_section">
    <div class="desktop-content d-none d-lg-block">
        <div class="row">
            <div class="col-sm-8">
                @if(count($filters) > 0)
                <div class="filter-content form-control">
                    @if(in_array("LATEST", $filters))
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            LATEST
                        </button>
                        <div class="dropdown-menu" data-device="desktop" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item post-sortable" data-sort="DESC" type="button">LATEST</button>
                            <button class="dropdown-item post-sortable" data-sort="ASC" type="button">OLDEST</button>
                        </div>
                    </div>
                    @endif
                    @if(in_array("CATEGORY", $filters))
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuCategory"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORY
                        </button>
                        <div class="dropdown-menu" data-device="desktop" aria-labelledby="dropdownMenuCategory">
                            @foreach($categories as $fcategory)
                            <button class="dropdown-item post-filter" data-filter="{{$fcategory->id}}"
                                type="button">{{$fcategory->name}}</button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="category-filter-content">
                    <span class="category-filter-span"></span>
                    <i class="remove-category-filter-filter-span fas fa-times"></i>
                </div>
                @endif
                @php $postCount = 0; @endphp
                <div class="all-posts-content">
                    @foreach($featuredPosts as $featuredPost)
                    <div class="row post-row {{count($filters) == 0 ? 'mt-0' : ''}}">

                        @if($featuredPost->video!='' && strpos($featuredPost->image_url,'img.youtube.com/vi'))

                        <a href="{{route('frontend.single-post', $featuredPost->url)}}" class="post-link"></a>
                        <div class="col-sm-6"> <img alt="{{$featuredPost->title}}" class="img-fluid post-image"
                                src="{{$featuredPost->image_url}}">
                        </div>
                        @else
                        <a href="{{route('frontend.single-post', $featuredPost->url)}}" class="post-link"></a>
                        <div class="col-sm-6">

                            <img alt="{{$featuredPost->title}}" class="img-fluid post-image"
                                src="{{asset('images/posts').'/'.$featuredPost->image_url}}">
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="post-title">{{$featuredPost->title}}</div>
                            <div class="post-category-date">
                                <span class="post-category"
                                    style="background-color: {{$featuredPost->category->color ?? 'black'}}">{{$featuredPost->category->name ?? ''}}</span>
                                <span
                                    class="post-date">{{strtoupper($featuredPost->getFormattedDate($featuredPost->date))}}</span>
                            </div>
                            <div class="post-description">{{$featuredPost->description}}</div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($posts as $key => $post)
                    <div class="row post-row {{$key >= 5 ? 'hide-post' : ''}}">
                        <a href="{{route('frontend.single-post', $post->url)}}" class="post-link"></a>
                        <div class="col-sm-6">
                            @if($post->video!='' && strpos($post->image_url,'img.youtube.com/vi'))
                            <img alt="{{$post->title}}" class="img-fluid post-image" src="{{$post->image_url}}">
                            @else
                            <img alt="{{$post->title}}" class="img-fluid post-image"
                                src="{{asset('images/posts').'/'.$post->image_url}}">

                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="post-title">{{$post->title}}</div>
                            <div class="post-category-date">
                                <span class="post-category"
                                    style="background-color: {{$post->category->color ?? 'black'}}">{{$post->category->name ?? ''}}</span>
                                <span class="post-date">{{strtoupper($post->getFormattedDate($post->date))}}</span>
                            </div>
                            <div class="post-description">{{$post->description}}</div>
                        </div>
                    </div>
                    @endforeach
                    <div class="desktop-lazy-load"></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="desktop-radio-content">
                    <div class="form-control desktop-radio-label mt-0 mb-3">LISTEN LIVE</div>
                    <div class="row  online-radio-row top_space_mobile mt-3">
                        <div class="col-lg-4 pr-1">
                            <img src="img/frontend/Content-883JIA.png" class="online-radio-image">
                            <div class="button-listen-wrap button-wrap">
                                <a class="button-listen-main" name="883JIA" v-on:click="playRadio(1);">
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-8 title-column">
                            <div class="text-white pull-left online-radio-content">
                                <div style="font-size:18px">88.3JIA</div>
                                <div style="color: #9ba4b1; font-style: italic;">Adult Contemporary</div>
                                <div style="font-size:16px">ONLY BILINGUAL RADIO STATION</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  online-radio-row top_space_mobile mt-3">
                        <div class="col-lg-4 pr-1">
                            <img src="img/frontend/Content-883JIA_2.png" class="online-radio-image">
                            <div class="button-listen-wrap button-wrap">
                                <a class="button-listen-main" name="883JIAHITS" v-on:click="playRadio(2);">
                                </a>
                                {{-- <a class="button-listen-main" v-else-if="audio_on == true" v-on:click="stopSound_883JIA_2()">
                      </a> --}}
                            </div>
                        </div>
                        <div class="col-lg-8 title-column">
                            <div class="text-white pull-left online-radio-content">
                                <div style="font-size:18px">88.3JIA 网曲</div>
                                <div style="color: #9ba4b1; font-style: italic;">Top Hits from the web</div>
                                <div style="font-size:16px">TRENDING SONGS FROM THE WEB</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  online-radio-row top_space_mobile mt-3">
                        <div class="col-lg-4 pr-1">
                            <img src="img/frontend/Content-883JIA_3.png" class="online-radio-image">
                            <div class="button-listen-wrap button-wrap">
                                <a class="button-listen-main" name="883JIAKPOP" v-on:click="playRadio(3);">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 title-column">
                            <div class="text-white pull-left online-radio-content">
                                <div style="font-size:18px">88.3JIA K-POP</div>
                                <div style="color: #9ba4b1; font-style: italic;">Korean Hit Songs</div>
                                <div style="font-size:16px">OUR MUSIC BIBIMBAP - THE HOTTEST AND BEST K-POP MIX</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  online-radio-row top_space_mobile mt-3">
                        <div class="col-lg-4 pr-1">
                            <img src="img/frontend/POWERHITS-min.png" class="online-radio-image">
                            <div class="button-listen-wrap button-wrap">
                                <a class="button-listen-main" name="POWER98HITS" v-on:click="playRadio(4);">
                                </a>

                            </div>
                        </div>
                        <div class="col-lg-8 title-column">
                            <div class="text-white pull-left online-radio-content">
                                <div style="font-size:18px">POWER 98 HITS!</div>
                                <div style="color: #9ba4b1; font-style: italic;">Hot Adult Contemporary Hits</div>
                                <div style="font-size:16px">THE MUSIC YOU LOVE</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  online-radio-row top_space_mobile mt-3">
                        <div class="col-lg-4 pr-1">
                            <img src="img/frontend/POWERLOVESONGS-min.png" class="online-radio-image">
                            <a class="button-listen-main" name="POWER98LOVE" v-on:click="playRadio(5);">
                            </a>
                            {{-- <a class="button-listen-main" v-else-if="audio_on == true" v-on:click="stopSound_power_98_ls()">
                      </a> --}}
                        </div>
                        <div class="col-lg-8 title-column">
                            <div class="text-white pull-left online-radio-content">
                                <div style="font-size:18px">POWER 98 LOVE SONGS</div>
                                <div style="color: #9ba4b1; font-style: italic;">Love Songs</div>
                                <div style="font-size:16px">BEST OF LOVE SONGS</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  online-radio-row top_space_mobile mt-3">
                        <div class="col-lg-4 pr-1">
                            <img src="img/frontend/POWERRAW-min.png" class="online-radio-image">
                            <a class="button-listen-main" name="POWER98RAW" v-on:click="playRadio(6);">
                            </a>
                            {{-- <a class="button-listen-main" v-else-if="audio_on == true" v-on:click="stopSound_power_98()">
                      </a> --}}
                        </div>
                        <div class="col-lg-8 title-column">
                            <div class="text-white pull-left online-radio-content">
                                <div style="font-size:18px">POWER 98 RAW</div>
                                <div style="color: #9ba4b1; font-style: italic;">Emerging Artistes</div>
                                <div style="font-size:16px">HITS OF TOMORROW</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="desktop-news-content">
                    <div class="form-control desktop-news-label mt-3 mb-3">
                        {{$newsLabel->name ?? ''}}
                        <div class="carousel-control-content">
                            <i class="fas fa-chevron-left trigger-to-left mr-3"></i>
                            <i class="fas fa-chevron-right trigger-to-right"></i>
                        </div>
                    </div>
                    <div class="bd-example news-row">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($allNews as $key => $news)
                                <div class="carousel-item {{$key == 1 ? 'active' : ''}}">
                                    <img alt="{{$news->title}}" class="img-fluid news-image"
                                        src="{{asset('images/news').'/'.$news->image_url}}">
                                    <div>
                                        <h3 class="news-title">{{$news->title}}</h3>
                                        <div class="news-category-date">
                                            <span class="news-category"
                                                style="background-color: {{$news->category->color ?? 'black'}}">{{$news->category->name ?? ''}}</span>
                                            <span
                                                class="news-date">{{strtoupper($news->getFormattedDate($news->date))}}</span>
                                        </div>
                                        <div class="news-description">{!! $news->description !!}</div>
                                        <a href="{{$news->external_url}}" target="_blank"
                                            class="btn news-link">PARTICIPATE</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabled-mobile-content d-block d-lg-none">
        <div class="row">
            <div class="col-sm-12">
                <div class="filter-content form-control">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            LATEST
                        </button>
                        <div class="dropdown-menu" data-device="mobile" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item post-sortable" data-sort="DESC" type="button">LATEST</button>
                            <button class="dropdown-item post-sortable" data-sort="ASC" type="button">OLDEST</button>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuCategory"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORY
                        </button>
                        <div class="dropdown-menu" data-device="mobile" aria-labelledby="dropdownMenuCategory">
                            @foreach($categories as $fcategory)
                            <button class="dropdown-item post-filter" data-filter="{{$fcategory->id}}"
                                type="button">{{$fcategory->name}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="category-filter-content">
                    <span class="category-filter-span"></span>
                    <i class="remove-category-filter-filter-span fas fa-times"></i>
                </div>
            </div>
        </div>
        @if($featuredPosts->count())
        <div id="mobilePostsCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($featuredPosts as $key => $featuredPost)
                <li data-target="#mobilePostsCarousel" data-slide-to="{{$key}}"
                    class="{{$key == 0 ? 'active' : ''}}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($featuredPosts as $key => $featuredPost)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <a href="{{route('frontend.single-post', $featuredPost->url)}}" class="post-link"></a>
                    @if($featuredPost->video!='' && strpos($featuredPost->image_url, '/img.youtube.com/vi/'))
                    <img alt="{{$featuredPost->title}}" class="img-fluid featured-image"
                        src="{{$featuredPost->image_url}}">
                    @else
                    <img alt="{{$featuredPost->title}}" class="img-fluid featured-image"
                        src="{{asset('images/posts').'/'.$featuredPost->image_url}}">
                    @endif
                    <div>
                        <h3 class="featured-title">{{$featuredPost->title}}</h3>
                        <div class="featured-category-date">
                            <span class="featured-category"
                                style="background-color: {{$featuredPost->category->color ?? 'black'}}">{{$featuredPost->category->name ?? ''}}</span>
                            <span
                                class="featured-date">{{strtoupper($featuredPost->getFormattedDate($featuredPost->date))}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="row mt-3">
            <div class="col-sm-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts-content" role="tab"
                            aria-controls="home" aria-selected="true">CONTENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="news-tab" data-toggle="tab" href="#news-content" role="tab"
                            aria-controls="profile" aria-selected="false">{{$newsLabel->name ?? 'CONTEST'}}</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts-content" role="tabpanel"
                        aria-labelledby="posts-tab">
                        @foreach($posts as $key => $post)
                        <div class="row post-row {{$key >= 5 ? 'hide-post' : ''}}">
                            <a href="{{route('frontend.single-post', $post->url)}}" class="post-link"></a>
                            <div class="col-sm-6">
                                @if($post->video!='' && strpos($post->image_url, '/img.youtube.com/vi/'))
                                <img alt="{{$post->title}}" class="img-fluid post-image" src="{{$post->image_url}}">
                                @else
                                <img alt="{{$post->title}}" class="img-fluid post-image"
                                    src="{{asset('images/posts').'/'.$post->image_url}}">
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="post-title">{{$post->title}}</div>
                                <div class="post-category-date">
                                    <span class="post-category"
                                        style="background-color: {{$post->category->color ?? 'black'}}">{{$post->category->name ?? ''}}</span>
                                    <span class="post-date">{{strtoupper($post->getFormattedDate($post->date))}}</span>
                                </div>
                                <div class="d-sm-none d-xs-none post-description">{{$post->description}}</div>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" class="mobile-posts-lazy-load btn btn-dark">Load More</button>
                    </div>
                    <div class="tab-pane fade" id="news-content" role="tabpanel" aria-labelledby="news-tab">
                        @foreach($allNews as $key => $news)
                        <div class="row news-row {{$key >= 5 ? 'hide-news' : ''}}">
                            <div class="col-sm-6">
                                <img alt="{{$news->title}}" class="img-fluid news-image"
                                    src="{{asset('images/news').'/'.$news->image_url}}">
                            </div>
                            <div class="col-sm-6">
                                <div class="news-title">{{$news->title}}</div>
                                <div class="news-category-date">
                                    <span class="news-category"
                                        style="background-color: {{$news->category->color ?? 'black'}}">{{$news->category->name ?? ''}}</span>
                                    <span class="news-date">{{strtoupper($news->getFormattedDate($news->date))}}</span>
                                </div>
                                <div class="news-description">{!! $news->description !!}</div>
                                <a href="{{$news->external_url}}" target="_blank" class="btn news-link">PARTICIPATE</a>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" class="mobile-news-lazy-load btn btn-dark">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="sortable-form" action="{{route('frontend.getFilter')}}" method="POST" class="d-none">
    <input name="sort" class="sort-input" type="hidden" value="{{$sort ?? ''}}">
    <input name="category" class="filter-input" type="hidden" value="{{$filtredCategory->id ?? ''}}">
    <input name="device" class="device-input" type="hidden">
</form>
@endsection

@section('pagescripts')
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
        $('.carousel').carousel();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#sortable-form').on('submit', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var device = $(this).find('.device-input').val();
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (device == 'desktop') {
                        var postContent = '';
                        var postsCount = 0
                        for (let i = 0; i < data.featuredPosts.length; i++) {
                            var urlLink = data.featuredPosts[i]['url'];
                            postContent += '<div class="row post-row">' +
                                '<a href="/post/' + urlLink + '" class="post-link"></a>' +
                                '<div class="col-sm-6">';
                            if (data.featuredPosts[i]['video'] != '' && data.featuredPosts[
                                    i]['image_url'].includes("img.youtube.com/vi")) {
                                postContent += '<img class="img-fluid post-image" src="' +
                                    data.featuredPosts[i]['image_url'] + '">';
                            } else {
                                postContent +=
                                    '<img class="img-fluid post-image" src="/images/posts/' +
                                    data.featuredPosts[i]['image_url'] + '">';
                            }
                            postContent += '</div>';
                            postContent += '<div class="col-sm-6">' +
                                '<div class="post-title">' + data.featuredPosts[i][
                                    'title'
                                ] + '</div>';
                            postContent += '<div class="post-category-date">';
                            if (data.featuredPosts[i]['category']) {
                                postContent +=
                                    '<span class="post-category" style="background-color: ' +
                                    data.featuredPosts[i]['category']['color'] + '">' +
                                    data.featuredPosts[i]['category']['name'] + '</span>';
                            }
                            postContent += '<span class="post-date">' + data.featuredPosts[
                                    i]['date'] +
                                '</span></div>' +
                                '<div class="post-description">' +
                                data.featuredPosts[i]['description'] + '</div></div></div>';
                            ++postsCount;
                        }
                        for (let i = 0; i < data.posts.length; i++) {
                            var urlLink = data.posts[i]['url'];
                            var hiddenClass = '';
                            if (postsCount >= 5) {
                                hiddenClass = 'hide-post';
                            }
                            postContent += '<div class="row post-row ' + hiddenClass +
                                '">' +
                                '<a href="/post/' + urlLink + '" class="post-link"></a>' +
                                '<div class="col-sm-6">';
                            if (data.posts[i]['video'] != '' && data.posts[i]['image_url']
                                .includes("img.youtube.com/vi")) {
                                postContent += '<img class="img-fluid post-image" src="' +
                                    data.posts[i]['image_url'] + '">';
                            } else {
                                postContent +=
                                    '<img class="img-fluid post-image" src="/images/posts/' +
                                    data.posts[i]['image_url'] + '">';
                            }
                            postContent += '</div>';
                            postContent += '<div class="col-sm-6">' +
                                '<div class="post-title">' + data.posts[i]['title'] +
                                '</div>';
                            postContent += '<div class="post-category-date">';
                            if (data.posts[i]['category']) {
                                postContent +=
                                    '<span class="post-category" style="background-color: ' +
                                    data.posts[i]['category']['color'] + '">' +
                                    data.posts[i]['category']['name'] + '</span>';
                            }
                            postContent += '<span class="post-date">' + data.posts[i][
                                    'date'
                                ] +
                                '</span></div>' +
                                '<div class="post-description">' +
                                data.posts[i]['description'] + '</div></div></div>';
                            ++postsCount;
                        }
                        $('.all-posts-content').html(postContent);
                    } else {
                        var featuredPost = '';
                        var postContent = '';
                        var postsCount = 0;
                        if (data.featuredPosts.length == 0) {
                            $('#mobilePostsCarousel').fadeOut();
                        } else {
                            $('#mobilePostsCarousel').fadeIn();
                            var indicators = '';
                            var active = '';
                            for (let i = 0; i < data.featuredPosts.length; i++) {
                                if (i == 0) {
                                    active = 'active';
                                }
                                indicators +=
                                    '<li data-target="#mobilePostsCarousel" data-slide-to="' +
                                    i + '"' +
                                    'class="' + active + '"></li>';
                            }
                            $('#mobilePostsCarousel .carousel-indicators').html(indicators);
                            var cActive = ''
                            for (let i = 0; i < data.featuredPosts.length; i++) {
                                var urlLink = data.featuredPosts[i]['url'];
                                if (i == 0) {
                                    cActive = 'active';
                                }
                                featuredPost += '<div class="carousel-item ' + active +
                                    '">' +
                                    '<a href="/post/' + urlLink +
                                    '" class="post-link"></a>';
                                if (data.featuredPosts[i]['video'] != '' && data
                                    .featuredPosts[i]['image_url'].includes(
                                        "img.youtube.com/vi")) {
                                    featuredPost +=
                                        '<img class="img-fluid featured-image" src="' + data
                                        .featuredPosts[i]['image_url'] + '">';
                                } else {
                                    featuredPost +=
                                        '<img class="img-fluid featured-image" src="/images/posts/' +
                                        data.featuredPosts[i]['image_url'] + '">';
                                }
                                featuredPost += '<div>';
                                '<h3 class="featured-title">' + data.featuredPosts[i][
                                    'title'
                                ] + '</h3>';
                                if (data.featuredPosts[i]['category']) {
                                    featuredPost += '<div class="featured-category-date">' +
                                        '<span class="featured-category" style="background-color: ' +
                                        data.featuredPosts[i]['category']['color'] + '">' +
                                        data.featuredPosts[i]['category']['name'] +
                                        '</span></div>';
                                }
                                featuredPost += '</div></div>';
                            }
                        }
                        for (let i = 0; i < data.posts.length; i++) {
                            var urlLink = data.posts[i]['url'];
                            var hiddenClass = '';
                            if (postsCount >= 5) {
                                hiddenClass = 'hide-post';
                            }
                            postContent += '<div class="row post-row ' + hiddenClass +
                                '">' +
                                '<a href="/post/' + urlLink + '" class="post-link"></a>' +
                                '<div class="col-sm-6">';
                            if (data.posts[i]['video'] != '') {
                                postContent += '<img class="img-fluid post-image" src="' +
                                    data.posts[i]['image_url'] + '">';
                            } else {
                                postContent +=
                                    '<img class="img-fluid post-image" src="/images/posts/' +
                                    data.posts[i]['image_url'] + '">';
                            }
                            postContent += '</div>' +
                                '<div class="col-sm-6">' +
                                '<div class="post-title">' + data.posts[i]['title'] +
                                '</div>';
                            postContent += '<div class="post-category-date">';
                            if (data.posts[i]['category']) {
                                postContent +=
                                    '<span class="post-category" style="background-color: ' +
                                    data.posts[i]['category']['color'] + '">' +
                                    data.posts[i]['category']['name'] + '</span>';
                            }
                            postContent += '<span class="post-date">' + data.posts[i][
                                    'date'
                                ] +
                                '</span></div>' +
                                '<div class="post-description">' +
                                data.posts[i]['description'] + '</div></div></div>';
                            ++postsCount;
                        }
                        $('#posts-content').html(postContent);
                    }
                },
                error: function (xhr, status) {
                    console.log("Sorry, there was a problem!");
                }
            });
        });

        $(".carousel-control-content").on('click', '.trigger-to-right', function () {
            $("#carouselExampleCaptions").carousel("next");
        });

        $(".carousel-control-content").on('click', '.trigger-to-left', function () {
            $("#carouselExampleCaptions").carousel("prev");
        });

        $('.post-sortable').on('click', function (e) {
            var sort = $(this).data('sort');
            var device = $(this).parent().data('device');
            $(this).parent().prev().text($(this).text());
            $('#sortable-form').find('.sort-input').val(sort);
            $('#sortable-form').find('.device-input').val(device);
            $('#sortable-form').submit();
        });

        $('.post-filter').on('click', function (e) {
            var filter = $(this).data('filter');
            var device = $(this).parent().data('device');
            $('.category-filter-content').addClass('show-filter');
            $('.category-filter-content').find('.category-filter-span').text($(this).text());
            $('#sortable-form').find('.filter-input').val(filter);
            $('#sortable-form').find('.device-input').val(device);
            $('#sortable-form').submit();
        });

        $('.mobile-posts-lazy-load').on('click', function () {
            var showPostCount = 0;
            $('.tabled-mobile-content .hide-post').each(function () {
                if (showPostCount == 5) {
                    return false;
                }
                $(this).fadeOut().removeClass('hide-post').fadeIn(1000);
                ++showPostCount
            });

            if ($('.tabled-mobile-content .hide-post').length == 0) {
                $('.mobile-posts-lazy-load').fadeOut(800);
            }
        });

        if ($('.tabled-mobile-content .hide-post').length == 0) {
            $('.mobile-posts-lazy-load').fadeOut(800);
        }

        if ($('.tabled-mobile-content .hide-news').length == 0) {
            $('.mobile-news-lazy-load').fadeOut(800);
        }

        $('.mobile-news-lazy-load').on('click', function () {
            var showNewsCount = 0;
            $('.tabled-mobile-content .hide-news').each(function () {
                if (showNewsCount == 5) {
                    return false;
                }
                $(this).fadeOut().removeClass('hide-news').fadeIn(1000);
                ++showNewsCount
            });

            if ($('.tabled-mobile-content .hide-news').length == 0) {
                $('.mobile-posts-lazy-load').fadeOut(800);
            }
        });

        $('.category-filter-content').on('click', '.remove-category-filter-filter-span', function () {
            $('#sortable-form').find('.filter-input').val('');
            $('.category-filter-content').removeClass('show-filter');
            $('#sortable-form').submit();
        });

        $(window).on('scroll', function () {
            var bodyScrollTop = $(document).scrollTop();
            if (bodyScrollTop + 500 >= $(".desktop-lazy-load").offset().top) {
                var showPostCount = 0;
                $('.desktop-content .hide-post').each(function () {
                    if (showPostCount == 5) {
                        return false;
                    }
                    $(this).removeClass('hide-post').addClass('show-post');
                    ++showPostCount
                })
            }
        });
    })
</script>
@endsection