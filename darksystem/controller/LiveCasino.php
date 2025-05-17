<?php
class LiveCasino extends controller {

    function __construct() {
        parent::controller();
        $this->admin = $this->load->model("admin");
        $this->user = $this->load->library("user");
        $this->cookie = $this->load->library("cookie");

    }

    public function index() {
        $user = $this->admin->getinfo();
        $login = $this->admin->is_login();
        $userid = $this->admin->user_id();

        $user_cookie = @$_SESSION['username'];
        $cookie_id       = @explode('__', $user_cookie)[0];
        $cookie_username = @explode('__', $user_cookie)[1];
        $cookie_password = @explode('__', $user_cookie)[2];
        $bilgi = $this->db->aresult("select * from admin where username='$cookie_username' && password = '$cookie_password'");


        $casino_banners = $this->db->result("select * from casino_banners where live = 1 order by `index` ASC");
        $casino_banners = json_decode(json_encode($casino_banners));


        $casino_games = $this->db->result("select * from casino_games where live = 1 and active = 1  order by id ASC");
        $casino_games = json_decode(json_encode($casino_games));


        foreach ($casino_games as $key => $games) {
            $list[$games->game_section][$games->id]['game_name'] = $games->game_name;
            $list[$games->game_section][$games->id]['game_type'] = $games->game_type;
            $list[$games->game_section][$games->id]['game_image'] = $games->game_image;
            $list[$games->game_section][$games->id]['game_section'] = $games->game_section;
            $list[$games->game_section][$games->id]['table_id'] = $games->table_id;
            $list[$games->game_section][$games->id]['bet_type'] = $games->bet_type;
        }



        $this->view->display("livecasinolive.tpl", get_defined_vars());
    }


    public function Slot() {
        $user = $this->admin->getinfo();
        $login = $this->admin->is_login();
        $userid = $this->admin->user_id();

        $user_cookie = @$_SESSION['username'];
        $cookie_id       = @explode('__', $user_cookie)[0];
        $cookie_username = @explode('__', $user_cookie)[1];
        $cookie_password = @explode('__', $user_cookie)[2];
        $bilgi = $this->db->aresult("select * from admin where username='$cookie_username' && password = '$cookie_password'");



        $casino_banners = $this->db->result("select * from casino_banners where live = 0 order by RAND()"); //order by `index` ASC
        $casino_banners = json_decode(json_encode($casino_banners));



        $casino_games = $this->db->result("select * from casino_games where live = 0 and active = 1 order by RAND()"); //order by id DESC
        $casino_games = json_decode(json_encode($casino_games));





        foreach ($casino_games as $key => $games) {
            $list[$games->game_section][$games->id]['game_name'] = $games->game_name;
            $list[$games->game_section][$games->id]['game_type'] = $games->game_type;
            $list[$games->game_section][$games->id]['game_image'] = $games->game_image;
            $list[$games->game_section][$games->id]['game_section'] = $games->game_section;
            $list[$games->game_section][$games->id]['table_id'] = $games->table_id;
            $list[$games->game_section][$games->id]['bet_type'] = $games->bet_type;
        }

        $this->view->display("livecasino.tpl", get_defined_vars());
    }



    public function Token($id){
        header('Content-Type: application/json');
        //Casino Bilgileri
        $casino_id = security($id);
        $find_casino = $this->db->aresult("SELECT * FROM casino_games WHERE id = $casino_id");
        if (empty($find_casino)) { die("Casino Bulunamadi"); }
        $game_name = $find_casino['game_name'];
        $game_type = $find_casino['game_type'];
        $table_id = $find_casino['table_id'];
        $bet_type = $find_casino['bet_type'];
        $version = $find_casino['version'];
        $lang = "tr";

        //羹ye Bilgileri
        $user = $this->admin->getinfo();
        $login = $this->admin->is_login();
        $userid = $this->admin->user_id();
        $user_cookie = @$_SESSION['username'];
        $cookie_id       = @explode('__', $user_cookie)[0];
        $cookie_username = @explode('__', $user_cookie)[1];
        $cookie_password = @explode('__', $user_cookie)[2];
        $bilgi = $this->db->aresult("select * from admin where username='$cookie_username' && password = '$cookie_password'");
        $user_id = $bilgi['id'];
        $name = $bilgi['name'];
        $username = REDIS_KEY.'_'.$bilgi['username'];
        if (empty($bilgi)) {
            $data = array("method" => "token", "user_id" => 0, "username" => "demo", "name" => "demo");
            $response = httpPost("/",$data);
            $response = json_decode($response);
            echo $response;
        } else {

                $data = array("method" => "token","user_id"=> $userid, "username" => $username, "name" => $name,"game_id"=>$table_id);
                $response = httpPost("https://",$data);
                $response = json_decode($response);
                $url ="https://".$userid."&game_id=".$table_id;
             //   $this->db->update("hogaming_users", array("token" => $response->token), array("user_id" => $user_id));
            }
        

        
        $data = ["code" => "1", "url" => $url, "token" => $response->token, "success" => true];
        echo json_encode($data);

    }

    function Game($id) {
        $casino_id = security($id);



        $user = $this->admin->getinfo();
        $login = $this->admin->is_login();
        $userid = $this->admin->user_id();
        $user_cookie = @$_SESSION['username'];
        $cookie_id       = @explode('__', $user_cookie)[0];
        $cookie_username = @explode('__', $user_cookie)[1];
        $cookie_password = @explode('__', $user_cookie)[2];
        $bilgi = $this->db->aresult("select * from admin where username='$cookie_username' && password = '$cookie_password'");
if(empty($bilgi)){
    die("Oyun oynamak için giriş yapınız.");
}else{
        $find_casino = $this->db->aresult("SELECT * FROM casino_games WHERE id = $casino_id");
        if (empty($find_casino)) { die("Casino Bulunamadi"); }

        $this->view->display("opengame.tpl", get_defined_vars());
    }
    }

 


}
?>
