<?php


namespace Utils\middleware;


class Auth implements IUser
{

    public function handle(): void
    {
        if (!check_auth()) {
            redirect('/login');
        }
    }

}