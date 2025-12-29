<?php
class DeleteCounterController extends BaseController
{
    public function handle(): void
    {
        if(!isset($_GET['counter_id'])) exit('no data');
        
        $deleteId = intval($_GET['counter_id']);

        $pdo = new PDO("sqlite:count.db");

       
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       
        $stmt = $pdo ->prepare('DELETE FROM counter WHERE counter_id = :cn');
        try{
            $stmt -> execute([':cn' => $deleteId]);
            header('location:?view=main&success=deleted');
            exit();  
         } catch (PDOException $e){
            die('Database error: ' . $e->getMessage());
         }

        

    }
}
