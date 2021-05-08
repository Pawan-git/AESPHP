<?php

class AESCrypt {
	
	private $key;
	private $iv_str = "ThisIsUrPassword"; // 16 character private key
	private $digest = "md5";
	private $method = "aes-128-cbc";
	public function __construct($password) {
		$this->key = substr(hash($this->digest, $password, true), 0, 32);
		$this->iv = $this->_generateIV($this->iv_str);
	}

	private function _generateIV($str){
		$byte = '';
		for($i = 0; $i < mb_strlen($str, 'ASCII'); $i++)
		{
		   $byte .= chr(ord($str[$i]));
		}
		return $byte;
	}

	public function encryptText($plaintext) {
		return base64_encode(openssl_encrypt($plaintext, $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv));
	}

	public function decryptCipher($cipherBase64) {
		return openssl_decrypt(base64_decode($cipherBase64), $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv);
	}

}
