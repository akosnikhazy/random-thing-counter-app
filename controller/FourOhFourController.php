<?php
class FourOhFourController extends BaseController
{
    public function handle(): void
    {
       
        $this->render('four-oh-four');
    }
}
