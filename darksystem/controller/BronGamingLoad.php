<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
class BronGamingLoad extends controller {
    function __construct() {
        parent::controller();


    }

    function index() {

    }

    function replaceSpace($string) {
        $string = preg_replace("/\s+/", " ", $string);
        $string = trim($string);
        return $string;
    }

    function sportIdChange($code) {
        $sportCode = [
            0 => 1, // Futbol
            12 => 2, // Basketbol
            88 => 2, // Basketbol
            20 => 100, // Amerikan Futbolu
            359 => 100, // Amerikan Futbolu
            4 => 101, // Tenis 
            351 => 101, // Tenis
            26 => 102, // Avustralya Futbolu
            35 => 103, // Badminton
            360 => 103, // Badminton
            22 => 104, // Bandy
            13 => 105, // Beyzbol
            363 => 105, // Beyzbol
            11 => 106, // Boks
            64 => 107, // Bowls
            365 => 107, // Bowls
            16 => 108, // Buz Hokeyi
            352 => 108, // Buz Hokeyi
            9 => 109, // Dart
            367 => 109, // Dart
            66 => 110, // E-Sports
            364 => 110, // E-Sports
            18 => 111, // Floorball
            17 => 112, // Hentbol
            353 => 112, // Hentbol
            31 => 113, // Kriket
            355 => 113, // Kriket
            34 => 114, // Masa Tenisi
            361 => 114, // Masa Tenisi
            5 => 115, // Ragbi
            357 => 115, // Ragbi
            23 => 116, // Salon Futbolu
            358 => 116, // Salon Futbolu
            19 => 117, // Voleybol
            356 => 117, // Voleybol
            6 => 118, // Snooker
            354 => 118, // Snooker
            

        ];
        return (isset($sportCode[$code])) ?  $sportCode[$code] : $code;
    }

    function BronResult() {
       
        $coupons = $this->db->result("SELECT * FROM kupon_mac WHERE sonuc = 0 && oran != 1");
        foreach ($coupons as $coupon) {
               $list[] = [
                   "id" => $this->replaceSpace($coupon['id']),
                   "sport_id" => $this->replaceSpace($coupon['sport_id']),
                   "match_id" => $this->replaceSpace($coupon['mackodu']),
                   "type" => $this->replaceSpace($coupon['tur']),
                   "description" => $this->replaceSpace($coupon['aciklamasi']),
                   "score" => $this->replaceSpace($coupon['skor']),
                   "date" => $this->replaceSpace($coupon['tarih']),
               ];
        }


        $ch = curl_init('https://betsapi.tech/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($list));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($list)))
        );
        $result = curl_exec($ch);

        $data = json_decode($result);

        foreach ($data as $key => $coupon) {
            $coupon_id = $key;
            $coupon_message = $coupon->result->Message;
            $coupon_code = $coupon->result->Code;

            if ($coupon_code == 1) { $this->db->update("kupon_mac", array("sonuc" => 1), array("id" => $coupon_id )); }
            elseif ($coupon_code == 2) { $this->db->update("kupon_mac", array("sonuc" => 2), array("id" => $coupon_id )); }

            if ($coupon_code == 5) { $this->db->update("kupon_mac", array("result" => 0), array("id" => $coupon_id )); }
            else if ($coupon_code == 4) { $this->db->update("kupon_mac", array("result" => 0), array("id" => $coupon_id )); }
            else { $this->db->update("kupon_mac", array("result" => 1), array("id" => $coupon_id )); }
        }

        echo $result;

    }

