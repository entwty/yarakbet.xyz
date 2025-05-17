{php} include "content/dark-theme/view/dark_header.php";{/php}

{php} if (isset($duyuru->icerik)) { {/php}

<!-- Duyuru Modal -->
{literal}

<script type="text/javascript">
$(function(){
    var d = "<?php echo date('d'); ?>";
	var duyuru_id = "<?php echo $duyuru->id; ?>";
	if ( localStorage.getItem('duyuru_' + duyuru_id + '_' + d) === null ) {
        $('#remodalx').remodal().open();
        $(".duyuru-kapat").on('click', function() {
			localStorage.setItem('duyuru_' + duyuru_id + '_' + d, 1 );
		});
	}
});
</script>


{/literal} 


<div class="remodal home-remodal" id="remodalx" data-remodal-id="duyuru-<?php echo $duyuru->id; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" style="background: none;">
    <div class="modal-content" style="-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;">
        <div class="modal-header">
            <button type="button" class="close" data-remodal-action="close" aria-label="Close"><i class="icon-close"></i></button>
            <h4 class="modal-title">DUYURULAR</h4>
        </div>
        <div class="modal-body scrollable" >
            <p style="font-size: 16px;">{php} echo $duyuru->icerik; {/php}</p>
        </div>
        <div class="modal-footer">
            <button data-remodal-action="confirm" class="remodal-confirm duyuru-kapat" data-id="<?php echo $duyuru->id; ?>" style="padding: 10px 20px 10px 20px;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;">BİR DAHA GÖSTERME</button>
        </div>
    </div>
</div>

{php} } {/php}

<section id="" class="" >

          <div id="large-slider" class="carousel slide" data-ride="carousel">

  <ol class="carousel-indicators"> 
  {php}$sayi = 0;{/php}
  {foreach from="$bannerlar" item="banner" key="a"}
  {php}
  if ($sayi == 0) {$csxx = "active";}
  else {$csxx = "";}
  {/php}
  <li data-target="#large-slider" data-slide-to='{php}echo $sayi;{/php}' class='{php}echo $csxx;{/php}'></li>
  {php}$sayi++;{/php}
  {/foreach}      
</ol>



<div class="carousel-inner" role="listbox">
  {php}$sayi = 1;{/php}
  {foreach from="$bannerlar" item="banner" key="a"}
  {php}
  if ($sayi == 1) {$csx = "active";}
  else {$csx = "";}
  {/php}
  <div class="item {php}echo $csx;{/php}" data-bgcolor="#000000">
  		<a><img src='{php}echo $banner->url;{/php}'></a>
  </div>
  {php}$sayi++;{/php}
  {/foreach} 
