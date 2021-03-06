<?php
//core model, things that will load on every page, header and footer / Login and Logout
class header extends router{
    private $menu0;
    private $menu1;
    private $menu2;
    public function __construct(){
        $this->loggedin();
        if($this->loggedin){ //list menu items from 1 starting from right to left
            $this->menu[0] = ''; //leave blank if you want nothing in that spot(needs to match up for loggin header)
            $this->menu[1] = '';
            $this->menu[2] = '';
        }
        else{
            $this->menu[0] = '<li><button class="btn btn-primary" data-toggle="modal" data-target="#LogInModal"> Login </button></li>';
            $this->menu[1] = '<li> <button class="btn btn-primary" data-toggle="modal" data-target="#SignUpModal"> Signup </button>&nbsp;&nbsp;</li>';
            $this->menu[2] = '';
        }
    }
}
//  This Class routes all my pages and gathers my needed controller and model files.
class router{
    public $controller;
    public $model;
    public $_GET;
    public $_SESSION;
    public $page;
    public $loggedin;

    protected function loggedin(){
        if(isset($_SESSION['ID'])){
            $this->loggedin = true;
        }
        else{
            $this->loggedin = false;
        }
    }

    public function __construct($page){
        $this->page = $page;
        if($this->page == null){
            $this->page = 'home';
        }
        if(isset($_SESSION['ID'])){
            $this->loggedin = true;
        }
        else{
            $this->loggedin = false;
        }
        if($this->loggedin){
            $this->page = "view/" . $this->page . ".php";
            $this->controller = "controller/" . $this->page . ".php";
            $this->model = "model/" . $this->page . ".php";
        }
        else{
            $this->page = "view/home.php";
        }
    }
}
class create_password{
    /*
 * Password Hashing With PBKDF2 (http://crackstation.net/hashing-security.htm).
 * Copyright (c) 2013, Taylor Hornby
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

// These constants may be changed without breaking existing hashes.
const PBKDF2_HASH_ALGORITHM = 'sha256';
const PBKDF2_ITERATIONS = 1000;
const PBKDF2_SALT_BYTE_SIZE = 24;
const PBKDF2_HASH_BYTE_SIZE = 24;

const HASH_SECTIONS = 4;
const HASH_ALGORITHM_INDEX = 0;
const HASH_ITERATION_INDEX = 1;
const HASH_SALT_INDEX = 2;
const HASH_PBKDF2_INDEX = 3;

/*define("PBKDF2_HASH_ALGORITHM", "sha256");
define("PBKDF2_ITERATIONS", 1000);
define("PBKDF2_SALT_BYTE_SIZE", 24);
define("PBKDF2_HASH_BYTE_SIZE", 24);

define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3); */

    public function __construct($password){
        create_hash($password);
        return true;
    }

    private function create_hash($password)
    {
        // format: algorithm:iterations:salt:hash
        $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" .
        base64_encode(pbkdf2(
            PBKDF2_HASH_ALGORITHM,
            $password,
            $salt,
            PBKDF2_ITERATIONS,
            PBKDF2_HASH_BYTE_SIZE,
            true
        ));
    }
    private function validate_password($password, $correct_hash)
    {
        $params = explode(":", $correct_hash);
        if(count($params) < HASH_SECTIONS)
            return false;
        $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
        return slow_equals(
            $pbkdf2,
            pbkdf2(
                $params[HASH_ALGORITHM_INDEX],
                $password,
                $params[HASH_SALT_INDEX],
                (int)$params[HASH_ITERATION_INDEX],
                strlen($pbkdf2),
                true
            )
        );
    }

// Compares two strings $a and $b in length-constant time.
    private function slow_equals($a, $b)
    {
        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
        {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }

    /*
     * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
     * $algorithm - The hash algorithm to use. Recommended: SHA256
     * $password - The password.
     * $salt - A salt that is unique to the password.
     * $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
     * $key_length - The length of the derived key in bytes.
     * $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
     * Returns: A $key_length-byte key derived from the password and salt.
     *
     * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
     *
     * This implementation of PBKDF2 was originally created by https://defuse.ca
     * With improvements by http://www.variations-of-shadow.com
     */
    private function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
    {
        $algorithm = strtolower($algorithm);
        if(!in_array($algorithm, hash_algos(), true))
            trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
        if($count <= 0 || $key_length <= 0)
            trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

        if (function_exists("hash_pbkdf2")) {
            // The output length is in NIBBLES (4-bits) if $raw_output is false!
            if (!$raw_output) {
                $key_length = $key_length * 2;
            }
            return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }
}
class create_user{
    private $username;
    private $password;
    private $email;

    public function __construct($username, $password, $email){
        if(UserCheck($username, $password)){
            Add_User($username, $password, $email);
        }

    }

    private function UserCheck($Username, $Email){
    global $con;
    $sql1 = "SELECT USERNAME FROM USERS WHERE USERNAME='$Username'";
    $db1 = mysqli_query($con, $sql1);
    while ($data = mysqli_fetch_array($db1)) {
        $return1[] = $data; //Passes entries into return array
    }
    $sql2 = "SELECT EMAIL FROM USERS WHERE EMAIL='$Email'";
    $db2 = mysqli_query($con, $sql2);
    while ($data = mysqli_fetch_array($db2)) {
        $return2[] = $data; //Passes entries into return array
        mysqli_close($con);
    }
    If ($return1 == null AND $return2 == null){
        return True;}
    Else {
        return False;}
}
    private function Add_User($Username, $Password, $Email){
        /*global $con
          $sql = "INSERT INTO `USERS` (`USERNAME`, `PASSWORD`, `EMAIL`) VALUES ('$Username', '$Password', '$Email')";
          mysqli_query($con, $sql);
          mysqli_close($con); */
        $users = R::dispense( 'users' );
        $users->USERNAME = $Username;
        $users->PASSWORD = $Password;
        $users->EMAIL = $Email;
        $id = R::store( $users );
        return True;
    }
}