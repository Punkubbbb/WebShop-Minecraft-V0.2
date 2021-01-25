<?php

include_once 'AES.php';

class Lolipop_Config {

    public function __construct() {
        $this->fileConfig = dirname(__FILE__) . "/config.lpk";
        $this->fileData = file_get_contents($this->fileConfig);
        $this->AES = new Crypt_AES();
        $this->AES->setKey("LKWebshop_By_LolipopKungz");
        $this->rawSetting = $this->AES->decrypt(base64_decode($this->fileData));
        $this->Setting = json_decode($this->rawSetting, TRUE);
    }

    public function Config() {
        return $this->Setting;
    }

    public function UpdateConfig($Section, $Array, $Value) {
        unset($SettingData, $Encode);
        $SettingData = json_decode($this->AES->decrypt(base64_decode(file_get_contents($this->fileConfig))), TRUE);
        if (!isset($SettingData[$Section]))
            $SettingData[$Section] = array();
        $SettingData[$Section][$Array] = $Value;
        $Encode = base64_encode($this->AES->encrypt(json_encode($SettingData)));
        return file_put_contents($this->fileConfig, $Encode);
    }

    public function UpdateArrayConfig($Section, $Array) {
        unset($SettingData, $Encode);
        $SettingData = json_decode($this->AES->decrypt(base64_decode(file_get_contents($this->fileConfig))), TRUE);
        $SettingData[$Section] = $Array;
        $Encode = base64_encode($this->AES->encrypt(json_encode($SettingData)));
        return file_put_contents($this->fileConfig, $Encode);
    }
}


class Rcon {

    private $host;
    private $port;
    private $password;
    private $timeout;
    private $socket;
    private $authorized;
    private $last_response;

    const PACKET_AUTHORIZE = 5;
    const PACKET_COMMAND = 6;
    const SERVERDATA_AUTH = 3;
    const SERVERDATA_AUTH_RESPONSE = 2;
    const SERVERDATA_EXECCOMMAND = 2;
    const SERVERDATA_RESPONSE_VALUE = 0;

    public function __construct($host, $port, $password, $timeout) {
        $this->host = $host;
        $this->port = $port;
        $this->password = $password;
        $this->timeout = $timeout;
    }

    public function get_response() {
        return $this->last_response;
    }

    public function connect() {
        $this->socket = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
        if (!$this->socket) {
            $this->last_response = $errstr;
            return false;
        }
        stream_set_timeout($this->socket, 3, 0);
        $auth = $this->authorize();
        if ($auth) {
            return true;
        }
        return false;
    }

    public function disconnect() {
        if ($this->socket) {
            fclose($this->socket);
        }
    }

    public function is_connected() {
        return $this->authorized;
    }

    public function send_command($command) {
        if (!$this->is_connected())
            return false;
        $this->write_packet(Rcon::PACKET_COMMAND, Rcon::SERVERDATA_EXECCOMMAND, $command);
        $response_packet = $this->read_packet();
        if ($response_packet['id'] == Rcon::PACKET_COMMAND) {
            if ($response_packet['type'] == Rcon::SERVERDATA_RESPONSE_VALUE) {
                $this->last_response = $response_packet['body'];
                return $response_packet['body'];
            }
        }
        return false;
    }

    private function authorize() {
        $this->write_packet(Rcon::PACKET_AUTHORIZE, Rcon::SERVERDATA_AUTH, $this->password);
        $response_packet = $this->read_packet();
        if ($response_packet['type'] == Rcon::SERVERDATA_AUTH_RESPONSE) {
            if ($response_packet['id'] == Rcon::PACKET_AUTHORIZE) {
                $this->authorized = true;
                return true;
            }
        }
        $this->disconnect();
        return false;
    }

    private function write_packet($packet_id, $packet_type, $packet_body) {
        $packet = pack("VV", $packet_id, $packet_type);
        $packet = $packet . $packet_body . "\x00";
        $packet = $packet . "\x00";
        $packet_size = strlen($packet);
        $packet = pack("V", $packet_size) . $packet;
        fwrite($this->socket, $packet, strlen($packet));
    }

    private function read_packet() {
        $size_data = fread($this->socket, 4);
        $size_pack = unpack("V1size", $size_data);
        $size = $size_pack['size'];
        $packet_data = fread($this->socket, $size);
        $packet_pack = unpack("V1id/V1type/a*body", $packet_data);
        return $packet_pack;
    }

}

function AuthMeSha256($password) {
    $salt = str_shuffle(substr(md5(time() . mt_rand()), 0, 16));
    $pass = '$SHA$' . $salt . '$' . hash("SHA256", hash("SHA256", $password) . $salt);
    return $pass;
}

function AuthMeSha256Check($password, $salt) {
    $pass = '$SHA$' . $salt . '$' . hash("SHA256", hash("SHA256", $password) . $salt);
    return $pass;
}

function AuthMeSAH256Parser($password) {
    $split = explode('$', $password);
    $return['salt'] = $split[2];
    $return['pass'] = $split[3];
    return $return;
}

function PasswordHash($password, $password_check) {

    $Parser = AuthMeSAH256Parser($password_check);
    return AuthMeSha256Check($password, $Parser['salt']) == $password_check;
}

function ServerRCON($Command, $Info = array()) {
    global $Config;
    if (empty($Info)) {
        $Info = array(
            "ip" => $Config['minecraft']['ip'],
            "rcon_port" => $Config['minecraft']['port'],
            "rcon_password" => $Config['minecraft']['pass'],
        );
    }
    $rcon = new Rcon($Info['ip'], $Info['rcon_port'], $Info['rcon_password'], 1);
    if ($rcon->connect()) {
        if (is_array($Command)) {
            foreach ($Command as $Key => $CMD) {
                $Respond .= str_replace("/§./", "", $rcon->send_command($CMD));
            }
        } else {
            $Respond = str_replace("/§./", "", $rcon->send_command($Command));
        }
        $Output = array(
            "status" => true,
            "msg" => $Respond
        );
        $rcon->disconnect();
    } else {
        $Output = array(
            "status" => false
        );
    }
    return $Output;
}

;


function getstatus($ip){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://lolipopshop.tk/api/mc.php?ip=".$ip);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
return curl_exec($ch);
}

function RmUserPoint($point) {
    include("database.php");
    $query = query("UPDATE authme SET point = point-{$point} WHERE username = {$_SESSION["username"]}");
    return false;
}
