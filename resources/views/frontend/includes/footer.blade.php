 <footer class="section footer-classic footer-classic-newsletter bg-pattern-footer bg-gray-600" style="background-color: #353a40;padding:30px 0 30px">
    <div class="container">        
      <div class="row row-30 align-items-center justify-content-between text-center">
        <div class="col-xl-5 text-xl-left text-center">
          <a class="brand" href="#" style="max-width:208px;padding-left:-10px">
            @php {{ 
                $logo = App\Models\LogoSetting::where('key','footer_logo')->first();
            }}@endphp
            @if($logo)
             <img src="{{ asset('upload/Logo_Images/289_56_'.$logo->logo_image) }}" alt="" width="333" height="72" />
            @else 
              <img src="img/frontend/Logo.png" alt="" width="333" height="72" />
            @endif
          </a>
        </div>
        <div class="col-xl-4 col-lg-4 text-lg-right">
          <div class="pull-center">
            <p class="rights" style="font-size:12px;line-height:18px">
              <br><br>
               <a href="https://www.sodrama.sg/privacy/" target="_">PRIVACY POLICY</a>
              <br>
              <a href="https://www.sodrama.sg/privacy#terms" target="_">TERMS OF USE</a>
              <br>
              <a>@COPYRIGHT 2019 BY CAMOKAKIS</a>
              <br>
            </p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 text-lg-left">
          <div class="row">
             <div class="col-xl-11 col-lg-12" style="padding:0px">
                <span style="font-size:12px;">GET THE APP</span>
             </div>   
          </div>
          <div class="row" style="margin-top:0px;">
          <div class="col-xl-1 col-lg-2" style="padding:0px">
            <img src="{{ asset('img/frontend/app_icon.png') }}" style="height:48px;"/> 
          </div>
          <div class="col-xl-5 col-lg-6" style="padding:0px;padding-left:6px;">
  	        <div class="footer_app">
  	     	  	<a href="https://apps.apple.com/sg/app/jia-88-3/id1060133120" target="_">
  	        		<img src="{{ asset('img/frontend/app-store.png') }}" style="padding-bottom:1px;height:25px">
  	        	</a>
  	      	</div>
  	    	  
  	        <div class="footer_app">
  	     	  	<a href="https://play.google.com/store/apps/details?id=com.safraradio.jia883" target="_">
  	     	  		<img src="{{ asset('img/frontend/google-play-store.png') }}" style="padding-right:0px;height:24px;">
  	     	  	</a>
  	     	  </div>
          </div> 
        </div>
        <!--<div class="pull-left">
            <p class="rights">
              <a style="color:#c2c2c2" href="https://apps.apple.com/sg/app/jia-88-3/id1060133120">GET THE APP</a>

              <small style="font-size:12px;">
                <img src="{{ asset('img/frontend/app_icon.png') }}" height="30" width="15"/>             
              <a style="color:#c2c2c2" href="https://play.google.com/store/apps/details?id=com.safraradio.jia883">App </a>

                <a style="color:#c2c2c2" href="https://play.google.com/store/apps/details?id=com.safraradio.jia883"> Google</a>
              </small>
            </p>
          </div>-->
     	</div>
     </div>
   </div>
</footer>