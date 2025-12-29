<?php
abstract class BaseController
{
    protected function render(string $viewName, array $data = []): void
    {
        $template = new Template($viewName);
        
        $template -> tagList = $data;
    
        exit(
            $template->Templating()
        );
    }
}
