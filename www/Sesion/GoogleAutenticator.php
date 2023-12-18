<?php

class GoogleAuthenticator {
    private $secret;
    
    public function __construct($secret) {
        $this->secret = $secret;
    }
    
    public function generateQRCodeUrl($issuer, $user) {
        $otpauthUrl = 'otpauth://totp/' . $issuer . ':' . $user . '?secret=' . $this->secret . '&issuer=' . $issuer;
        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=' . urlencode($otpauthUrl);
    }
    
    public function verifyCode($code) {
        $time = floor(time() / 30);
        
        for ($i = -1; $i <= 1; $i++) {
            $hash = $this->getCode($time + $i);
            
            if ($hash == $code) {
                return true;
            }
        }
        
        return false;
    }
    
    private function getCode($time) {
        $secretKey = base32_decode($this->secret);
        $time = pack('N*', 0) . pack('N*', $time);
        $hash = hash_hmac('sha1', $time, $secretKey, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncatedHash = substr($hash, $offset, 4);
        $code = unpack('N', $truncatedHash);
        $code = $code[1];
        $code = $code & 0x7FFFFFFF;
        $code = str_pad($code % pow(10, 6), 6, '0', STR_PAD_LEFT);
        
        return $code;
    }
}

?>
