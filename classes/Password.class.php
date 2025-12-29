<?php
class Password {

    private $appkey;

    public function __construct(string $appkey)
    {
        $this -> appkey = $appkey;
    }

    public function createPasswordHash(string $password): array
    {
        $salt = bin2hex(random_bytes(16));

        $hash = $this -> hashPasswordString($password,$salt);

        return [
            'hash' => $hash,
            'salt' => $salt,
        ];
    }

    public function testPassword(string $testPassword, string $passwordHash, string $salt)
    {

        return hash_equals(
                    $this -> hashPasswordString($testPassword,$salt),
                    $passwordHash
                );


    }

    private function hashPasswordString(string $password,string $salt)
    {

        return hash('sha256', $salt . $password . $this -> appkey);

    }
}