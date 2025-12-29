<?php
class LoginController extends BaseController
{
    public function handle(): void
    {
        $loggedIn = $this -> login($_POST);

        $error = '';

        if($loggedIn == 'error')
        {
            $errorBox   = new Template('error-box');
            $loginText  = new Text('login');
            
            $errorBox -> tagList['text'] = $loginText -> GetText('error');
            
            $error = $errorBox -> Templating();
        }


        $this->render('login',['error' => $error]);
    }

    private function login($post): string
    {
        if( isset($post['letmein']) )
        {
            $passwordWorker = new Password(APPKEY); 
            
            $userData = explode(':',file_get_contents('auth.yzhk'));

            $testUser     = $post['username'];
            $testPassword = $post['password'];
            
            if($testUser !== $userData[0])
            {
                return 'error';
            }
            else
            {
               
                if($passwordWorker -> testPassword($testPassword,$userData[1],$userData[2]))
                {
                    
                    $user = new User;

                    $user -> createUserSession($userData[0]);

                    header('location:?view=main');
                    exit();
                    
                } else {

                    return 'error';
                } 
                

            }

        }

        return 'no-try';


    }
}
