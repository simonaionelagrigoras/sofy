<?php

class UserHelper{

    public function validateRegistrationData($data)
    {
        if(isset($data['email']) && strlen($data['email']) < 8){

        }

        return [];
    }
}