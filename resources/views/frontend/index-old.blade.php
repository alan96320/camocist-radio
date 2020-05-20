@extends('frontend.layouts.front')

@section('title', 'Camokakis Music Stations' . ' | ' . __('navs.general.home'))

@section('content')
	<!--<div id="app">-->
      <div class="main_section">
      <section class="section mt-5 ">
      	<div class="row top_space_mobile">
      		<div class="col-lg-4 col-sm-12 col-xs-12" style="padding:0px;">  
	  			 <img src="img/frontend/Content-883JIA.png" class="main_image img-responsive">
	  			 <div class="button-listen-wrap button-wrap">
	  			 	<a class="button-listen-main" v-if="audio_on == false" v-on:click="playSound()">Listen Live
		  			 	<span style="background-color:#ffffff;">
		  			 		<img src="img/frontend/Mini-Player-Button-Listen.png" alt="" class=" img-responsive image_favicon" />
		  			 	</span>
	  			 	</a>
                              <a class="button-listen-main" v-else-if="audio_on == true" v-on:click="stopSound()">Listen Live
                                    <span style="background-color:#ffffff;">
                                          <img src="img/frontend/Mini-Player-Button-Stop.png" alt="" class="img-responsive image_favicon_stop"/>
                                    </span>
                              </a>
	  			 </div>	 	
      		</div>
      		<div class="col-lg-4 col-sm-12 col-xs-12" style="padding:0px">
      			<img src="img/frontend/Content-883JIA_2.png" class="main_image img-responsive">
      			<div class="button-listen-wrap button-wrap">
      				<a class="button-listen-main" v-if="audio_883JIA_2 == false" v-on:click="playSound_883JIA_2()">Listen Live
	      				<span style="background-color:#ffffff;">
	      					<img src="img/frontend/Mini-Player-Button-Listen.png" alt="" class="img-responsive image_favicon"/>
	      				</span>
	      			</a>
                              <a class="button-listen-main" v-else-if="audio_883JIA_2 == true" v-on:click="stopSound_883JIA_2()">Listen Live
                                    <span style="background-color:#ffffff;">
                                          <img src="img/frontend/Mini-Player-Button-Stop.png" alt="" class="img-responsive image_favicon_stop"/>
                                    </span>
                              </a>
	      		</div>
      		</div>
      		<div class="col-lg-4 col-sm-12 col-xs-12" style="padding:0px">
      			<img src="img/frontend/Content-883JIA_3.png" class="main_image img-responsive">
      			<div class="button-listen-wrap button-wrap">
      				<a class="button-listen-main" v-if="audio_883JIA_3 == false" v-on:click="playSound_883JIA_3()">Listen Live
      					<span style="background-color:#ffffff;">
      						<img src="img/frontend/Mini-Player-Button-Listen.png" alt="" class="img-responsive image_favicon"/>
      					</span>
      				</a>
                              <a class="button-listen-main" v-else-if="audio_883JIA_3 == true" v-on:click="stopSound_883JIA_3()">Listen Live
                                    <span style="background-color:#ffffff;">
                                          <img src="img/frontend/Mini-Player-Button-Stop.png" alt="" class="img-responsive image_favicon_stop"/>
                                    </span>
                              </a>
      			</div>
      		</div>
  		</div>
      </section>
      
      <section class="section">
      	<div class="row">
                  <div class="col-lg-4 col-sm-12 col-xs-12" style="padding:0px"><!--Content-Power-98-hits!-->
                        <img src="img/frontend/POWERHITS-min.png" class="main_image img-responsive">
                        <div class="button-listen-wrap button-wrap">
                              <a class="button-listen-main" v-if="audio_power_98_hits == false" v-on:click="playSound_power_98_hits()">Listen Live
                                    <span style="background-color:#ffffff;">
                                          <img src="img/frontend/Mini-Player-Button-Listen.png" alt="" class="img-responsive image_favicon"/>
                                    </span>
                              </a>
                              <a class="button-listen-main"v-else-if="audio_power_98_hits == true" v-on:click="stopSound_power_98_hits()">Listen Live
                                    <span style="background-color:#ffffff;">
                                         <img src="img/frontend/Mini-Player-Button-Stop.png" alt="" class="img-responsive image_favicon_stop"/>
                                    </span>
                              </a>
                        </div>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-xs-12" style="padding:0px"><!--Content-Power-98-Love-Song-->
                        <img src="img/frontend/POWERLOVESONGS-min.png" class="main_image img-responsive">
                        <div class="button-listen-wrap button-wrap">
                              <a class="button-listen-main" v-if="audio_power_98_ls == false" v-on:click="playSound_power_98_ls()">Listen Live
                                    <span style="background-color:#ffffff;">
                                          <img src="img/frontend/Mini-Player-Button-Listen.png" alt="" class="img-responsive image_favicon"/>
                                    </span>
                              </a>
                              <a class="button-listen-main" v-else-if="audio_power_98_ls == true" v-on:click="stopSound_power_98_ls()">Listen Live
                                    <span style="background-color:#ffffff;">
                                          <img src="img/frontend/Mini-Player-Button-Stop.png" alt="" class="img-responsive image_favicon_stop"/>
                                    </span>
                              </a>
                        </div>
                  </div>
      		<div class="col-lg-4 col-sm-12 col-xs-12" style="padding:0px"><!-- Content-Power-98-->
      			 <img src="img/frontend/POWERRAW-min.png" class="main_image img-responsive">
      			 <div class="button-listen-wrap button-wrap">
      			 	<a class="button-listen-main" v-if="audio_power_98 == false" v-on:click="playSound_power_98()">Listen Live
      			 		<span style="background-color:#ffffff;">
      			 			<img src="img/frontend/Mini-Player-Button-Listen.png" alt="" class="img-responsive image_favicon"/>
      			 		</span>
      			 	</a>
                              <a class="button-listen-main" v-else-if="audio_power_98 == true" v-on:click="stopSound_power_98()">Listen Live
                                    <span style="background-color:#ffffff;">
                                         <img src="img/frontend/Mini-Player-Button-Stop.png" alt="" class="img-responsive image_favicon_stop"/>
                                    </span>
                              </a>
      			 </div>
      		</div>      		
  		</div>
      </section>
    </div>
<!--</div>-->
@endsection
