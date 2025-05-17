<!DOCTYPE html>
<html>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title><?php echo SITE_NAME;?> | Canlı Bahis ve Casino Oyunları.</title>
    <meta name="description" content="Spor Bahisleri, Canlı Tek Maç Bahisi, Casino, Slot Oyunlar, Avrupa'nın En Yüksek Oranları ile Güvenilir Bahis Sitesi <?php echo SITE_NAME;?>">
    <meta name="keywords" content="canlı Bahis, bahis, canlı poker, canlı casino , slot oyna, gates of olympus, canlı bahis oyna, Betabahis, beta, betabet bet, deneme bonusu veren siteler">
    <script type="text/javascript" language="javascript" src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/functionsv1.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <script type="text/javascript" src="/assets/js/datatable.js"></script>
    <link href="/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <script data-turbolinks-track="true" src="/assets/theme15/mainv2.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/assets/css/css/font-awesome.min.css">
    <script type="text/javascript" src="/assets/js/bettingv11.js"></script>
    <link rel="stylesheet" href="/assets/css/css/alert.css" />
    <script type="text/javascript" src="/assets/js/alert.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js'></script>
    <link data-turbolinks-track="true" href="/assets/theme15/v3.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/remodal/remodal.css">
    <script src="/assets/css/remodal/remodal.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-sticky.js"></script>
    <script type="text/javascript">$(document).ready(function() {$('#navbar-menu2').scrollToFixed();});</script>
	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/theme15/iconx.css">
	
	<script src="https://kit.fontawesome.com/0ad51be6a4.js" crossorigin="anonymous"></script>
	
	


</head>

<body class="welcome-theme">
    <nav id="navbar" class="navbar navbar-default ">
    <?php if (empty($_SESSION['username'])) { ?>
            <div class="navbar-menu1">
            <div class="container">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-menu"> <i class="icon-menu"></i> </button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-acc"> <i class="icon-head"></i> </button>
                    <a class="navbar-brand" href="/"> <img height="50" src="/uploads/logo/logo.png"  width="150" style="
    height: auto;
"> </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-acc">
                    <form class="navbar-form navbar-right" id="headerGirisForm">
                        <div class="form-group form-icon ">
                            <i class="icon-head"></i>
                            <input class="clientInput form-control input-lg radiusx" name="username" placeholder="Kullanıcı Adı" type="text" autocomplete="off">
                        </div>
                <div class="form-group form-icon">
                            <i class="icon-key"></i>
                            <input class="passwordInput form-control input-lg radiusx" name="password" placeholder="Şifre" type="password" autocomplete="off">
                </div>
                <span class="sep">
                            <button class="btn btn-default loginbutton user-action " data-action="login" data-form="headerGirisForm" style="color:#fff;"> Giriş Yap </button>
                            <a href="/signin" class="btn btn-default loginbutton">Kayıt Ol</a>

                        <a href="/resetpassword/forget"><span class="sep" style="padding-right: 20px;" title = "Şifremi Unuttum"><span class="sep mobilehide" style="color:#fff;">Şifremi unuttum</span><i class="fa fa-question-circle newicon mobile-hide" aria-hidden="true" style="color:#ffffff;font-size: 36px;margin-right:8px;padding-top: 0px !important;position: absolute;"></i></span></a>
&nbsp;
						<a href="#" target="_blank" title="Canlı Destek"><span class="sep mobile-hide"><img style="filter:hue-rotate(180deg) invert(1);" src="/uploads/icon/support.png" width="36" height="36"></span></a>
						
                    </form>
                </div>
            </div>

            <div class="remodal" data-remodal-id="login" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" style="background: none;">
                <div class="modal-content" style="-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-remodal-action="close" aria-label="Close"></i></button>
                        <h4 class="modal-title" style="font-size: 20px;">Giriş Yap</h4>
                    </div>
                    <div class="modal-body scrollable" >
                        <p style="font-size: 16px;">
                        <form class="" id="headerGirisForm">
                            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 mb-sm-0 logintextbox" placeholder="Kullanıcı adı" name="username">
                            <input type="password" class="form-control form-control-sm mb-2 mr-sm-2 mb-sm-0 logintextbox" placeholder="Şifre" name="password">
                            <button class="btn btn-default loginbutton user-action " data-action="login" data-form="headerGirisForm" style="width: 10%;color:#fff;"> Giriş Yap </button>
                            <a href="/signin" class="btn btn-default loginbutton" style="width: 10%;">Kayıt Ol</a>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
    <?php } else { ?>
        <script>
            $( document ).ready(function() {
                $.playgoAJAX._amount();
            });
        </script>
    <div class="navbar-menu1">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-menu"> <i class="icon-menu"></i> </button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-acc"><i class="icon-head" ></i></button>
                <a class="navbar-brand" href="/"> <img height="50" src="/uploads/logo/logo.png" width="190" /></a>
            </div>
            
            
            
            <div class="collapse navbar-collapse" id="navbar-collapse-acc" style="max-height: 924px;">
                <div class="navbar-form navbar-acc navbar-right">
                    <span class="sep pull-right hidden-xs hidden-sm"><a href="/sports/logout" class="btn btn-link btn-lg btn-icon btn-out">ÇIKIŞ<i class="icon-lock"></i></a></span>
                    <span class="sep pull-right">
                        <div class="btn-group popover-check">
                        <button type="button" class="btn btn-link btn-lg btn-icon" data-toggle="dropdown"><a class="username" style="color:#fff;"><?php echo $bilgi['username']; ?> </a><i class="icon-arrow-down"></i></button>
                        <ul class="dropdown-menu">
                            <li><a href="/myaccount"><i class="icon-settings2"></i>Hesabım</a></li>
                            <li><a href="/myaccount/transactions"><i class="icon-stats"></i>Hesap Hareketleri</a></li>
                            <li><a href="/myaccount/coupons"><i class="icon-menu"></i>Bahis Geçmişi</a></li>
                            <!--- <li><a href="/myaccount/transfer"><i class="icon-transactions"></i>Transfer</a></li> --->
                            <li><a href="/myaccount/deposit"><i class="icon-wallet"></i>Para Yatır</a></li>
                            <!--- <li><a href="https://pay.beta.com/para-yatir?id=<?php echo $bilgi['id']; ?>"> <i class="icon-wallet"></i>Para Yatır</a></li> --->
                            <li><a href="/myaccount/withdraw"><i class="icon-money"></i>Para Çek</a></li>
                            <li class="hidden-md hidden-lg"><a href="/sports/logout"><i class="icon-lock"></i>Çıkış Yap</a></li>
                        </ul>
                        </div>
                    </span>

                    <div class="input-group tongue money">

                        <span class="input-group-addon popover-check">
                            <label id="balance"><span class="balance"><?php echo nf($bilgi['bakiye']); ?> <i class='fa fa-try'></i> </span>  <i class='fa fa-refresh balance-refresh user-action' data-action="balanceUpdate" ></i></label>
                        </span>
                        <span class="input-group-btn"><a href="/myaccount/deposit"" type="button" class="btn btn-info btn-lg btn-icon" >PARA YATIR<i class="icon-wallet"></i></a></span>
                        
                        <!--- <span class="input-group-btn"><a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>" type="button" class="btn btn-info btn-lg btn-icon" target="_blank">PARA YATIR<i class="icon-wallet"></i></a></span> --->
                        <span class="input-group-btn" style="padding-left: 10px !important;"><a href="/myaccount/coupons" type="button" class="btn btn-primary btn-lg btn-icon">BAHİS GEÇMİŞİ<i class="icon-betslip"></i></a></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
      </div>
    </div>
    <?php } ?>

