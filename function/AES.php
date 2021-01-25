<?php

require_once 'Rijndael.php';
define('CRYPT_AES_MODE_CTR', -1);
define('CRYPT_AES_MODE_ECB', 1);
define('CRYPT_AES_MODE_CBC', 2);
define('CRYPT_AES_MODE_INTERNAL', 1);
define('CRYPT_AES_MODE_MCRYPT', 2);

class Crypt_AES extends Crypt_Rijndael {

    var $enmcrypt;
    var $demcrypt;

    function Crypt_AES($mode = CRYPT_AES_MODE_CBC) {
        if (!defined('CRYPT_AES_MODE')) {
            switch (true) {
                case extension_loaded('mcrypt'):
                    define('CRYPT_AES_MODE', CRYPT_AES_MODE_MCRYPT);
                    break;
                default:
                    define('CRYPT_AES_MODE', CRYPT_AES_MODE_INTERNAL);
            }
        }
        switch (CRYPT_AES_MODE) {
            case CRYPT_AES_MODE_MCRYPT:
                switch ($mode) {
                    case CRYPT_AES_MODE_ECB:
                        $this->mode = MCRYPT_MODE_ECB;
                        break;
                    case CRYPT_AES_MODE_CTR:
                        $this->mode = 'ctr';
                        break;
                    case CRYPT_AES_MODE_CBC:
                    default:
                        $this->mode = MCRYPT_MODE_CBC;
                }
                break;
            default:
                switch ($mode) {
                    case CRYPT_AES_MODE_ECB:
                        $this->mode = CRYPT_RIJNDAEL_MODE_ECB;
                        break;
                    case CRYPT_AES_MODE_CTR:
                        $this->mode = CRYPT_RIJNDAEL_MODE_CTR;
                        break;
                    case CRYPT_AES_MODE_CBC:
                    default:
                        $this->mode = CRYPT_RIJNDAEL_MODE_CBC;
                }
        }
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_INTERNAL) {
            parent::Crypt_Rijndael($this->mode);
        }
    }

    function setBlockLength($length) {
        return;
    }

    function encrypt($plaintext) {
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->_mcryptSetup();
            if ($this->mode != 'ctr') {
                $plaintext = $this->_pad($plaintext);
            }
            $ciphertext = mcrypt_generic($this->enmcrypt, $plaintext);
            if (!$this->continuousBuffer) {
                mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);
            }
            return $ciphertext;
        }
        return parent::encrypt($plaintext);
    }

    function decrypt($ciphertext) {
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->_mcryptSetup();
            if ($this->mode != 'ctr') {
                $ciphertext = str_pad($ciphertext, (strlen($ciphertext) + 15) & 0xFFFFFFF0, chr(0));
            }
            $plaintext = mdecrypt_generic($this->demcrypt, $ciphertext);
            if (!$this->continuousBuffer) {
                mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
            }
            return $this->mode != 'ctr' ? $this->_unpad($plaintext) : $plaintext;
        }
        return parent::decrypt($ciphertext);
    }

    function _mcryptSetup() {
        if (!$this->changed) {
            return;
        }
        if (!$this->explicit_key_length) {
            $length = strlen($this->key) >> 2;
            if ($length > 8) {
                $length = 8;
            } else if ($length < 4) {
                $length = 4;
            }
            $this->Nk = $length;
            $this->key_size = $length << 2;
        }
        switch ($this->Nk) {
            case 4:
                $this->key_size = 16;
                break;
            case 5:
            case 6:
                $this->key_size = 24;
                break;
            case 7:
            case 8:
                $this->key_size = 32;
        }
        $this->key = substr($this->key, 0, $this->key_size);
        $this->encryptIV = $this->decryptIV = $this->iv = str_pad(substr($this->iv, 0, 16), 16, chr(0));
        if (!isset($this->enmcrypt)) {
            $mode = $this->mode;
            $this->demcrypt = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, '');
            $this->enmcrypt = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, '');
        }
        mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
        mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);
        $this->changed = false;
    }

    function _encryptBlock($in) {
        $state = unpack('N*word', $in);
        $Nr = $this->Nr;
        $w = $this->w;
        $t0 = $this->t0;
        $t1 = $this->t1;
        $t2 = $this->t2;
        $t3 = $this->t3;
        $state = array(
            $state['word1'] ^ $w[0][0],
            $state['word2'] ^ $w[0][1],
            $state['word3'] ^ $w[0][2],
            $state['word4'] ^ $w[0][3]
        );
        for ($round = 1; $round < $this->Nr; $round++) {
            $state = array(
                $t0[$state[0] & 0xFF000000] ^ $t1[$state[1] & 0x00FF0000] ^ $t2[$state[2] & 0x0000FF00] ^ $t3[$state[3] & 0x000000FF] ^ $w[$round][0],
                $t0[$state[1] & 0xFF000000] ^ $t1[$state[2] & 0x00FF0000] ^ $t2[$state[3] & 0x0000FF00] ^ $t3[$state[0] & 0x000000FF] ^ $w[$round][1],
                $t0[$state[2] & 0xFF000000] ^ $t1[$state[3] & 0x00FF0000] ^ $t2[$state[0] & 0x0000FF00] ^ $t3[$state[1] & 0x000000FF] ^ $w[$round][2],
                $t0[$state[3] & 0xFF000000] ^ $t1[$state[0] & 0x00FF0000] ^ $t2[$state[1] & 0x0000FF00] ^ $t3[$state[2] & 0x000000FF] ^ $w[$round][3]
            );
        }
        $state = array(
            $this->_subWord($state[0]),
            $this->_subWord($state[1]),
            $this->_subWord($state[2]),
            $this->_subWord($state[3])
        );
        $state = array(
            ($state[0] & 0xFF000000) ^ ($state[1] & 0x00FF0000) ^ ($state[2] & 0x0000FF00) ^ ($state[3] & 0x000000FF) ^ $this->w[$this->Nr][0],
            ($state[1] & 0xFF000000) ^ ($state[2] & 0x00FF0000) ^ ($state[3] & 0x0000FF00) ^ ($state[0] & 0x000000FF) ^ $this->w[$this->Nr][1],
            ($state[2] & 0xFF000000) ^ ($state[3] & 0x00FF0000) ^ ($state[0] & 0x0000FF00) ^ ($state[1] & 0x000000FF) ^ $this->w[$this->Nr][2],
            ($state[3] & 0xFF000000) ^ ($state[0] & 0x00FF0000) ^ ($state[1] & 0x0000FF00) ^ ($state[2] & 0x000000FF) ^ $this->w[$this->Nr][3]
        );
        return pack('N*', $state[0], $state[1], $state[2], $state[3]);
    }

    function _decryptBlock($in) {
        $state = unpack('N*word', $in);
        $Nr = $this->Nr;
        $dw = $this->dw;
        $dt0 = $this->dt0;
        $dt1 = $this->dt1;
        $dt2 = $this->dt2;
        $dt3 = $this->dt3;
        $state = array(
            $state['word1'] ^ $dw[$this->Nr][0],
            $state['word2'] ^ $dw[$this->Nr][1],
            $state['word3'] ^ $dw[$this->Nr][2],
            $state['word4'] ^ $dw[$this->Nr][3]
        );
        for ($round = $this->Nr - 1; $round > 0; $round--) {
            $state = array(
                $dt0[$state[0] & 0xFF000000] ^ $dt1[$state[3] & 0x00FF0000] ^ $dt2[$state[2] & 0x0000FF00] ^ $dt3[$state[1] & 0x000000FF] ^ $dw[$round][0],
                $dt0[$state[1] & 0xFF000000] ^ $dt1[$state[0] & 0x00FF0000] ^ $dt2[$state[3] & 0x0000FF00] ^ $dt3[$state[2] & 0x000000FF] ^ $dw[$round][1],
                $dt0[$state[2] & 0xFF000000] ^ $dt1[$state[1] & 0x00FF0000] ^ $dt2[$state[0] & 0x0000FF00] ^ $dt3[$state[3] & 0x000000FF] ^ $dw[$round][2],
                $dt0[$state[3] & 0xFF000000] ^ $dt1[$state[2] & 0x00FF0000] ^ $dt2[$state[1] & 0x0000FF00] ^ $dt3[$state[0] & 0x000000FF] ^ $dw[$round][3]
            );
        }
        $state = array(
            $this->_invSubWord(($state[0] & 0xFF000000) ^ ($state[3] & 0x00FF0000) ^ ($state[2] & 0x0000FF00) ^ ($state[1] & 0x000000FF)) ^ $dw[0][0],
            $this->_invSubWord(($state[1] & 0xFF000000) ^ ($state[0] & 0x00FF0000) ^ ($state[3] & 0x0000FF00) ^ ($state[2] & 0x000000FF)) ^ $dw[0][1],
            $this->_invSubWord(($state[2] & 0xFF000000) ^ ($state[1] & 0x00FF0000) ^ ($state[0] & 0x0000FF00) ^ ($state[3] & 0x000000FF)) ^ $dw[0][2],
            $this->_invSubWord(($state[3] & 0xFF000000) ^ ($state[2] & 0x00FF0000) ^ ($state[1] & 0x0000FF00) ^ ($state[0] & 0x000000FF)) ^ $dw[0][3]
        );
        return pack('N*', $state[0], $state[1], $state[2], $state[3]);
    }

}

;
