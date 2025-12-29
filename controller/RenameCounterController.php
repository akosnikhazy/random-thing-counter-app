<?php
class RenameCounterController extends BaseController
{
    public function handle(): void
    {
        if(!isset($_POST['counter_id'])) exit('no data');
        if(!isset($_POST['newname']) || $_POST['newname'] == '') exit('bad data');
      
        $renameId = intval($_POST['counter_id']);

        $pdo = new PDO("sqlite:count.db");

       
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       
        $stmt = $pdo ->prepare('UPDATE counter SET counter_name = :cn WHERE counter_id = :ci');
        try{
            $stmt -> execute([':cn' => $_POST['newname'],
                              ':ci' => $renameId]);

            header('location:?view=main&success=renamed');
            exit();

         } catch (PDOException $e){
            die('Database error: ' . $e->getMessage());
         }

        

    }
}
