{php} include "content/dark-theme/view/dark_header.php";{/php}
<div class="navbar-title visible-sm visible-xs">
    <a href="" class="page-title">
        <i class="icon-casino"></i> Casino
    </a>
</div>

{literal}
    <script type="text/javascript">
        function openHogaming(id) {
            // window.open("/LiveCasino/Game/"+id,'_blank');
            window.open("/GameLoby?"+id,'_blank');
        }
        
     
        function ara(){
          const inputFeilds = document.getElementById('searchbar_game').value;

          const validInputs = Array.from(inputFeilds).filter( input => input.value !== "");


        let input = document.getElementById('searchbar_game').value
        input=input.toLowerCase();
        let casino = document.getElementsByClassName('casino-image');

        for (i = 0; i < casino.length; i++) { 
          if (!casino[i].innerHTML.toLowerCase().includes(input)) {
            casino[i].style.display="none";
          }
          else {
            casino[i].style.display="flex";                 
          }
        }
        }

        function saglayicilistOpen(){
            if($(".saglayici-listdrop").css("display") == "none"){
                $(".saglayici-listdrop").css({"display":"block"});
            }else{
                $(".saglayici-listdrop").css({"display":"none"});
            }
        }
        
        function saglayiciBul(clicked_id){
            
        document.getElementById('searchbar_game').value = clicked_id;
        ara();
        $(".saglayici-listdrop").css({"display":"none"});
        
        }
        
        
        function Btn_AllGamesFunc(){
            $("#Btn_AllGames").addClass("active");
            $("#Btn_PopularGames").removeClass("active");
            
            $("#PageGameTitle_h2").html("TÜM SLOT OYUNLARI");
            $(".allgamemain").css({"display":"flex"});
            $(".populargamemain").css({"display":"none"});
            
            ThrashSearch();
        }
        
        function Btn_PopularGamesFunc(){
            $("#Btn_AllGames").removeClass("active");
            $("#Btn_PopularGames").addClass("active");
            
            $("#PageGameTitle_h2").html("POPÜLER SLOT OYUNLARI");
            $(".allgamemain").css({"display":"none"});
            $(".populargamemain").css({"display":"flex"});
            
            ThrashSearch();
        }
        
        function ThrashSearch(){
            document.getElementById('searchbar_game').value = "";
            ara();
        }
        
        

        
       
      
    </script>


    <style>
