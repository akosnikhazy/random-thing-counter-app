<?php
class MainController extends BaseController
{
    public function handle(): void
    {
        $text = new Text('main');

      
        $errorSuccess = '';
        if(isset($_GET['success']))
        {

            $successText = '';
            
            $succesTemplate = new Template('success-box');
            
            switch($_GET['success']){
                case 'added':
                    $successText = $text -> GetText('success-added');
                    break;
                case 'counted':
                    $successText = $text -> GetText('success-counted');
                    break;
                case 'deleted':
                    $successText = $text -> GetText('success-deleted');
                    break;
                case 'renamed':
                    $successText = $text -> GetText('success-renamed');
                    break;
                default:
                    $successText = $text -> GetText('success-unknown');
            }

            $succesTemplate -> tagList['text'] =  $successText;


            $errorSuccess = $succesTemplate -> Templating();

        }

        $counters = $text -> GetText('no-counters');

        $pdo = new PDO("sqlite:count.db");

       
        $counterData = $pdo->query('SELECT counter_id, counter_name, counter_last_update, counter_current_total FROM counter ORDER BY counter_last_update DESC');
        
        $counterLine = new Template('main-counter-line');
        $counterHTML = array();
        foreach($counterData as $counter)
        { 
            $counterLine -> tagList['id']         = $counter['counter_id'];
            $counterLine -> tagList['name']       = $counter['counter_name'];
            $counterLine -> tagList['lastupdate'] = $counter['counter_last_update'] ?? $text -> GetText('no-update-yet');
            $counterLine -> tagList['count']      = $counter['counter_current_total'];
            
            $counterHTML[] = $counterLine -> Templating();
        }
       
        $stmt = $pdo ->prepare('INSERT INTO counter (counter_name) VALUES (:cn)');

        $this->render('main', ['errorsuccess' => $errorSuccess,
                               'counters'     =>  empty($counterHTML) ? $counters: $counterHTML]);
    }
}
