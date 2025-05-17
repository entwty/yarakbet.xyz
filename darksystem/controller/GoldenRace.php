<?php

class GoldenRace extends controller {

    function __construct() {
        parent::controller();
        $this->admin = $this->load->model("admin");
    }

    public function Games() {
        $user = $this->admin->getinfo();
        $login = $this->admin->is_login();
        $userid = $this->admin->user_id();

        $user_cookie = @$_SESSION['username'];
        $cookie_id       = @explode('__', $user_cookie)[0];
        $cookie_username = @explode('__', $user_cookie)[1];
        $cookie_password = @explode('__', $user_cookie)[2];
        $bilgi = $this->db->aresult("select * from admin where username='$cookie_username' && password = '$cookie_password'");


        $gr_banners = $this->db->result("select * from gr_banners order by `index` ASC");
        $gr_banners = json_decode(json_encode($gr_banners));


        $gr_games = $this->db->result("select * from gr_games where  active = 1 order by id ASC");
        $gr_games = json_decode(json_encode($gr_games));


        foreach ($gr_games as $key => $games) {
            $list[$games->game_section][$games->id]['game_name'] = $games->game_name;
            $list[$games->game_section][$games->id]['game_type'] = $games->game_type;
            $list[$games->game_section][$games->id]['game_image'] = $games->game_image;
            $list[$games->game_section][$games->id]['game_section'] = $games->game_section;
            $list[$games->game_section][$games->id]['table_id'] = $games->table_id;
            $list[$games->game_section][$games->id]['bet_type'] = $games->bet_type;
        }



        $this->view->display("golden_race.tpl", get_defined_vars());
    }

    public function Game($id){

        $user_info = $this->admin->user_info();
        $game_id = security($id);

        $find_game = $this->pdo->prepare("SELECT * FROM gr_games WHERE active = ? AND code = ? ");
        $find_game->execute([1,$game_id]);

        if ($find_game->rowCount() == 0) {
            die(response(false,404,'Oyun bulunamadı, lütfen tekrar deneyiniz.'));
        }

        $token = randomToken(90);
        $game = $game_id;
        $mode = 1;
        $group = "master";
        $client_platform = (mobileDeviceControl()) ? 'mobile' : 'desktop';
        $h = md5($token.$game.GR_BACK_URL.$mode.GR_LANGUAGE.$group.$client_platform.GR_DEPOSIT_URL.GR_PRIVATE_KEY);

        if ($user_info) {

            $update_token = $this->pdo->prepare("UPDATE gr_users SET active = ? WHERE user_id = ? ");
            $update_token->execute([0, $user_info->id]);

            $insert_user = $this->pdo->prepare("INSERT INTO gr_users (user_id, token) VALUES (?,?)");
            $insert_user->execute([$user_info->id,$token]);

            $find_token = $this->pdo->prepare("SELECT * FROM gr_users WHERE user_id = ? ORDER BY id DESC");
            $find_token->execute([$user_info->id]);
            $token = $find_token->fetch(PDO::FETCH_OBJ)->token;

        } else {
            $token = '';
            $game = $game_id;
            $mode = 0;
            $group = "master";
            $client_platform = (mobileDeviceControl()) ? 'mobile' : 'desktop';
            $h = md5($token.$game.GR_BACK_URL.$mode.GR_LANGUAGE.$group.$client_platform.GR_DEPOSIT_URL.GR_PRIVATE_KEY);
        }

        $data = http_build_query([
            "token" => $token,
            "game" => $game,
            "backurl" => GR_BACK_URL,
            "mode" => $mode,
            "language" => GR_LANGUAGE,
            "group" => $group,
            "clientPlatform" => $client_platform,
            "cashierurl" => GR_DEPOSIT_URL,
            "h" => $h
        ]);

        $url = GR_LAUNCHER_URL."/Launcher?".$data ;

        $this->view->display("golden_race_frame.tpl", get_defined_vars());
    }

 public function Keno($id){

        $user_info = $this->admin->user_info();
        $game_id = security($id);

        $find_game = $this->pdo->prepare("SELECT * FROM gr_games WHERE active = ? AND code = ? ");
        $find_game->execute([1,$game_id]);

        if ($find_game->rowCount() == 0) {
            die(response(false,404,'Oyun bulunamadı, lütfen tekrar deneyiniz.'));
        }

        $token = randomToken(90);
        $game = $game_id;
        $mode = 1;
        $group = "master";
        $client_platform = (mobileDeviceControl()) ? 'mobile' : 'desktop';
        $h = md5($token.$game.GR_BACK_URL.$mode.GR_LANGUAGE.$group.$client_platform.GR_DEPOSIT_URL.GR_PRIVATE_KEY);

        if ($user_info) {

            $update_token = $this->pdo->prepare("UPDATE gr_users SET active = ? WHERE user_id = ? ");
            $update_token->execute([0, $user_info->id]);

            $insert_user = $this->pdo->prepare("INSERT INTO gr_users (user_id, token) VALUES (?,?)");
            $insert_user->execute([$user_info->id,$token]);

            $find_token = $this->pdo->prepare("SELECT * FROM gr_users WHERE user_id = ? ORDER BY id DESC");
            $find_token->execute([$user_info->id]);
            $token = $find_token->fetch(PDO::FETCH_OBJ)->token;

        } else {
            $token = '';
            $game = $game_id;
            $mode = 0;
            $group = "master";
            $client_platform = (mobileDeviceControl()) ? 'mobile' : 'desktop';
            $h = md5($token.$game.GR_BACK_URL.$mode.GR_LANGUAGE.$group.$client_platform.GR_DEPOSIT_URL.GR_PRIVATE_KEY);
        }

        $data = http_build_query([
            "token" => $token,
            "game" => $game,
            "backurl" => GR_BACK_URL,
            "mode" => $mode,
            "language" => GR_LANGUAGE,
            "group" => $group,
            "clientPlatform" => $client_platform,
            "cashierurl" => GR_DEPOSIT_URL,
            "h" => $h
        ]);

        $url = json_encode([ 'status' => true, 'code' => 200, 'url' => GR_LAUNCHER_URL."/Launcher?".$data ]);

        $this->view->display("golden_race_keno.tpl", get_defined_vars());
    }

}

?>