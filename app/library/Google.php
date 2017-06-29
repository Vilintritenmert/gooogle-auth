<?php

/**
 * Class Google
 */
class Google {

    /**
     * get Profile Info
     *
     * @param $access_token
     * @return mixed
     */
    public static function getProfile($access_token){
        $query = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=$access_token";
        $json = file_get_contents($query);
        $userInfoArray = json_decode($json,true);

        return $userInfoArray;
    }
}