<!DOCTYPE html>

    <html class="wide wow-animation" lang="en">

    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Camokakis Music Stations</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:title" content="Camokakis Music Stations - @yield('title')" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:image" content="@yield('og-image')" />
    <meta property="og:description" content="@yield('description')">
	<meta name="description" content="@yield('meta_description', 'Camokakis is a brand new free radio app offering uninterrupted streaming of all the music you love (88.3JIA, 88.3JIA WEB HITS, 88.3JIA K-POP, POWER 98 LOVE SONGS, POWER 98 HITS!, POWER 98 RAW). Download Camokakis now and experience the best of music on the go!')">
    <meta name="google-play-app" content="app-id=com.safraradio.jia883" app-argument="https://play.google.com/store/apps/details?id=com.safraradio.jia883">
    <meta name="apple-itunes-app" content="app-id=1060133120,app-argument=https://apps.apple.com/sg/app/jia-88-3/id1060133120">
		<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KJ5CV63');</script>
<!-- End Google Tag Manager -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-142494701-1', 'auto');
  ga('send', 'pageview');

</script>
    <link rel="icon" href="{{ asset('img/frontend/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
        @yield('meta')
        @yield('pagestyles')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        @push('before-styles')
            <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
            <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
            <link rel="stylesheet" href="{{ asset('css/style.css') }}">
            <style>
            .ie-panel{
            	display: none;
            	background: #212121;
            	padding: 10px 0;
            	box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);
            	clear: both;
            	text-align:center;
            	position: relative;z-index: 1;
            }
            
            .lyric-div{   max-height: 100% !important;
    background: #252525 !important;
    max-width: 100% !important;
    position: relative;
    overflow:auto;
    
            }
             html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartbanner/1.0.0/jquery.smartbanner.css">
        @endpush
         @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}

        @stack('after-styles')
		 <script type="text/javascript">
      var appurl = '{{url("/")}}/';

    </script>
    </head>
    <body style="background-color: #353a40;">
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJ5CV63"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
         <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="{{asset('images/ie8-panel/warning_bar_0000_us.jpg')}}" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
		    <div class="preloader">
		      <div class="preloader-body">
		        <div class="cssload-container">
		          <div class="cssload-speeding-wheel"></div>
		        </div>
		      </div>
		    </div>
		    <div id="app">
			    <div class="page">					
		            @include('frontend.includes.header')
		            @yield('content')
		            @include('frontend.includes.footer')
	            </div>
          
        	</div><!-- #app -->
		    @if(!$is_ie11)
                <iframe src="{{ asset('img/frontend/1sec.mp3') }}"   allow="autoplay" id="iframeAudio" style="display:none"></iframe>
            @endif
        	<div class="snackbars" id="form-output-global"></div>
 		
 			<a id="return-to-top"><i class="fal fa-angle-up"></i></a>
        <!-- Scripts -->
        @push('after-scripts')

            <script src="{{ asset('js/core.min.js') }} "></script>
            <script src="{{ asset('js/script.js') }} "></script>
           	<script>
           		$(window).scroll(function() {
				    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
				        $('#return-to-top').fadeIn(200);    // Fade in the arrow
				    } else {
				        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
				    }
				});
				$('#return-to-top').click(function() {      // When arrow is clicked
				    $('body,html').animate({
				        scrollTop : 0                       // Scroll to top of body
				    }, 500);
				});
       		</script>
       		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142494701-2"></script>
			<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
       		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartbanner/1.0.0/jquery.smartbanner.js"></script>

       		<script type="text/javascript">
                $('.show-box-live-wrap').on('click', function () {
                    if($('.mobile-tablet').hasClass('show-live-wrap')) {
                      $('.mobile-tablet').removeClass('show-live-wrap').addClass('hide-live-wrap');
                    } else {
                      $('.mobile-tablet').removeClass('hide-live-wrap').addClass('show-live-wrap');
                    }
                    setInterval(function(){
                        var playerPos = $('.mobile-tablet .player-name').scrollLeft();

                        if ($('.mobile-tablet .player-name').get(0).scrollWidth - $('.mobile-tablet .player-name').get(0).clientWidth <= playerPos) {
                            $('.mobile-tablet .player-name').scrollLeft(0);
                        } else { 
                            $('.mobile-tablet .player-name').scrollLeft(playerPos + 1);
                        }

                        var singlePos = $('.mobile-tablet .artist-song-name').scrollLeft();

                        if ($('.mobile-tablet .artist-song-name').get(0).scrollWidth - $('.mobile-tablet .artist-song-name').get(0).clientWidth <= singlePos) {
                            $('.mobile-tablet .artist-song-name').scrollLeft(0);
                        } else { 
                            $('.mobile-tablet .artist-song-name').scrollLeft(singlePos + 1);
                        }
                        
                    }, 30)
                });
		      $(function () {
		       $.smartbanner({
				    appendToSelector: 'header',
		        	daysHidden: 0, 
		        	daysReminder: 0,
                    icon: '{{ asset("img/frontend/camologo.png") }}'
		    	})
				$('.sb-close').on('click', function () {
                    $('#smartbanner').slideUp();
                });
		   	})
            $(document).ready(function(){
                $('.lyric').click(function(){
					if( $(this).parent('.no-lyrics').length ){
						return;
					}
					
					$('.lyric').removeClass('active').addClass('inactive');
					$(this).removeClass('inactive').addClass('active');
                });
				/*
				jQuery(document).on('click', '.no-lyrics .btn', function(){
					return;
				});*/
            })
				
            //Get lyrics Api//
			
				var p=0;
				var q=1;
				var jsons =[];
            $(document).on("click", "#lyrics, #lyricsMobile", function () {
              $('#lyric-div').hide();
              var artist_name =  document.getElementById("artist_name").innerText;
              var song_title = document.getElementById("song_title").innerText;
			  var time_start = document.getElementById("time_start").innerText;
              var type = $(this).data('type');
              $.ajax({
				  headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                url: appurl+"get_lyrics",
                type: 'POST',
                data:{artist_name:artist_name,song_title:song_title,time_start:time_start,type:type},  
                success:function(data){
                    //console.log(data);
                  if(data['message']=='success')
                    {
						if(data['type'] == 'lyric')
						{
							var title ='LYRICS';
							var lyrics = data['lyrics'];
							var lyricsMobile = data['lyrics'];
						} else {
							var p=0;
							var q=1;
							var lyrics = '';
							var lyricsMobile = '';
							var title ='LYRICS SYNC';
							var song_start = data['time_start'] ;
							var current_time = new Date().getTime();
							var duration = data['duration'];
							var arr = duration.split(':');
							var min = parseInt(arr[0]) ;
							var sec = parseInt(arr[1]) ;
							
							
							var end_time = song_start + (((3 * 60)+45)  * 1000);
							var json = JSON.stringify(data['jsons']);
							 jsons = JSON.parse(json);
							//console.log(jsons);
							jsons.forEach(function(obj){ 
								//console.log(obj.line);
							lyrics += "<p id='active"+q+"' style='color: rgb(119, 119, 119);'>"+obj.line+"</p>";
							lyricsMobile += "<p id='activeMobile"+q+"' style='color: rgb(119, 119, 119);'>"+obj.line+"</p>";
							q++;
							
							});
								 var loopTime =0;
							 	 var flag = false;
							  for(var cLine=0;cLine<jsons.length;cLine++) {
								//console.log(jsons[cLine]);
					if(jsons[cLine].milliseconds && (current_time<=end_time) && (song_start+parseInt(jsons[cLine].milliseconds)) >= current_time ) {

								  if(cLine != 0) {
									if(jsons[cLine-1].milliseconds) {
									  console.log('cLine :'+cLine,'loopTime :'+jsons[cLine-1].milliseconds,'line : '+jsons[cLine].line);
									  loopTime = parseInt(jsons[cLine-1].milliseconds)/1000;
									  console.log(loopTime);
									  p=cLine;
									  flag = true;
									  //countDown1( parseInt(jsons[cLine].milliseconds)/1000,jsons[cLine].line,loopTime);
									  break; 
									}
									else {
										console.log('cLine :'+cLine,'loopTime :'+jsons[cLine-2].milliseconds,'line : '+jsons[cLine].line);
										loopTime = parseInt(jsons[cLine-2].milliseconds)/1000;
										console.log(loopTime);
										p=cLine;
										 flag = true;
										//countDown1( parseInt(jsons[cLine].milliseconds)/1000,jsons[cLine].line,loopTime);
										break; 
									}

								  }
								  else {
									 loopTime = 0;
									 p=cLine;
									  flag = true;
									//console.log('cLine :'+cLine,'loopTime :'+jsons[cLine].milliseconds,'line : '+jsons[cLine].line);
								  // countDown1((jsons[cLine].milliseconds)/1000,jsons[cLine].line,loopTime); 
								   break;
								  }
								  //countDown1((jsons[cLine].milliseconds)/1000,jsons[cLine].line,loopTime);                   
								}
							  }
							if(flag) 
                			countDown1((jsons[p].milliseconds)/1000,jsons[p].line,loopTime); 
							
						}
						if(jQuery(".mobile-height").length != null){
							jQuery(".mobile-height").css("height", "550px");
						}
                        $('#lyric-div').show();
                        $('#full-lyrics').html('<div>'+title+'</div> <div class="hr-seprator">&nbsp;</div> <div id="lyrics-load" class="scrollbar"> <div class="display-lyrics"> '+nl2br(lyrics)+'</div> </div> <div> <div class="hr-seprator margin-top-270">&nbsp;</div> <a href="javascript:;" class="no-decoration" onclick="hideThis();" style="color:white;">CLOSE <i class="fal fa-angle-up"></i></a> </div>');
						$('#lyric-div-mobile').show();
                        $('#full-lyrics-mobile').html('<div>'+title+'</div> <div class="hr-seprator">&nbsp;</div> <div id="lyrics-load" class="scrollbar"> <div class="display-lyrics"> '+nl2br(lyricsMobile)+'</div> </div> <div> <div class="hr-seprator margin-top-270">&nbsp;</div> <a href="javascript:;" class="no-decoration" onclick="hideThis();"  style="color:white;">CLOSE <i class="fal fa-angle-up"></i></a> </div>');
                    } else {
						//$(".lyricType").prop('disabled', true);
				       //$(".syncType").prop('disabled', true);
					}
                }
              });
        });
				function nl2br (str, is_xhtml) {
					 var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
					 return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
				  } 
				function hideThis()
				{
					//console.log(11);
					$("#lyric-div").slideUp();
					$("#lyric-div-mobile").slideUp();
					//var elem = document.getElementById('lyric-div');
					//elem.style.transition = "all 6s ease-in-out";
					//elem.style.height = "0px";
					//document.getElementById('box-live-wrap').style.transition = "all 6s ease-in-out";
					//document.getElementById('box-live-wrap').style.height ="0px";
					//document.getElementById('box-live-wrap').style.minHeight ="0px";
					//document.getElementById('box-live-child').style.height ="0px";
					
					if(jQuery(".mobile-height").length != null){
						jQuery(".mobile-height").css('height', '120px');						
					}
					
				}
				function slideUp(el) {
				  var elem = document.getElementById(el);
				  elem.style.transition = "all 6s ease-in-out";
				  elem.style.height = "0px";
				}
		function countDown1(timeToSeconds,line,looptime)  {
          //timeToSeconds = timeToSeconds+looptime
          //if(timeToSeconds*1000>=time) {
            //console.log(timeToSeconds,line,looptime);
            timeToSeconds -=0.1; //Decrement the time entered.
            //looptime+=0.1;
           // console.log(timeToSeconds, line);
           // console.log(looptime);
            if((timeToSeconds <= looptime) && (typeof jsons[p] !== "undefined")){ //When time is 00:00:00 the message will show. 
              // document.getElementById("output").innerHTML = line;
               //console.log(timeToSeconds,line);
               looptime =(jsons[p].milliseconds)/1000;
               for(var x=0;x<jsons.length;x++) {
                var q = (x+1);
                if(p==x)
                {
					if(jQuery('#active'+q).length > 0){
						jQuery('#active'+q).css("color", "#fff");
					}
					if(jQuery('activeMobile'+q).length > 0){
						jQuery('activeMobile'+q).css("color", "#fff");
					}
               //document.getElementById('active'+q).style.color = "#fff";
               // document.getElementById('activeMobile'+q).style.color = "#fff";
              
                }
                else {
					if(jQuery('#active'+q).length > 0){
						jQuery('#active'+q).css("color", "#777777");
					}
					if(jQuery('activeMobile'+q).length > 0){
						jQuery('activeMobile'+q).css("color", "#777777");
					}
                // document.getElementById('active'+q).style.color = "#777777";
                //document.getElementById('activeMobile'+q).style.color = "#777777";
              
                }
               }

               p++;
               if(p<jsons.length) {
                if(jsons[p].milliseconds) {
                  countDown1((jsons[p].milliseconds)/1000,jsons[p].line,looptime);
                }
                else {
                  p++;
                  countDown1((jsons[p].milliseconds)/1000,jsons[p].line,looptime);
                }

               }
               else
               console.log('finish');
               return true;
             }
             else if(timeToSeconds !== -1){
               setTimeout(function(){countDown1(timeToSeconds,line,looptime)},100);
             }
             else {
              return false;
             }
             //timeToSeconds = 2;
          
          /*}
          else {
            p++;
               if(p<jsons.length) {
                if(jsons[p].milliseconds) {
                  countDown1((jsons[p].milliseconds)/1000,jsons[p].line,looptime);
                }
                else {
                  p++;
                  countDown1((jsons[p].milliseconds)/1000,jsons[p].line,looptime);
                }

               }
          }*/
        }
				
				  
			
		$('.rd-dropdown-link').on('click', function(e) {
			  $('#lyric-div').hide();
			$(".lyricType").removeClass("active");
			$(".syncType").removeClass("active");
			//$(".lyricType").prop('disabled', false);
			//$(".syncType").prop('disabled', false);
		});
				
				
		    </script>
        @endpush

        @stack('before-scripts')
        	{!! script(mix('js/manifest.js')) !!}
	        {!! script(mix('js/vendor.js')) !!}
	        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')
        @yield('pagescripts')
    </body>
</html>
