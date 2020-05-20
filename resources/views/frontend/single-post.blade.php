@extends('frontend.layouts.front')

@section('title') {{$post->title}} @endsection

@section('description') {{$post->description}} @endsection
@section('og-image'){{asset('/images/post/'.$post->image_url)}}@endsection

@section('content') 
    <div class="main_section">
      @if (Breadcrumbs::exists()) 
          {!! Breadcrumbs::render() !!}
      @endif
      <div class="d-lg-block">
        <div class="row">
          <div class="col-sm-12 col-lg-8">
              <div class="post-category-date mt-4 mb-4">
                    <span class="post-category" style="background-color: {{$post->category->color ?? 'black'}}">{{$post->category->name ?? ''}}</span>
                    <span class="post-date">{{strtoupper($post->getFormattedDate($post->date))}}</span>
              </div>
              <div class="single-post-title"><h2>{{$post->title}}</h2></div>
              <div class="post-image-content mt-3 mb-3">
				  @if($post->video!='' && isset($post->video) && strpos($post->image_url, '/img.youtube.com/vi/')):
                    <div class="post-image-content mt-3 mb-3">
				  <div class="video-container"><iframe width="853" height="480" src="{{$post->video}}" frameborder="0" allowfullscreen></iframe></div>
              </div>
				  @else
				    <img alt="{{$post->title}}" class="img-fluid single-post-image" src="{{asset('images/posts').'/'.$post->image_url}}">
				  @endif
				  
              </div>
              <div class="post-content">
                {!! $post->content !!}
              </div>
              <div class="addthis_toolbox">
                <div class="custom_images">
                  
                </div>
              </div>
              <div class="addthis_toolbox addthis_default_style">                
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> 
              </div>
              <div class="addthis_inline_share_toolbox">
              </div>
          </div>
          <div class="d-none d-lg-block col-lg-4">
              <div class="desktop-radio-content">
                <div class="form-control desktop-radio-label mt-0 mb-3">LISTEN LIVE</div>
                <div class="row  online-radio-row top_space_mobile mt-3">
                  <div class="col-lg-4 pr-1">
                  <img src="{{asset('img/frontend/Content-883JIA.png')}}" class="online-radio-image">
                    <div class="button-listen-wrap button-wrap">
                      <a class="button-listen-main" v-on:click="playSound()">
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
                  <img src="{{asset('img/frontend/Content-883JIA_2.png')}}" class="online-radio-image">
                    <div class="button-listen-wrap button-wrap">
                      <a class="button-listen-main" v-on:click="playSound_883JIA_2()">
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
                  <img src="{{asset('img/frontend/Content-883JIA_3.png')}}" class="online-radio-image">
                    <div class="button-listen-wrap button-wrap">
                      <a class="button-listen-main" v-on:click="playSound_883JIA_3()">
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
                  <img src="{{asset('img/frontend/POWERHITS-min.png')}}" class="online-radio-image">
                    <div class="button-listen-wrap button-wrap">
                      <a class="button-listen-main" v-on:click="playSound_power_98_hits()">
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
                  <img src="{{asset('img/frontend/POWERLOVESONGS-min.png')}}" class="online-radio-image"> 
                      <a class="button-listen-main"  v-on:click="playSound_power_98_ls()">
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
                  <img src="{{asset('img/frontend/POWERRAW-min.png')}}" class="online-radio-image"> 
                      <a class="button-listen-main" v-on:click="playSound_power_98()">
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
                      @php $activeCarousel = 1 @endphp
                      @foreach($allNews as $news)
                      <div class="carousel-item {{$activeCarousel == 1 ? 'active' : ''}}">
                        <img alt="{{$news->title}}" class="img-fluid news-image" src="{{asset('images/news').'/'.$news->image_url}}">
                        <div>
                          <h3 class="news-title">{{$news->title}}</h3>
                          <div class="news-category-date">
                            <span class="news-category" style="background-color: {{$news->category->color ?? 'black'}}">{{$news->category->name ?? ''}}</span>
                            <span class="news-date">{{strtoupper($news->getFormattedDate($news->date))}}</span>
                          </div>
                          <div class="news-description">{!! $news->description !!}</div>
                          <a href="{{$news->external_url}}" target="_blank" class="btn news-link">PARTICIPATE</a>
                        </div>
                      </div>
                      @php ++$activeCarousel @endphp
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>          
          </div>
      </div>
    </div>
@endsection

@section('pagescripts')
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript">
   var addthis_config = {
      data_ga_property: 'UA-142494701-1',
      data_ga_social: true
   };
</script>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e0f7eeeca74d7f5"></script>
<script>
  $(document).ready(function () {
    $('.carousel').carousel();
    $(".carousel-control-content").on('click', '.trigger-to-right', function(){
      $("#carouselExampleCaptions").carousel("next");
    });
    $(".carousel-control-content").on('click', '.trigger-to-left', function(){
      $("#carouselExampleCaptions").carousel("prev");
    });
  })
</script>
@endsection