</div>


    <body oncontextmenu="return false" onselectstart="return false" ondragstart="return false" >
    <a class="left carousel-control hidden-xs" href="#large-slider" role="button" data-slide="prev">
      <span class="glyphicon-chevron-left icon-arrow-left" aria-hidden="true"></span> <span class="sr-only">Geri</span>
    </a>
    <a class="right carousel-control hidden-xs" href="#large-slider" role="button" data-slide="next">
      <span class="glyphicon-chevron-right icon-arrow-right" aria-hidden="true"></span> <span class="sr-only">İleri</span>
    </a>
  </div>
  
  <div class="container mobilehide">
        <div id="main-panel" class="row ">
            <div id="main-center">
                <div class="center-container">
                    <div class="row products">
                        
                        <div class="col-sm-3 col-xs-6 ">
                            <a href="/sports" class="product " ">
                            <img src="/uploads/homepage/sports.jpg" width="100%">
                            </a>
                        </div>



                        <div class="col-sm-3 col-xs-6">
                            <a href="/live" class="product ">
                                <img src="/uploads/homepage/live.jpg" width="100%">
                            </a>
                        </div>



                        <div class="col-sm-3 col-xs-6">
                            <a href="/LiveCasino/Slot" class="product " >
                                <img src="/uploads/homepage/casino.jpg" width="100%">

                            </a>
                        </div>


                        <div class="col-sm-3 col-xs-6">
                            <a href="/LiveCasino" class="product " >
                                <img src="/uploads/homepage/livecasino.jpg" width="100%">

                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
  
  <div class="otk-landing_pbet">
  
  <div class="otk-pbet_popular_games otk-el-row" style="margin-left: -7.5px; margin-right: -7.5px;">
            <div class="otk-m_g_left" style="background-image: url('/assets/images/mgleft.png');">
                <div class="otk-sbox game_ch_lef_shw"></div>
            </div>
            <div class="otk-m_g_right" style="background-image: url('/assets/images/mgright.png');"></div>
            <div class="otk-int_box_item otk-game_of_m_covr otk-game_box_lg otk-el-col otk-el-col-10" style="padding-left: 7.5px; padding-right: 7.5px;">
                <a href="/GameLoby?203" class="otk-g_b_i_cover">
                    <div class="otk-game_box_interior" style="background-image: url('media/img/gates-of-olympus.svg');"></div>
                    <div class="otk-pn_game_name">Gates of Olympus</div>
                </a>
                <div class="otk-ribbon otk-ribbon-top-right"><span>Ayın Oyunu</span></div>
            </div>
            <div class="otk-int_box_item otk-pb_pg_right otk-el-col otk-el-col-14" style="padding-left: 7.5px; padding-right: 7.5px;">
                <div class="otk-game_box otk-animate otk-animate-bg otk-el-col otk-el-col-12" style="padding-left: 7.5px; padding-right: 7.5px;">
                    <a href="/GameLoby?337" class="otk-g_b_i_cover">
                        <div class="otk-game_box_interior" style="background-image: url('images/gif/ed03efcd7c82da65e70d021dfe3422e1_casinoGameIcon3.gif');"></div>
                        <div class="otk-pn_game_name">Sugar Rush</div>
                    </a>
                </div>
                <div class="otk-game_box otk-animate otk-animate-bg otk-el-col otk-el-col-12" style="padding-left: 7.5px; padding-right: 7.5px;">
                    <a href="/GameLoby?487" class="otk-g_b_i_cover">
                        <div class="otk-game_box_interior" style="background-image: url('images/gif/sweet.gif');"></div>
                        <div class="otk-pn_game_name">Sweet Bonanza</div>
                    </a>
                </div>
                <div class="otk-game_box otk-animate otk-animate-bg otk-el-col otk-el-col-12" style="padding-left: 7.5px; padding-right: 7.5px;">
                    <a href="/GameLoby?259" class="otk-g_b_i_cover">
                        <div class="otk-game_box_interior" style="background-image: url('images/gif/bigger.gif');"></div>
                        <div class="otk-pn_game_name">Bigger Bass Bonanza</div>
                    </a>
                </div>
                <div class="otk-game_box otk-animate otk-animate-bg otk-el-col otk-el-col-12" style="padding-left: 7.5px; padding-right: 7.5px;">
                    <a href="/GameLoby?120" class="otk-g_b_i_cover">
                        <div class="otk-game_box_interior" style="background-image: url('images/gif/dog.gif');"></div>
                        <div class="otk-pn_game_name">The Dog House</div>
                    </a>
                </div>
            </div>
        </div>

        
        <div class="otk-pbet_interior_boxes otk-live_casino otk-el-row">
            <div class="otk-live_box_item otk-first_l_box otk-el-col otk-el-col-6">
                <a href="/GameLoby?95" class="otk-int_box_item_in otk-lin_in otk-poker_b" style="background-image: url('/images/gif/candyland.gif');border-radius: 200px;"></a>
                <div class="otk-sbox otk-sboxlive"></div>
                <a href="/GameLoby?92" class="otk-landing_btn otk-live_btn">Candy Land Sweet Bonanza</a>
          
            </div>
            <div class="otk-live_box_item otk-el-col otk-el-col-6">
                <a href="/GameLoby?95" class="otk-int_box_item_in otk-lin_in" style="background-image: url('/images/lighting.jpg');border-radius: 200px;"></a>
                <div class="otk-sbox otk-sboxlive"></div>
                <a href="/GameLoby?93" class="otk-landing_btn otk-live_btn">Lighting Roulette</a>
            </div>
            <div class="otk-live_box_item otk-el-col otk-el-col-6">
                <a href="/GameLoby?95" class="otk-int_box_item_in otk-lin_in" style="background-image: url('/images/crayzwhell.jpg');border-radius: 200px;"></a>
                <div class="otk-sbox otk-sboxlive"></div>
                <a href="/GameLoby?94" class="otk-landing_btn otk-live_btn">Crazy Time</a>
            </div>
            <div class="otk-live_box_item otk-last_l_box otk-el-col otk-el-col-6">
                <a href="/GameLoby?95" class="otk-int_box_item_in otk-lin_in" style="background-image: url('/images/flip.jpg');border-radius: 200px;"></a>
                <div class="otk-sbox otk-sboxlive"></div>
                <a href="/GameLoby?95" class="otk-landing_btn otk-live_btn">Coin Flip</a>
               
            </div>
         
        </div>
                <div class="otk-new_l_arrow_down"><img src="/assets/images/arrow_down.svg"></div>
				
 <a href="/signin" class="otk-landing_btn otk-centered_btn" style="
    background: #ff7c0c;
">Hemen Üye Ol</a>
        <!---->
           <img src="/images/providers-logos.png" width="95%" height="100%">
    </div>
</section>
{php} include "content/dark-theme/view/dark_footer.php";{/php}