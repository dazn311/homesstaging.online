<?php

namespace Utils\middleware;


class Guest implements IUser
{
    public function handle(): void
    {
        if (check_auth()) {
            redirect('/');
        }
    }

}