@extends('frontend.layouts.front')

@section('title', 'Camokakis Music Stations' . ' | ' . __('navs.general.home'))

@section('content')
	<!--<div id="app">-->
      <div class="main_section faq-content">
            <div class="container">
				<br>
                 <h2>FAQs on Camokakis App</h2>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                Q: What is Camokakis?
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                        <div class="panel-body">
                                        A: Camokakis (CK) is a brand new free radio app offering uninterrupted streaming of all the music you love:
                                        <ul class="mb-0">
                                            <li>88.3JIA</li>
                                            <li>88.3JIA 网曲</li>
                                            <li>88.3JIA K-POP</li>
                                            <li>POWER 98 LOVE SONGS</li>
                                            <li>POWER 98 HITS!</li>
                                            <li>POWER 98 RAW</li>
                                        </ul>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                Q: How much does the App cost?
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  A:  The Camokakis App is free.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                        <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                          Q: What’s the meaning behind the name “Camokakis”?
                        </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          A: Camokakis is made up of “Camo” (short-form for camouflage) and “Kakis” (a Singlish term meaning buddies or good friends). We want you to be our “kaki” and be entertained by our content, whether on-air, online or via the app! 
                        </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                          Q: How do I share a feedback regarding CK? 
                        </a>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          A: Hi, you can write to us at <a href="mailto:contactus@camokakis.sg">contactus@camokakis.sg</a> and we will get in touch with you as soon as we can!
                        </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                          Q: How do I get the App?
                        </a>
                        </div>
                        <div id="collapseSix" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              A: You can download it free from <a href="https://apps.apple.com/sg/app/camokakis/id1060133120" target="_blank">App Store</a> and <a href="https://play.google.com/store/apps/details?id=com.safraradio.jia883&hl=en_SG" target="_blank">Play Store!</a>
                              <div class="row mt-3">
                                <div class="col-sm-4 col-md-3 col-lg-2 text-center faq-image-content">
                                    <img src="{{asset("img/frontend/faq/camokakis-faq-app-store-qr.png")}}">
                                    <a href="https://apps.apple.com/sg/app/camokakis/id1060133120" target="_blank">
	                                    <img class="mt-2" src="{{asset("img/frontend/faq/app-store.png")}}">
	                                </a>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2 text-center faq-image-content">
                                    <img src="{{asset("img/frontend/faq/camokakis-FAQ-google-play_QR.png")}}">
                                    <a href="https://play.google.com/store/apps/details?id=com.safraradio.jia883&hl=en_SG" target="_blank">
	                                    <img class="mt-2" src="{{asset("img/frontend/faq/google-play-store.png")}}">
	                                </a>
                                </div>
                              </div>
                            </div>
                        </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
                              Q: What content is included in the App?
                            </a>
                            </div>
                            <div id="collapseSeven" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  A: There are 6 free music streams from various music genres. We have plans to upgrade the App to bring you more exciting features in the near future, so stay tuned for more!
                                </div>
                            </div>
                        </div>
                    <div class="card">
                        <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
                          Q: Which Operating System is the App compatible with?
                        </a>
                        </div>
                        <div id="collapseEight" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          A: Our App requires iOS 9.0 and up or Android OS 4.0 and up.
                        </div>
                        </div>
                    </div>
						
						 <div class="card">
                        <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseNine">
                          Q: Why can't I listen to these stations – 88.3JIA WEB HITS, 88.3JIA K-POP, POWER 98 HITS!, POWER 98 RAW - when I'm not in Singapore?
                        </a>
                        </div>
                        <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          A: Due to copyright reasons, these music streams are only available in Singapore.
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<!--</div>-->
<img border="0" src="https://r.turn.com/r/beacon?b2=fpRE4L_9lRMiFt3odl8E2rpMfs5FlHzboUpkj9602WQiOVO0TIg1-IR9FbaIEy0YNyOACCQv-tQKPX_Caf_2Tg&cid=">

@endsection