    function CouponResult() {

        $kuponlar = $this->db->result("SELECT * FROM kupon WHERE durum = 0");


        $tarih = date('Y-m-d H:i:s');

        foreach ($kuponlar as $kupon) {
            $kupon_db = $this->db->result("SELECT * FROM kupon_mac WHERE kuponid = '".$kupon['id']."'");
            $kaybetti   = 0;
            $kazandi    = 0;
            $bekliyor   = 0;
            $kupon_toplam_mac = count( $kupon_db );
            foreach ($kupon_db as $kupon_mac) {

                /* if ( $kupon_mac['sonuc'] == 0 ) { $kuponmacdurum = '<span style="color:#FF7F00">Bekliyor</span>'; }
                elseif ( $kupon_mac['sonuc'] == 1 ) { $kuponmacdurum = '<span style="color:#238C00">Kazandı</span>'; }
                elseif ( $kupon_mac['sonuc'] == 2 ) { $kuponmacdurum = '<span style="color:#D90000">Kaybetti</span>'; } */

                // Kaybetti
                if ( $kupon_mac['sonuc'] == '2' ) {
                    $kaybetti++;
                }

                if ( $kupon_mac['sonuc'] == '1' ) {
                    $kazandi++;
                }

                if ( $kupon_mac['sonuc'] == '3' ) {
                    $kazandi++;
                }

                if ( $kupon_mac['sonuc'] == '0' ) {
                    $bekliyor++;
                }

                //echo '-> macID: '. $kupon_mac[ 'macid' ] . " - kuponTur: " . $kupon_mac['tur'] . " - oran: " . $kupon_mac['oran'] . " - ". $kuponmacdurum . " [ ".$kupon_mac['sonuc']." ]<br />";
            }

            if ( $kaybetti > 0 ) {
                $kupondurum = '<span style="color:#FF7F00">Kaybetti</span>';
                $kupondurumstatu = 2;
            } else if ( $kaybetti == 0 AND $kazandi == 0 ) {
                $kupondurum = '<span style="color:#FF7F00">Bekleyen</span>';
                $kupondurumstatu = 0;
            } else if ( $kazandi == $kupon_toplam_mac ) {
                $kupondurum = '<span style="color:#FF7F00">Kazandi.</span>';
                $kupondurumstatu = 1;
            } else {
                $kupondurumstatu = 0;
                $kupondurum = '<span style="color:#FF7F00">Bekleyen</span>';
            }

            $userfind = $this->db->result("SELECT bakiye FROM admin WHERE id = '".$kupon['userid']."' ");

            if ( $kupondurumstatu == 2 ) {
                $this->db->update("kupon", array("durum" => $kupondurumstatu), array("id" => $kupon['id']));

                $this->db->insert("log",[
                    "userid" => $kupon['userid'],
                    "islemad" => $kupon["id"]." Nolu Kupon Kaybetti.",
                    "tutar" => "0",
                    "tarih" => $tarih,
                    "oncekibakiye" => $userfind[0]['bakiye'],
                    "sonrakibakiye" => $userfind[0]['bakiye'],
                ]);

            }

            if ( $kupondurumstatu == 1 ) {
                $this->db->update("kupon", array("durum" => $kupondurumstatu), array("id" => $kupon['id']));

                // log ekle
                $this->db->insert("log",[
                    "userid" => $kupon['userid'],
                    "islemad" => $kupon["id"]." Nolu Kupon Kazandı.",
                    "tutar" => $kupon['miktar'] * $kupon['oran'],
                    "tarih" => $tarih,
                    "oncekibakiye" => $userfind[0]['bakiye'],
                    "sonrakibakiye" => $userfind[0]['bakiye'] + ( $kupon['miktar'] * $kupon['oran'] ),
                ]);

                // bakiye ekle
                $this->db->result("UPDATE admin SET bakiye = bakiye + ".$kupon['miktar'] * $kupon['oran']." WHERE id = '".$kupon['userid']."'");


            }

            if ( $kupondurumstatu == 5 ) {
                $this->db->update("kupon", array("durum" => $kupondurumstatu), array("id" => $kupon['id']));

                // log ekle
                $this->db->insert("log",[
                    "userid" => $kupon['userid'],
                    "islemad" => $kupon["id"]." Nolu Kupon İade Edildi.",
                    "tutar" => $kupon['miktar'] * $kupon['oran'],
                    "tarih" => $tarih,
                    "oncekibakiye" => $userfind[0]['bakiye'],
                    "sonrakibakiye" => $userfind[0]['bakiye'] + $kupon['miktar'] ,
                ]);

                // bakiye ekle
                $this->db->result("UPDATE admin SET bakiye = bakiye + ".$kupon['miktar']." WHERE id = '".$kupon['userid']."'");


            }


            echo '-> Sonuç: '.$kupondurumstatu.' <- Kupon: ID: ' . $kupon['id'] . ' Miktar: '.$kupon['miktar'].' ( Bekleyen: '.$bekliyor.' | Kazandi: '.$kazandi.' | Kaybeden: '.$kaybetti.') '.$kupondurum.' <br /> <hr>';

        }

    }

