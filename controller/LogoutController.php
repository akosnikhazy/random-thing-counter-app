<?php
class LogoutController extends BaseController
{
    public function handle(): void
    {
        
        session_destroy();

        header('location:?view=login');
        exit();
        
    }

}
