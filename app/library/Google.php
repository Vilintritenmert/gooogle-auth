<?php

/**
 * Class Google
 */
class Google
{

    /**
     * get Profile Info
     *
     * @param $access_token
     * @return array
     */
    public static function getProfile($access_token)
    {
        $query    = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=$access_token";
        $json     = file_get_contents($query);
        $userInfo = json_decode($json);

        return $userInfo;
    }

    /**
     * Get Contacts
     *
     * @param $access_token
     * @return mixed
     */
    public static function getContacts($access_token)
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Authorization: Bearer $access_token\r\n"
            ]
        ];
        $context = stream_context_create($opts);

        $query = "https://www.google.com/m8/feeds/contacts/default/full?access_token=$access_token&alt=json&max-results=10000";

        $result = file_get_contents($query, false, $context);

        return json_decode($result,1);
    }
}