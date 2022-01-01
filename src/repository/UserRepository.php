<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email){
        $stmt = $this->database->connect()->prepare(
            'SELECT u.email, u.account_id, p.pass_hash
            FROM public.users u, public.passwords p
            WHERE  u.email = :email AND u.pass_id_fk = p.pass_id;'
        );
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }

        return new User(
            $user['email'],
            $user['pass_hash'],
            $user['account_id'],
        );



    }

    public function insertUser(string $email, string $password){

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO users (email, account_id)
                VALUES (?,?) RETURNING pass_id_fk AS id;'
        );

        $stmt->execute([
            $email,
            uniqid()
        ]);

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO passwords (pass_id, pass_hash)
                   VALUES (?,?)'
        );

        $stmt->execute([
            $id['id'],
            $password
        ]);

    }


}