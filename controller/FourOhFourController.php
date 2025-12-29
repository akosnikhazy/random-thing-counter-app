<?php
class FourOhFourController extends BaseController
{
    public function handle(): void
    {
        $foo = 'fooaaa';
        $this->render('four-oh-four', ['content' => $foo]);
    }
}
