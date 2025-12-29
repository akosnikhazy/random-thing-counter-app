<?php
class Router {
    private $view;
	
    private const CONTROLLERS = [
			'main'			     => MainController::class,
            'addcounter'         => AddCounterController::class,
            'addcount'           => AddCountController::class,
            'deletecounter'      => DeleteCounterController::class,
            'renamecounter'      => RenameCounterController::class,
            'login'              => LoginController::class,
            'logout'             => LogoutController::class,
            'four-oh-four'       => FourOhFourController::class,
    ];
  
    public function __construct(string $requestedView)
    {
		
        $rawViewName = strtolower(filter_var($requestedView, FILTER_SANITIZE_STRING));
      
        $this->view = (array_key_exists($rawViewName,self::CONTROLLERS))
                      ?$rawViewName
                      :'four-oh-four';
      
    }

    

    public function route(): void
    {
		
        $controller = new (self::CONTROLLERS[$this->view])();
		
        $controller->handle();
    }
}
