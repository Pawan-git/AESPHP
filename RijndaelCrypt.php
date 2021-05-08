<?php

class AESCrypt {
	
	private $key;
	private $iv;
	private $digest = "md5";
	private $method = "aes-128-cbc";

	public function __construct($password) {
		$this->key = substr(hash($this->digest, $password, true), 0, 32);
		$this->iv = chr(84) . chr(104) . chr(105) . chr(115) . chr(73) . chr(115) . chr(85) . chr(114) . chr(80) . chr(97) . chr(115) . chr(115) . chr(119) . chr(111) . chr(114) . chr(100);
	}

	public function encryptText($plaintext) {
		return base64_encode(openssl_encrypt($plaintext, $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv));
	}

	public function decryptCipher($cipherBase64) {
		return openssl_decrypt(base64_decode($cipherBase64), $this->method, $this->key, OPENSSL_RAW_DATA, $this->iv);
	}

}
