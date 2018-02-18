<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 17.2.2018
 * Time: 15:30
 */
require_once 'db.php';
require_once './config.php';

class Authenticator
{

    public function __invoke(array $args){
        $db = new DB(getConf()['db']);
        $users = $db->table('user');

        $user = $users->getRowByParam('name', $args['user']);

        return password_verify($args['password'], $user['pass']);
    }
}

class AuthenticatorAdmin
{

    public function __invoke(array $args){
        $db = new DB(getConf()['db']);
        $users = $db->table('user');

        $user = $users->getRowByParam('name', $args['user']);

        if($user['admin']==1) return password_verify($args['password'], $user['pass']);
        else return false;
    }
}