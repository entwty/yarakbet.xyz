<?php  include "content/dark-theme/view/dark_header.php"; ?>

    <script>
        function numberControl(e) {
            olay = document.all ? window.event : e;
            tus = document.all ? olay.keyCode : olay.which;
            if(tus<48||tus>57) {
                if(document.all) { olay.returnValue = false; } else { olay.preventDefault(); }
            }
        }

        $(document).ready(function() {
            $('#time').mask('00:00', {
                placeholder: '__:__'
            });

        });
    </script>


<div class="remodal" data-remodal-id="bitcoin" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
    <div>
        <p id="modal1Desc">
            <span id="btciframe"></span>
        </p>
    </div><br>
    <button data-remodal-action="confirm" class="remodal-confirm">KAPAT</button>
</div>

<div class="remodal" data-remodal-id="qrcode" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
    <h2 id="modal1Title" style="font-size: 20px;">PARA YATIRMA TALEBİNİZ, İNCELENMEK ÜZERE KAYIT EDİLMİŞTİR.</h2>
    <div><span id="qrframe"></span></div>
</div>

<div class="navbar-title visible-sm visible-xs">
    <button type="button" class="navbar-toggle toggle-left" data-toggle="sidebar" data-target=".sidebar-left"> <i class="icon-menu"></i> </button>
    <a class="page-title"><i class="icon-wallet"></i>PARA YATIR</a>
</div>


<section id="main" class="" style="">
    <div class="container">
        <div id="main-panel" class="row have-sidebar-left">
            <div id="main-left" class="sidebar sidebar-left sidebar-animate sidebar-md-show nano has-scrollbar">

                <?php  include "content/dark-theme/view/sidebar.php"; ?>

                <div class="nano-pane" style="display: none;">
                    <div class="nano-slider" style="height: 484px; transform: translate(0px, 0px);"></div>
                </div>
            </div>


            <div id="main-center" style="min-height: 500px">
                <div class="center-container">
                    <div class="panel panel-white no-padding-sm">
                        <div class="panel-heading">
                            <h2>
                                <i class="icon-wallet"></i> Para Yatır
                            </h2>
                        </div>

                        <div class="panel-group panel-collapse" id="acc-accordion">
                            <div class="panel panel-default">

                                <div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapse3" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/1.png" class="withdrawico">
                                    <h4>BANKA HAVALESİ İLE PARA YATIRMA</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapse3" style="height: 0px;">

                                    <div class="panel-footer for-validation">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Banka Adı
                                                        <small></small>
                                                    </label>
                                                    <select class="form-control" id="bank" >
                                                        <option value="0">Banka Seçiniz</option>
                                                        <?php foreach($bankalar as $a => $det){ ?>
                                                            <option value="<?php if(isset($det["id"])) { echo $det["id"];}?>"><?php if(isset($det["banka"])) { echo $det["banka"];}?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="money" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row bwt-details">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="namesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="bankDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsePAPARA" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/paparalogo.jpg" class="withdrawico">
                                    <h4>PAPARA İLE PARA YATIRMA (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsePAPARA" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="paparanamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="paparamoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=1" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="paparaDeposit();" >											
                                            PARA YATIR										
                                            <i class="icon-arrow-right"></i>
											</a> 
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                
                                <!--- <div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsepayfix" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/payfix.png" class="withdrawico">
                                    <h4>PAYFİX İLE PARA YATIRMA (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsepayfix" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="payfixnamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="payfixmoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a a style="color:#1a2732;" href="#" target="_blank">PAYFİX İLE NASIL YATIRIM YAPARIM ?</a>
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=2" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="payfixDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div> --->
                                
                                <!--- <div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsecmt" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/cmtc.png" class="withdrawico">
                                    <h4>CMT CÜZDAN İLE PARA YATIRMA (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsecmt" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="cmtnamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="cmtmoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=11" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="cmtDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div> --->

                                <!--- <div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsepeple" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/peple.jpg" class="withdrawico">
                                    <h4>PEPLE İLE PARA YATIRMA (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsepeple" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="peplenamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="peplemoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=9" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="pepleDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div> --->

								<div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsebitcoin" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/btc.jpg" class="withdrawico">
                                    <h4>BİTCOİN İLE PARA YATIRMA (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsebitcoin" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="bitcoinnamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="bitcoinmoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=6" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="bitcoinDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div> 

								<div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsetether" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/tether.jpg" class="withdrawico">
                                    <h4>USDT/TETHER İLE PARA YATIRMA (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsetether" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="tethernamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="tethermoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=7" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="tetherDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

								<div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsemefete" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/mefete.jpg" class="withdrawico">
                                    <h4>MEFETE (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsemefete" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="mefetenamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="mefetemoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=8" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="mefeteDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

								<div class="panel-heading show collapsed" data-toggle="collapse" data-parent="#acc-accordion" href="#collapsejeton" aria-expanded="false" style="text-align: left;">
                                    <img src="/images/footer_partners/payment/jeton.jpg" class="withdrawico">
                                    <h4>JETON (MANUEL)</h4>
                                    <i class="pull-right icon-arrow-down"></i>
                                </div>
                                <div class="panel-collapse collapse" id="collapsejeton" style="height: 0px;">
                                    <div class="panel-footer for-validation">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        İsim Soyisim
                                                        <small></small>
                                                    </label>
                                                    <input class="form-control" id="jetonnamesurname" value="<?php if(isset($bilgi["name"])) { echo $bilgi["name"];}?>" type="text" readonly="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="amount">Tutar</label>
                                                    <div class="input-group">
                                                        <input class="form-control" id="jetonmoney" data-validation="acg" type="text" onkeypress="numberControl(event)">
                                                        <span class="input-group-addon">TL</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
										<a href="https://pay.betabahis.tech/para-yatir?id=<?php echo $bilgi['id']; ?>&method=12" target="_blank"
                                        button class="btn btn-primary btn-lg btn-sm-wide pull-right btn-icon submit-btn" onclick="jetonDeposit();">
                                            PARA YATIR
                                            <i class="icon-arrow-right"></i>
											</a>
                                        </button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
								

                        </div>
                    </div>
                </div>

            </div>

            <div class="main-overlay"></div>
        </div>
    </div>

</section>
<?php  include "content/dark-theme/view/dark_footer.php"; ?>