.casino-image{
    height : 180px;
}
        @media (min-width: 992px) .casino-page-wrapper .casino-menu {
            min-height: 50px;
        }

            .casino-page-wrapper .casino-menu .submenu {
                display: block;
                height: 60px;
                width: 360px;
            }

            .casino-page-wrapper .casino-menu {
                background-color: #283347;
                position: relative;
                display: block;
            }

            .casino-page-wrapper .casino-menu .submenu li {
                display: block;
                height: 60px;
            }

            @media (min-width: 992px) .submenu>li {
                float: left;
                display: inline-block;
            }

                @media (min-width: 992px) .navbar-nav>li {
                    float: left;
                }

                    .casino-page-wrapper .casino-menu .submenu li a {
                        position: relative;
                        display: block;
                        height: 60px;
                        font-size: 14px;
                        color: #fff;
                        padding: 10px 10px;
                        text-transform: uppercase;
                    }

                    .casino-page-wrapper .casino-menu .submenu .active a {
                        background: #0f853d;
                        color:#fff !important;
                    }

                    .casino-page-wrapper .casino-menu .submenu li:hover a{
                        background: #0f853d;
                        color:#fff;
                    }

                    @media (min-width: 992px) .submenu>li>a {
                        width: auto !important;
                        background: transparent;
                        line-height: 30px;
                        height: 26px;
                        padding-top: 0;
                        padding-bottom: 0;
                        margin: 0;
                        padding: 0 0px;
                        color: #fff;
                        display: inline-block;
                    }

                        @media (min-width: 992px) .navbar-nav>li>a {
                            padding-top: 16px;
                            padding-bottom: 16px;
                        }

                            @media (max-width: 992px)
                                .casino-menu-mobile {
                                    font-size: 17px;
                                    color: #fff;
                                    height: 50px;
                                    top: 96px;
                                    left: 0;
                                    right: 0;
                                    position: fixed;
                                    z-index: 1005;
                                    min-width: 320px;
                                    background-color: #0f853d;
                                }

                                #main-panel {
                                    background: none  !important;
                                }

                                #main-panel #main-center {
                                    background: none  !important;
                                        
                                }

                                #main-panel h2 {
                                    padding-top: 30px;
                                    color: #1a6364;
                                    font-weight: 700;
                                }

                                #main-panel h2 a {
                                    color: #1a6364 !important;
                                    font-size: 20px;
                                    font-weight: 500;
                                    text-transform: uppercase;
                                }

                                .fullgamename {
                                    position: relative;
                                    width: 100%;
                                    text-align: center;
                                    color:#fff;
                                    line-height: 30px;
                                    bottom: 0;
                                    background-color: #0f853d;

                                }

                                .casino-image img {
                                    width: 100%;
                                    border: 1px solid #0f853d;
                                }
                                

                                .center-container{
                                    width:100%;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                }

                                .center-container > .row{
                                    width:100%;
                                    margin-top:25px !important;
                                    display: flex !important;
                                    flex-direction: row !important;
                                    column-gap:10px;
                                    align-items: center !important;
                                    justify-content: center !important;
                                    flex-wrap: wrap !important;
                                }
                                
    .games-container{
        display: flex;
        flex-direction: column;
        padding:50px;
        width: calc(100% - 0px);
        align-items: center;
        justify-content: center;
    }
    
    .games-container > .searchmenu{
        display: flex;
        flex-direction: row;
        width: 95%;
        height:60px;
        background: rgb(6,66,35);
        background: linear-gradient(90deg, rgba(6,66,35,1) 0%, rgba(50,63,85,1) 0%, rgba(19,96,61,1) 100%);
        border-radius: 15px 15px 0px 0px;
        align-items:space-between;
        justify-content: space-between;
        text-transform:capitalize;
        box-shadow:0px 0px 5px #080808;
    }
    
    .games-container > .searchmenu > .justsaglayiciNshortcuts{
        display: flex;
        flex-direction: row;
        column-gap:20px;
        row-gap:20px;
        overflow-y:auto;
        align-items:center;
        width:100%;
    }
 
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container{
        margin-top: auto;
        margin-bottom: auto;
        display: inline-block;
        flex-direction: row;
        align-items:center;
        justify-content: center;
        background:none;
        color:#AFC1B4;
        font-size:1.5em;
        font-weight:normal;
        padding:0px 30px;
        height:100%;
        border-radius:15px;
    }
    .games-container > .searchmenu  > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-btn{
        margin-top: auto;
        margin-bottom: auto;
        display: flex;
        flex-direction: row;
        column-gap:10px;
        row-gap:10px;
        align-items:center;
        height:100%;
        width:100%;
        cursor:pointer;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-listdrop{
        margin-left:-30px;
        border-radius:0px 0px 15px 15px;
        display: none;
        position: absolute;
        background:#2E4052;
        width:calc(470px - 32px);
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-listdrop > #listDropFlexBox{
        width:100%;
        height:100%;
        
        display:flex;
        flex-direction:row;
        column-gap:10px;
        row-gap:10px;
        flex-wrap:wrap;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-listdrop > #listDropFlexBox > .saglayiciNameMenu{
        display:flex;
        flex-direction:row;
        row-gap:10px;
        column-gap:10px;
        align-items:center;
        width:47%;
        cursor:pointer;
        padding:10px 20px;
        background:rgba(0.1, 0.1, 0.1, 0.3);
        border-radius:5px;
        font-size:0.8em;
        outline:1px solid #444444;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-listdrop > #listDropFlexBox > .saglayiciNameMenu:hover{
        filter:brightness(1.3);
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-listdrop > #listDropFlexBox > .saglayiciNameMenu > img{
        z-index:9;
        width:15px;
        height:15px;
    }

    .games-container > .searchmenu > .justsaglayiciNshortcuts > .shortcuts-container{
        display: flex;
        flex-direction: row;
        row-gap: 10px;
        column-gap: 10px;
        align-items:center;
        justify-content:center;
        width:100%;
        height:100%;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .shortcuts-container > .a-shortcut{
        display: flex;
        flex-direction: row;
        row-gap: 10px;
        column-gap: 10px;
        align-items:center;
        color:#AFC1B4;
        font-size:1.5em;
        font-weight:normal;
        padding:10px 40px;
        cursor:pointer;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .shortcuts-container > .a-shortcut:hover{
        background:#3C655A;
        border-radius:10px;
        transition:all 0.3s ease;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .shortcuts-container > .active{
        background:#3C655A;
        border-radius:10px;
    }
   

    .games-container > .searchmenu > .searchbar-container{
        display: flex;
        flex-direction: row;
        row-gap: 20px;
        column-gap: 20px;
        align-items:center;
        justify-content: space-around;
        padding:0px 30px;
        height:100%;
    }
    .games-container > .searchmenu > .searchbar-container > #searchbar_game{
        background: #3C655A;
        border:none;
        outline:none;
        height:40px;
        color:#AFC1B4;
        border-radius:10px;
        padding:15px 20px;
        font-size:1.5em;
        font-weight:normal;
        outline:1px solid #999999;
    }
    
    .games-container > h2{
        text-align:center;
        padding:25px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .games-container > .games-types{
        display: flex;
        flex-direction: column;
        width:100%;
        height:100%;
        align-items: center;
        justify-content: center;
    }
    
    .games-container > .games-types > .games-forcenter{
        display: flex;
        flex-direction: row;
        flex-wrap:wrap;
        row-gap: 20px;
        column-gap: 20px;
        width:auto;
        height:100%;
        align-items: center;
        justify-content: center;
    }
    .games-container> .games-types > .games-forcenter > .casino-image{
        padding-top:10px;
        background: white;
        display: flex;
        flex-direction: column;
        width: 325px;
        max-width:325px;
        height: 100%;
        align-items:center;
        border-radius:10px;
        box-shadow:1px 1px 5px #080808;
        transition: all 0.2s ease;
    }
    .games-container> .games-types > .games-forcenter > .casino-image:hover > img{
        transition: all 0.2s ease;
        transform: scale(1.1);
        cursor:pointer;
    }
    .games-container > .games-types > .games-forcenter > .casino-image > img{
        transition: all 0.2s ease;
        width: calc(100% - 10px);
        height:calc(100% - 50%);
        border-radius:10px;
    }
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data{
        display: flex;
        flex-direction: column;
        padding:10px;
        background:white;
        width:calc(100%);  
        border-radius:10px;
        align-items:center;
    }
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data > .game-info{
        padding-top:15px;
        display: flex;
        flex-direction: column;
        width:100%;
        row-gap: 5px;
    }
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data > .game-info > .game-name{
        color: #080808;
        font-size:1.5em;
        font-weight: bold;
    }
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data > .game-info > .game-section{
        color: #151515;
        font-size:1.1em;
        font-weight: normal;
    }
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data > .play-btn{
        position:absolute;
        margin-top:-25px;
        cursor:pointer;
        padding:6px;
        background: white;
        color: #0F843D;
        font-size:2em;
        font-weight: bold;
        border-radius:50%;
    }
    
    @media only screen and (max-width: 1000px) {
        
      .games-container{
        padding:5px;
        width: calc(100%);
    }  
    
    .games-container > .searchmenu{
        width:100%;
        height:150px;
        flex-direction:column;
        border-radius:0px;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts{
        height:100px;
        border-bottom:1px solid #080808;
        padding-bottom:5px;
    }
    .games-container > .searchmenu > .justsaglayiciNshortcuts > .saglayici-container > .saglayici-listdrop{
        width:calc(90% - 32px);
    }
    .games-container > .searchmenu > .searchbar-container{
        height:100px;
        padding:10px 0px;
    }
    .games-container > .searchmenu > .searchbar-container > #searchbar_game{
        width:calc(100% - 150px);
    }
    .games-container > .games-types > .games-forcenter{
        row-gap: 10px;
        column-gap: 10px;
        padding:0px;
        width: calc(100% - 10px);
    }    
    .games-container > .games-types > .games-forcenter > .casino-image{
        font-size:0.8em !important;
        width: 47%;
        height: 100%;
    }  
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data{
        flex-direction: column;
        column-gap:5px;
        row-gap:5px;
       
    }
    .games-container > .games-types > .games-forcenter > .casino-image > .game-data > .play-btn{
        margin-top:-25px;
    }
    

}

    </style>

{/literal}


<section id="main" class="sportsbook_padding newCasino">



    <div id="large-slider" class="carousel slide mobile-casino" data-ride="carousel" style="border-radius:20px; margin-top:50px; width:88% !important;">
        <ol class="carousel-indicators">
            {php}$i = 0;{/php}
            {foreach from="$casino_banners" item="banner" key="key"}
                <li data-target="#large-slider" data-slide-to="{php}echo $i;{/php}" class="{php} if ($i == 0) { echo "active";} {/php}"></li>
                {php}$i++;{/php}
            {/foreach}
        </ol>
        <div class="carousel-inner" role="listbox">
            {php}$i = 0;{/php}
            {foreach from="$casino_banners" item="banner" key="key"}
            <div class="item {php} if ($i == 0) { echo "active";} {/php}" data-bgcolor="">
            <a href="" target="">
                <img alt="" src="{php}echo $banner->path;{/php}" style="border-radius:20px;">
            </a>
            <div class="carousel-caption container banner-caption">
                <div class="col-xs-offset-1 col-sm-offset-0 col-xs-6 col-ms-offset-2">
                    <div class="bordered-text" style="display: none">
                        <h2><span>{php}echo $banner->text;{/php}</span></h2>
                    </div>
                    <div class="caption-slide-message" >
                        <div class="caption-slide-message-wrp">
                            <span class="message-span" style="display: none">{php}echo $banner->description;{/php}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {php}$i++;{/php}
        {/foreach}
    </div>
    <a class="left carousel-control hidden-xs" href="#large-slider" role="button" data-slide="prev">
        <span class="glyphicon-chevron-left icon-arrow-left" aria-hidden="true"></span> <span class="sr-only">Geri</span>
    </a>
    <a class="right carousel-control hidden-xs" href="#large-slider" role="button" data-slide="next">
        <span class="glyphicon-chevron-right icon-arrow-right" aria-hidden="true"></span> <span class="sr-only">İleri</span>
    </a>
    </div>


<div class="games-container">

    <div class="searchmenu">
        
        <div class="justsaglayiciNshortcuts">
        
        <div class="saglayici-container" >
            <div class="saglayici-btn" onclick="saglayicilistOpen()" >
                <i class="fa-solid fa-bars"></i>
                <div>Sağlayıcılar</div>
                <i style="font-size:0.6em;" class="fa-solid fa-angle-down"></i>
            </div>
            
            <div class="saglayici-listdrop">
                
                <div style="text-align:left; padding:10px; font-weight:bold; color:indianred; cursor:pointer;" onclick="saglayicilistOpen()" ><i class="fa-solid fa-xmark"></i></div>
                
                <div id="listDropFlexBox">
                {php}
                $saglayiciArray = array();
                foreach ($list as $key => $games) {
                foreach ($games as $gamekey => $game) { {/php}
                {php}
                    $game_sectionVAR = str_replace("_", " ", $game['game_section']);
                    $saglayiciName = ucwords($game_sectionVAR);
                    //echo $saglayiciName;
                    
                    array_push($saglayiciArray, $saglayiciName);
                }
                }
                
                $saglayiciArray = array_unique($saglayiciArray);

                foreach ($saglayiciArray as $key => $value) {
                if ($key > 0);
                $imgFormat = str_replace(" ", "_", $value);
                $imgFormat = strtolower($imgFormat);
                 echo "<span class='saglayiciNameMenu' onClick='saglayiciBul(this.id)' id='".$value."' > <img src='https://cdn.iyzigaming.com/media/the-dark/providers_icons/".$imgFormat.".png' alt='".$value." Logo'> ".$value."</span>";
                }
                {/php}
                </div>
                
            </div>
            
        </div>    
        <div class="shortcuts-container">
            <div class="a-shortcut active" id="Btn_AllGames" onClick="Btn_AllGamesFunc()">
                <i class="fa-solid fa-border-all"></i> 
                Tümü
            </div>
            <div class="a-shortcut" id="Btn_PopularGames" onClick="Btn_PopularGamesFunc()">
                Popüler Oyunlar
            </div>
        </div>
        
         </div>
         
         
        <div class="searchbar-container">
            
                <i style="color:#d4af37; font-size:2em; cursor:pointer;" onClick="saglayicilistOpen()" class="fa-solid fa-coins"></i>
                <input type="text" id="searchbar_game" onkeyup="ara()" placeholder="Ara..." title="Oyun Ara...">
                <i style="color:indianred; font-size:2em; cursor:pointer;" onClick="ThrashSearch()" class="fa-solid fa-trash"></i>
                
        </div>
    </div>
    

    <h2 id="PageGameTitle_h2" >
        Tüm Slot Oyunları
    </h2>
    
    <div class="games-types allgamemain">
        
    <div class="games-forcenter" id="LoadMoreGame">

    {php}
        foreach ($list as $key => $games) {
    
        foreach ($games as $gamekey => $game) { 
        
    {/php}
        
        <div class="casino-image">
            <img onclick="openHogaming({$gamekey})" src="{php}echo $game['game_image'];{/php}">
            <div class="game-data">

                <div class="game-info">
                    <div class="game-name">
                        {php}echo $game['game_name'];{/php} 
                    </div>
                    <div class="game-section" id="game_sectionID">
                        {php}
                        $game_sectionVAR = str_replace("_", " ", $game['game_section']);
                        $saglayiciName = ucwords($game_sectionVAR);
                        echo $saglayiciName;
                        {/php} 
                    </div>
                </div>

                <i class="play-btn fa-solid fa-circle-play"></i>
            </div>
        </div>
        {php} }
        } {/php}
        
    </div>
    </div>
    
    <div style="display:none;" class="games-types populargamemain">
    
    <div class="games-forcenter">
        {php}
        foreach ($list as $key => $games) { 
    
        foreach ($games as $gamekey => $game) { 
        
        if (
        $game['game_name'] == "Madame Destiny" OR 
        $game['game_name'] == "Ancient Egypt Classic" OR 
        $game['game_name'] == "Gates of Olympus" OR 
        $game['game_name'] == "Sweet Bonanza" OR 
        $game['game_name'] == "Sweet Bonanza Xmas" OR
        $game['game_name'] == "The Dog House" OR
        $game['game_name'] == "Fruit Party" OR
        $game['game_name'] == "Big Bass Bonanza" OR
        $game['game_name'] == "Christmas Big Bass Bonanza" OR
        $game['game_name'] == "Starlight Princess" OR
        $game['game_name'] == "Book of the Fallen"){
        {/php}
        
        <div class="casino-image" onclick="openHogaming({$gamekey})">
            <img src="{php}echo $game['game_image'];{/php}">
            <div class="game-data">

                <div class="game-info">
                    <div class="game-name">
                        {php}echo $game['game_name'];{/php} 
                    </div>
                    <div class="game-section" id="game_sectionID">
                        {php}
                        $game_sectionVAR = str_replace("_", " ", $game['game_section']);
                        $saglayiciName = ucwords($game_sectionVAR);
                        echo $saglayiciName;
                        {/php} 
                    </div>
                </div>

                <i class="play-btn fa-solid fa-circle-play"></i>
            </div>
        </div>
        {php} } } {/php}
    
    
    {php} } {/php}
    </div>
    </div>
    
    
</div>


    </div>

</section>
{php} include "content/dark-theme/view/dark_footer.php";{/php}