    function Affiliate () {
        set_time_limit(0);
        //Tarih Ayarları
        echo $tarih = date('Y-m-d',strtotime(date("Y-m-d") . "-1 days"));
        $baslangic = $tarih." 00:00:00";
        $bitis = $tarih." 23:59:00";
        $where = "&& ( UNIX_TIMESTAMP(str_to_date(tarih,'%Y-%m-%d %H:%i:%s')) >= UNIX_TIMESTAMP('$baslangic') && UNIX_TIMESTAMP(str_to_date(tarih,'%Y-%m-%d %H:%i:%s')) <= UNIX_TIMESTAMP('$bitis') )";
        $wherex = "&& ( UNIX_TIMESTAMP(str_to_date(created_at,'%Y-%m-%d %H:%i:%s')) >= UNIX_TIMESTAMP('$baslangic') && UNIX_TIMESTAMP(str_to_date(created_at,'%Y-%m-%d %H:%i:%s')) <= UNIX_TIMESTAMP('$bitis') )";

        //Kullanıcıları Çekiyoruz
        $userlist = $this->db->result("SELECT id, name, username, affiliateid, bakiye, kayit_tarih FROM admin WHERE affiliateid != 0 Order By id  asc Limit 10000");

        foreach ($userlist as $user) {
            $yatirim = $this->db->result("SELECT SUM(miktar) FROM parayatir where durum='1' && uye = '".$user['id']."' $where order by id DESC")[0];
            $cekim = $this->db->result("SELECT SUM(miktar) FROM paracek where durum='2' && uye = '".$user['id']."' $where order by id DESC")[0];
            $bonusFind = $this->db->result("SELECT SUM(tutar) FROM log WHERE ( islemad LIKE '%TL Bonus Yüklendi.%' || islemad LIKE '%Bonus Bakiyesine Yüklendi%' ) && userid = '".$user['id']."' $where")[0];

            $darkbahis = $this->db->result("SELECT (SELECT SUM(miktar) FROM kupon where userid = '".$user['id']."' $where order by id DESC) AS ToplamKupon,
                                                   (SELECT SUM(miktar) FROM kupon where durum = '0' && userid = '".$user['id']."' $where order by id DESC) AS BekleyenKupon,
                                                   (SELECT SUM(odeme) FROM kupon where durum = '1' && userid = '".$user['id']."' $where order by id DESC) AS KazananKupon,
                                                   (SELECT SUM(miktar) FROM kupon where durum = '2' && userid = '".$user['id']."' $where order by id DESC) AS KaybedenKupon,
                                                   (SELECT SUM(miktar) FROM kupon where durum = '3' && userid = '".$user['id']."' $where order by id DESC) AS IadeKupon
            ")[0];

            echo $user['username']."<br>";
            print_r($darkbahis);



            $userid = $user['id'];
            $name = $user['name'];
            $username = $user['username'];
            $affiliateid = $user['affiliateid'];
            $kayit_tarih = $user['kayit_tarih'];

            $userDeposit = $yatirim['SUM(miktar)'];
            $userWithdraw = $cekim['SUM(miktar)'];
            $userBonus = $bonusFind['SUM(tutar)'];

            $totbahis = $darkbahis['ToplamKupon'];
            $bekbahis = $darkbahis['BekleyenKupon'];
            $kazbahis = $darkbahis['KazananKupon'];
            $kaybahis = $darkbahis['KaybedenKupon'];
            $iadbahis = $darkbahis['IadeKupon'];

            $varmi = $this->db->aresult("select * from affiliate where userid='$userid' and date='$baslangic' ");

            if ($varmi["id"]) {
                $userUpdate = $this->db->update("affiliate", array(
                    "betTotal" => round($totbahis,2),
                    "betPending" => round($bekbahis,2),
                    "betWon" => round($kazbahis,2),
                    "betLost" => round($kaybahis,2),
                    "betReturn" => round($iadbahis,2),
                    "financeDeposit" => round($userDeposit,2),
                    "financeWithdraw" => round($userWithdraw,2),
                    "Bonus" => round($userBonus,2),
                ), array("userid" => $userid, "date" => $tarih." 00:00:00"));
                if ($userUpdate) { echo "$userid | $baslangic | Kayıt Güncellendi.</br>"; }
            }else {
                $userAdd = $this->db->insert("affiliate", array(
                    "userid" => $userid,
                    "name" => $name,
                    "username" => $username,
                    "affiliateid" => $affiliateid,
                    "registration" => $kayit_tarih,
                    "date" => $baslangic,
                    "betTotal" => round($totbahis,2),
                    "betPending" => round($bekbahis,2),
                    "betWon" => round($kazbahis,2),
                    "betLost" => round($kaybahis,2),
                    "betReturn" => round($iadbahis,2),
                    "financeDeposit" => round($userDeposit,2),
                    "financeWithdraw" => round($userWithdraw,2),
                    "Bonus" => round($userBonus,2)
                ));
                if ($userAdd) { echo "$userid | $baslangic | Kayıt Eklendi.</br>"; }
            }
        }
    }

    function PreMatch() {
    // Veritabanı ayarlarını al
    $odds_settings = $this->db->result("SELECT * FROM settings WHERE `key` = 'pre_odds' ");
    $odds_percent = $odds_settings[0]['value'];
    $odds_data = json_decode($odds_percent);
    $operation = $odds_data[0];
    $percent = $odds_data[1];
    $host = $_SERVER['HTTP_HOST'];

    // betsapitechkey'i al
    $key_query = "SELECT betsapitechkey FROM odd_services LIMIT 1";
    $key_result = $this->db->result($key_query);

    if (!$key_result || count($key_result) === 0) {
        echo "Anahtar bulunamadı.";
        return;
    }

    $apiKey = $key_result[0]['betsapitechkey'];

    // API'den veri al
    $api_url = "https://betsapi.tech/api/presports.php?token=" . $apiKey;
    $kod = simplexml_load_string(file_get_contents($api_url));
    if ($kod === false) {
        echo "API'den veri alınamadı.";
        return;
    }

    shuffle($kod->Mac);

    foreach ($kod->Mac as $z) {
        $za = $z->attributes();

        $rand = rand(1, 9999);
        $veri = array();
        $veri["tarih"] = $za["baslangic"];
        $veri["pluskod"] = $za["pluskod"];
        $veri["lig"] = $za["lig_isim"];
        $veri["evsahibi"] = $za["evsahibi_isim"];
        $veri["ulke"] = $za["ulke_isim"];
        $veri["ulkeisim"] = $za["ulke_isim"];
        $veri["ulkeid"] = $za["ulke_id"];
        $veri["lig_id"] = $za["lig_id"];
        $veri["deplasman"] = $za["misafir_isim"];
        $veri["ligresim"] = $za["ligresim"];
        $veri["mackodu"] = $za["mackodu"];
        $veri["istatistik"] = $za["istatistik"];
        $veri["sistem"] = "hitit";
        $veri["canli"] = $za["tip"];
        $veri["botid"] = $za["id"];
        $veri["oransayi"] = $za["oran_adet"];

        // Spor, ülke, lig kontrolü ve ekleme/güncelleme
        $sporkontrol = end($this->db->aresult("Select id from dark_sports where name = '".$za["tur"]."' AND live = 0 "));
        if ($sporkontrol == 0) {
            $this->db->insert("dark_sports", [
                "sportid" => $za["sportid"],
                "name" => $za["tur"],
                "live" => 0
            ]);
            echo "<b style='color:#0085B2;'>[LOG]: Spor Eklendi => </b>".$za['sportid']." - ".$za['tur']."</br>";
        } else {
            $this->db->update("dark_sports", array("sportid" => $za["sportid"], "live" => 0), array("name" => $za["tur"],"live" => 0));
            echo "<b style='color:#238C00;'>[LOG]: Spor Güncellendi => </b>".$za['sportid']." - ".$za['tur']."</br>";
        }

        $ulkekontrol = end($this->db->aresult("Select id from dark_country where countryid = '".$za["ulke_id"]."' and sportid = '".$za["tip"]."' "));
        if ($ulkekontrol == 0) {
            $this->db->insert("dark_country", [
                "countryid" => $za["ulke_id"],
                "name" => $za["ulke_isim"],
                "sportid" => $za["tip"],
                "slug" => mb_strtolower($za["countrySlug"])
            ]);
            echo "<b style='color:#0085B2;'>[LOG]: Ülke Eklendi => </b>".$za['ulke_isim']." - ".$za['tur']."</br>";
        }

        $ligkontrol = end($this->db->aresult("Select id from dark_leagues where leaguesid = '".$za["lig_id"]."' and sportid = '".$za["tip"]."' and countryid = '".$za["ulke_id"]."' "));
        if ($ligkontrol == 0) {
            $this->db->insert("dark_leagues", [
                "leaguesid" => $za["lig_id"],
                "name" => $za["lig_isim"],
                "countryid" => $za["ulke_id"],
                "sportid" => $za["tip"]
            ]);
            echo "<b style='color:#FF7F00;'>[LOG]: Lig Eklendi => </b>".$za['ulke_isim']." - ".$za['tur']."</br>";
        }

        $eklendimi = end($this->db->aresult("select id from maclar where sistem='hitit' and botid='$za[id]' and canli='$botid'"));
        if ($eklendimi == 0) {
            $this->db->insert("maclar", $veri);
            $macid = $this->db->insert_id(); // 'mysql_insert_id()' yerine 'insert_id()' kullanımı
            echo "<b style='color:#FF0000;'>[LOG]: Maç Eklendi => </b>".$za['evsahibi_isim']." - ".$za["misafir_isim"]."</br>";
        } else {
            $this->db->update("maclar", $veri, array("id" => $eklendimi));
            $macid = $eklendimi;
            echo "<b style='color:#238C00;'>[LOG]: Maç Güncellendi => </b>".$za['evsahibi_isim']." - ".$za["misafir_isim"]."</br>";
        }

        $veri2 = array();
        $veri2["macid"] = $macid;
        $veri2["tarih"] = date("Y-m-d H:i:s");
        $darkodd1 = str_replace(",", ".", $za["oran1"]);
        $darkodd0 = str_replace(",", ".", $za["oran0"]);
        $darkodd2 = str_replace(",", ".", $za["oran2"]);

        // Oran işlemleri
        if ($operation == "increase") {
            $darkodd1 = round(((float)$darkodd1 + ((float)$darkodd1 * (float)$percent)), 2);
            $darkodd0 = round(((float)$darkodd0 + ((float)$darkodd0 * (float)$percent)), 2);
            $darkodd2 = round(((float)$darkodd2 + ((float)$darkodd2 * (float)$percent)), 2);
        } else if ($operation == "decrease") {
            $darkodd1 = round(((float)$darkodd1 - ((float)$darkodd1 * (float)$percent)), 2);
            $darkodd0 = round(((float)$darkodd0 - ((float)$darkodd0 * (float)$percent)), 2);
            $darkodd2 = round(((float)$darkodd2 - ((float)$darkodd2 * (float)$percent)), 2);
        }

        $veri2["1"] = $darkodd1;
        $veri2["0"] = $darkodd0;
        $veri2["2"] = $darkodd2;
        $veri2["mbs"] = $za["mbs"];

        $eklendimi31 = end($this->db->aresult("select id from mac_oran where macid='$macid' and userid=0"));

        if ($eklendimi31 == 0) {
            $this->db->insert("mac_oran", $veri2);
        } else {
            $this->db->update("mac_oran", $veri2, array("macid" => $macid, "userid" => 0));
            unset($veri2["mbs"]);
            $this->db->update("mac_oran", $veri2, array("macid" => $macid));
        }

        $totalMatch[] = $za["mackodu"];
    }

    $this->db->query("update maclar set iptal = 1 where live = 0 && mackodu not in (" . implode(",", $totalMatch) . ")");
}



   function PreMatchTR() {
    sleep(15);
    
    // Veritabanından oran ayarlarını ve API anahtarını al
    $odds_settings = $this->db->result("SELECT * FROM settings WHERE `key` = 'pre_odds' ");
    $odds_percent = $odds_settings[0]['value'];
    $odds_data = json_decode($odds_percent);
    $operation = $odds_data[0];
    $percent = $odds_data[1];

    $key_query = "SELECT betsapitechkey FROM odd_services LIMIT 1";
    $key_result = $this->db->result($key_query);

    if (!$key_result || count($key_result) === 0) {
        echo "Anahtar bulunamadı.";
        return;
    }

    $apiKey = $key_result[0]['betsapitechkey'];

    // API'den veri al
    $api_url = "https://betsapi.tech/api/presports.php?token=" . $apiKey;
    $kod = simplexml_load_string(file_get_contents($api_url));
    
    if ($kod === false) {
        echo "API'den veri alınamadı.";
        return;
    }
        foreach ($kod->Mac as $z) {
            $za = $z->attributes();
            
            $rand = rand(1, 9999);
            $veri = array();
            $veri["tarih"] = $za["baslangic"];
            $ev = $za["evsahibi_isim"];
            $mi = $za["misafir_isim"];
            $kod = $za["hitit_kod"];
            $botid=$za["tip"];
            $veri["pluskod"] = $za["pluskod"];
            $veri["lig"] = $za["lig_isim"];
            $veri["evsahibi"] = $za["evsahibi_isim"];
            $veri["ulke"] = $za["ulke_isim"];
            $veri["ulkeisim"] = $za["ulke_isim"];
            $veri["ulkeid"] = $za["ulke_id"];
            $veri["lig"] = $za["lig_isim"];
            $veri["lig_id"] = $za["lig_id"];
            $veri["deplasman"] = $za["misafir_isim"];
            $veri["ligresim"] = $za["ligresim"];
            $veri["mackodu"] = $za["mackodu"];
            $veri["istatistik"] = $za["istatistik"];
            $veri["sistem"] = "hitit";
            $veri["canli"] = $za["tip"];
            $veri["botid"] = $za["id"];
            $veri["oransayi"] = $za["oran_adet"];


            $sporkontrol = end($this->db->aresult("Select id from dark_sports where name = '".$za["tur"]."' AND live = 0 "));
            if ($sporkontrol == 0) {
                $this->db->insert("dark_sports",[
                    "sportid" => $za["sportid"],
                    "name" => $za["tur"],
                    "live" => 0
                ]);
                echo "<b style='color:#0085B2;'>[LOG]: Spor Eklendi => </b>".$za['sportid']." - ".$za['tur']."</br>";
            } else {
                $this->db->update("dark_sports", array("sportid" => $za["sportid"], "live" => 0), array("name" => $za["tur"],"live" => 0));
                echo "<b style='color:#238C00;'>[LOG]: Spor Güncellendi => </b>".$za['sportid']." - ".$za['tur']."</br>";
            }

            $ulkekontrol = end($this->db->aresult("Select id from dark_country where countryid = '".$za["ulke_id"]."' and sportid = '".$za["tip"]."' "));
            if ($ulkekontrol == 0) {
                $this->db->insert("dark_country",[
                    "countryid" => $za["ulke_id"],
                    "name" => $za["ulke_isim"],
                    "sportid" => $za["tip"],
                    "slug" => mb_strtolower($za["countrySlug"])
                ]);
                echo "<b style='color:#0085B2;'>[LOG]: Ülke Eklendi => </b>".$za['ulke_isim']." - ".$za['tur']."</br>";
            }

            $ligkontrol = end($this->db->aresult("Select id from dark_leagues where leaguesid = '".$za["lig_id"]."' and sportid = '".$za["tip"]."' and countryid = '".$za["ulke_id"]."' "));
            if ($ligkontrol == 0) {
                $this->db->insert("dark_leagues",[
                    "leaguesid" => $za["lig_id"],
                    "name" => $za["lig_isim"],
                    "countryid" => $za["ulke_id"],
                    "sportid" => $za["tip"]
                ]);
                echo "<b style='color:#FF7F00;'>[LOG]: Lig Eklendi => </b>".$za['ulke_isim']." - ".$za['tur']."</br>";
            }


            $eklendimi = end($this->db->aresult("select id from maclar where sistem='hitit' and botid='$za[id]' and canli='$botid'"));
            if ($eklendimi == 0) {
                $this->db->insert("maclar", $veri);
                //echo $this->db->last_query();
                $macid = mysql_insert_id();
                echo "<b style='color:#FF0000;'>[LOG]: Maç Eklendi => </b>".$za['evsahibi_isim']." - ".$za["misafir_isim"]."</br>";
            } else {
                $this->db->update("maclar", $veri, array("id" => $eklendimi));
                $macid = $eklendimi;
                echo "<b style='color:#238C00;'>[LOG]: Maç Güncellendi => </b>".$za['evsahibi_isim']." - ".$za["misafir_isim"]."</br>";
            }

            $veri2 = array();
            $veri2["macid"] = $macid;
            $veri2["tarih"] = date("Y-m-d H:i:s");
            $darkodd1 = str_replace(",", ".", $za["oran1"]);
            $darkodd0 = str_replace(",", ".", $za["oran0"]);
            $darkodd2 = str_replace(",", ".", $za["oran2"]);



            if ($operation == "increase") {
                $darkodd1 = round( ( (float)$darkodd1 + ( (float)$darkodd1 * (float)$percent ) ),2);
                $darkodd0 = round( ( (float)$darkodd0 + ( (float)$darkodd0 * (float)$percent ) ),2);
                $darkodd2 = round( ( (float)$darkodd2 + ( (float)$darkodd2 * (float)$percent ) ),2);
            } else if ($operation == "decrease") {
                $darkodd1 = round( ( (float)$darkodd1 - ( (float)$darkodd1 * (float)$percent ) ),2);
                $darkodd0 = round( ( (float)$darkodd0 - ( (float)$darkodd0 * (float)$percent ) ),2);
                $darkodd2 = round( ( (float)$darkodd2 - ( (float)$darkodd2 * (float)$percent ) ),2);
            }

            $veri2["1"] = $darkodd1;
            $veri2["0"] = $darkodd0;
            $veri2["2"] = $darkodd2;


            $veri2["mbs"] = $za["mbs"];
            $eklendimi31 = end($this->db->aresult("select id from mac_oran where macid='$macid' and userid=0"));

            if ($eklendimi31 == 0) {
                $this->db->insert("mac_oran", $veri2);
            } else {
                $this->db->update("mac_oran", $veri2, array("macid" => $macid, "userid" => 0));
                unset($veri2["mbs"]);
                $this->db->update("mac_oran", $veri2, array("macid" => $macid));
            }

            $totalMatch[] = $za["mackodu"];
        }
        $this->db->query("update maclar set iptal = 1 where live = 0 && mackodu not in (" . implode(",", $totalMatch) . ") ");
        $this->PreMatch();

    }

    function ClearMatch() {
        $this->db->query("DELETE FROM maclar");
        $this->db->query("DELETE FROM mac_oran");
        $this->PreMatch();
    }

    function oddsVeri($id) {
        $url = SITE_MATCH_ODDS.$id;
        $bukaynak = file_get_contents($url);
        $xml = new SimpleXMLElement($bukaynak);
        return $xml;
    }

    function LiveMatch() {
        for ($i=0; $i < 2; $i++) {
            $this->canli("hitit");
            ob_flush();
            flush();
            sleep(4);
        }
    }

function canli($sistem) {
    $cek = file_get_contents(SITE_MATCH_LIST);
    if (!$cek) {
        die("Error: XML verisi alınamadı.");
    }

    $maclar = simplexml_load_string($cek);
    if (!$maclar) {
        die("Error: XML verisi işlenemedi.");
    }

    $macsid = []; // Güncellenen maçların botid'leri burada tutuluyor

    foreach ($maclar->Mac as $mac) {
        $at = $mac->attributes();
        $macsid[] = (string)$at["id"]; // Güncellenen maçın botid'sini listeye ekliyoruz

        // Ev sahibi ve misafir takım isimlerini XML'den alıyoruz
        $evsahibi_isim = htmlspecialchars((string)$at["evsahibi_isim"]);
        $misafir_isim = htmlspecialchars((string)$at["misafir_isim"]);

        // Maçı veritabanında kontrol et (botid ve sistem'e göre)
        $varmi = $this->db->aresult("SELECT * FROM maclar WHERE botid = '" . $at["id"] . "' AND sistem = '$sistem'");

        if (isset($varmi["id"])) {
            // Eğer maç zaten veritabanında varsa güncelleme yap
            $macid = $varmi["id"];
            $this->db->update("maclar", array(
                "evsahibi" => $evsahibi_isim,
                "deplasman" => $misafir_isim,
                "ilkyariskor" => $at["skor"],
                "sistem" => $sistem,
                "canlimi" => "1",
                "saniye" => date("s"),
                "macdevresi" => 0,
                "tarih" => $at["baslangic"],
                "canli" => $at["sportid"],
                "dakika" => $at["dakika"],
                "suredetay" => $at["sure_detay"],
                "skor" => $at["skor"],
                "devrearasi" => 0,
                "oynuyormu" => $at["oynuyormu"],
                "aktifmi" => $at["aktifmi"],
                "ulke" => $at["ulke"],
                "ulkeid" => $at["ulke_id"],
                "lig" => $at["lig"],
                "lig_id" => $at["lig_id"],
                "oransayi" => $at["oran_adet"],
                "live" => 1
            ), array("id" => $macid, "sistem" => $sistem));

            echo $at["tip"] . "<b> => " . $evsahibi_isim . " - " . $misafir_isim . "</b><b style='color:green;'> Güncellendi.</b></br>";
        } else {
            // Maç veritabanında yoksa, yeni bir maç ekle
            $this->db->insert("maclar", array(
                "botid" => $at["id"],
                "evsahibi" => $evsahibi_isim,
                "deplasman" => $misafir_isim,
                "ilkyariskor" => $at["skor"],
                "sistem" => $sistem,
                "canlimi" => "1",
                "saniye" => date("s"),
                "macdevresi" => 0,
                "tarih" => $at["baslangic"],
                "canli" => $at["sportid"],
                "dakika" => $at["dakika"],
                "suredetay" => $at["sure_detay"],
                "skor" => $at["skor"],
                "devrearasi" => 0,
                "oynuyormu" => $at["oynuyormu"],
                "aktifmi" => $at["aktifmi"],
                "ulke" => $at["ulke"],
                "ulkeid" => $at["ulke_id"],
                "lig" => $at["lig"],
                "lig_id" => $at["lig_id"],
                "oransayi" => $at["oran_adet"],
                "live" => 1
            ));

            echo $at["tip"] . "<b> => " . $evsahibi_isim . " - " . $misafir_isim . "</b><b style='color:green;'> Eklendi.</b></br>";
        }
    }

    if (!empty($macsid)) {
        // Eğer botid dizisi doluysa, veritabanında bu botid'lerde olmayan aktif maçları sil
        $this->db->query("DELETE FROM maclar WHERE aktifmi = 1 AND botid NOT IN (" . implode(",", $macsid) . ") AND sistem='$sistem'");
        
        echo "<b style='color:red;'>Güncellenmeyen aktif maçlar silindi.</b><br>";
    }
} 

    




    


    function ceweanli($sistem) {

        $cek = file_get_contents(SITE_MATCH_LIST);
        $maclar = simplexml_load_string($cek);
       // $macsid = []; // Dizi tanımlanıyor

        foreach ($maclar->Maclar as $mac) {
            $at = $mac->attributes();
           // $macsid[] = $at["id"];

            $varmi = $this->db->aresult("select * from maclar where botid='$at[id]' and canli='".$at["sportid"]."' and sistem='$sistem'");

            if ($varmi["id"]) {
                $macid = $varmi["id"];
                $this->db->update("maclar", array(
                    "ilkyariskor" => $at["skor"],
                    "sistem" => $sistem,
                    "canlimi" => "1",
                    "saniye" => date("s"),
                    "macdevresi" => $at["sure_detay"],
                    "tarih" => $at["baslangic"],
                    "canli" => $at["sportid"],
                    "dakika" => $at["dakika"],
                    "suredetay" => $at["sure_detay"],
                    "skor" => $at["skor"],
                    "devrearasi" => $devre,
                    "oynuyormu" => $at["oynuyormu"],
                    "aktifmi" => $at["aktifmi"],
                    "ulke" => $at["ulke"],
                    "ulkeid" => $at["ulke_id"],
                    "lig" => $at["lig"],
                    "lig_id" => $at["lig_id"],
                    "oransayi" => $at["oran_adet"],
                    "live" => 1
                ), array("id" => $macid, "sistem" => $sistem));
                echo $at["tip"]."<b> => ".$at["evsahibi_isim"]." - ".$at["misafir_isim"]."</b><b style='color:green;'> Güncellendi.</b></br>";
            }


            //Spor Ekleme
            $sporkontrol = end($this->db->aresult("Select id from dark_sports where name = '".$at["tip"]."' AND live = 1 "));
            if ($sporkontrol == 0) {
                $this->db->insert("dark_sports",[
                    "sportid" => $at["sportid"],
                    "name" => $at["tip"],
                    "live" => 1
                ]);
                echo "<b style='color:#0085B2;'>[LOG]: Spor Eklendi => </b>".$at['sportid']." - ".$at['tip']."</br>";
            } else {
                $this->db->update("dark_sports", array("sportid" => $at["sportid"], "live" => 1), array("name" => $at["tip"],"live" => 1));
            }

            @$ulkekontrol = end($this->db->aresult("Select id from dark_country where countryid = '".$at["ulke_id"]."' and sportid = '".$at["sportid"]."' "));
            if ($ulkekontrol == 0) {
                $this->db->insert("dark_country",[
                    "countryid" => $at["ulke_id"],
                    "name" => $at["ulke"],
                    "sportid" => $at["sportid"],
                    "live" => 1
                ]);
                echo "<b style='color:#0085B2;'>[LOG]: Ülke Eklendi => </b>".$at['ulke']." - ".$at['tur']."</br>";
            }

            @$ligkontrol = end($this->db->aresult("Select id from dark_leagues where leaguesid = '".$at["lig_id"]."' and sportid = '".$at["sportid"]."' and countryid = '".$at["ulke_id"]."' "));
            if ($ligkontrol == 0) {
                $this->db->insert("dark_leagues",[
                    "leaguesid" => $at["lig_id"],
                    "name" => $at["lig"],
                    "countryid" => $at["ulke_id"],
                    "sportid" => $at["sportid"],
                    "live" => 1
                ]);
                echo "<b style='color:#FF7F00;'>[LOG]: Lig Eklendi => </b>".$at['ulke_isim']." - ".$at['tur']."</br>";
            }



            //$macsid[] = $at["id"];
        }
      //  if (!empty($macsid)) { // $macsid dizisi boş değilse SQL sorgusunu çalıştır
            $this->db->query("update maclar set oynuyormu=0 , aktifmi=0 where live = 1 && botid not in (" . implode(",", $macsid) . ") ");
      //  }
    }


    function HoGamingBalanceTransfer() {
        $hogaming_users = $this->db->result("SELECT hogaming_users.*,admin.username FROM hogaming_users LEFT JOIN admin ON hogaming_users.user_id = admin.id");

        foreach ($hogaming_users as $users) {
            $user_id = $users['user_id'];
            $username = $users['username'];

            $data = array("method" => "balance", "key" => HOGAMING_KEY, "secret" => HOGAMING_SECRET, "username" => $username, "name" => $username);
            $response = httpPost("https://betsapi.tech",$data);
            $response = json_decode($response);
            $balance = $response->balance;

            echo "$user_id $username => $balance </br>";
        }
    }


    function getLogsXXXXD($id = 0) {
        die();
        header("Access-Control-Allow-Origin: *");

        $post = (object) $_POST;

        if ( @$post->playgo == 1 ) {
            if ($id == 0) {
                // hepsi
                $logs = $this->db->result("SELECT admin.id AS user_id, admin.username, log.* FROM log INNER JOIN admin ON log.userid = admin.id ORDER BY log.id DESC LIMIT 500");
            } else {
                $logs = $this->db->result("SELECT admin.id AS user_id, admin.username, log.* FROM log INNER JOIN admin ON log.userid = admin.id WHERE log.id > '$id' ORDER BY log.id DESC LIMIT 500");
            }
            echo json_encode(['total' => count($logs), 'logs' => $logs]);
        } else die("403: Invalid request, please try again later.");
    }

    function serverLogsXXXXD($id = 0) {
        die();
        header("Access-Control-Allow-Origin: *");

        $post = (object) $_POST;

        if ( @$post->playgo == 1 ) {
            if ($id == 0) {
                // hepsi
                $logs = $this->db->result("SELECT admin.username, server_logs.id, server_logs.http_code, server_logs.request_method, server_logs.ip, server_logs.ajax, server_logs.post_args, server_logs.url, server_logs.request_time, server_logs.cookie, server_logs.session, server_logs.query_string, server_logs.user_id, server_logs.date FROM server_logs LEFT JOIN admin ON server_logs.user_id = admin.id ORDER BY server_logs.id DESC LIMIT 500");
            } else {
                $logs = $this->db->result("SELECT admin.username, server_logs.id, server_logs.http_code, server_logs.request_method, server_logs.ip, server_logs.ajax, server_logs.post_args, server_logs.url, server_logs.request_time, server_logs.cookie, server_logs.session, server_logs.query_string, server_logs.user_id, server_logs.date FROM server_logs LEFT JOIN admin ON server_logs.user_id = admin.id WHERE server_logs.id > '$id' ORDER BY server_logs.id DESC LIMIT 500");
            }
            echo json_encode(['total' => count($logs), 'logs' => $logs]);
        } else die("403: Invalid request, please try again later.");

    }


}

?>