<?php
$pageUrl = $_SERVER['REQUEST_URI'];
if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])) {
    $mobile = 1;
} else $mobile = 0;
?>
    <nav id="navbar-menu2">
    <div class="navbar-menu2">
        <div class="container">
            <div class="collapse navbar-collapse propogate" id="navbar-collapse-menu">
                <ul class="nav navbar-nav navbar-collapse navbar-center" style="max-height: 585px;">
                    <li><a class="hvr-sweep-to-bottom " href="/" ><i class="fa-solid fa-house"></i> Anasayfa</a></li>
                    <li><a class="hvr-sweep-to-bottom " href="/sports"><i class="fa-solid fa-futbol"></i> Spor Bahisleri</a></li>
                    <li><a class="hvr-sweep-to-bottom " href="/live"><i class="fa-solid fa-satellite-dish"></i> Canlı Bahisler</a></li>
                    <li><a class="hvr-sweep-to-bottom " href="/LiveCasino/Slot"><i class="fa-solid fa-chess-king"></i> Casino</a></li>
                    <li><a class="hvr-sweep-to-bottom " href="/GameLoby">    <i class="fa-solid fa-dice"></i> Canlı Casino</a></li>
                    <li><a class="hvr-sweep-to-bottom " href="/LiveGames"><img src="/media/icon/fly-red.png" alt="" width="16" height="16"> Aviator<span style="align:center;position:absolute;top: -7px;right: 0px;font-size:10px;color: #ffffff;width: 50px;height:14px;background-color: #d04800;border-radius: 5px;text-align:center;">Yeni</span></a></li>
                    <li><a class="hvr-sweep-to-bottom " href="/#"><i class="fa-solid fa-horse"></i> Sanal Bahisler <span style="align:center;position:absolute;top: -7px;right: 0px;font-size:10px;color: #ffffff;width: 50px;height:14px;background-color: #d04800;border-radius: 5px;text-align:center;">Yeni</span></a></li>
                    <!--<li><a class="hvr-sweep-to-bottom " href="/LiveCasino/Slot#Table%20Games"><img src="/img/ikon/dices-alt.png" alt="" width="16" height="16"> MASA OYUNLARI <span style="align:center;position:absolute;top: -7px;right: 0px;font-size:10px;color: #ffffff;width: 30px;height:14px;background-color: #0F853D;border-radius: 5px;text-align:center;">YENİ</span></a></li>-->
                    <li><a class="hvr-sweep-to-bottom " href="/home/Promotions"><i class="fa-solid fa-percent"></i> Promosyonlar</a></li>
                </ul>
            </div>
        </div>
    </div>
    </nav>
</nav>

