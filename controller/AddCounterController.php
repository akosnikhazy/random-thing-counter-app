<?php
class AddCounterController extends BaseController
{
    public function handle(): void
    {
        if(!isset($_POST['addcounter'])) exit('no data');
        if(!isset($_POST['addname']) || $_POST['addname'] == '') exit('wrong data');
        
        $pdo = new PDO("sqlite:count.db");

       
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       
        $stmt = $pdo ->prepare('INSERT INTO counter (counter_name) VALUES (:cn)');
        try{
            $stmt -> execute([':cn' => $_POST['addname']]);
            header('location:?view=main&success=added');
            exit();  
         } catch (PDOException $e){
            die('Database error: ' . $e->getMessage());
         }

        

    }
}
