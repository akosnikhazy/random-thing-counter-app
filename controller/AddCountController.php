<?php
class AddCountController extends BaseController
{
    public function handle(): void
    {
        if(!isset($_GET['counter_id'])) exit('no data');
       
        $counterId = intval($_GET['counter_id']);
        $dateTime = date('Y-m-d H:i:s');

        $pdo = new PDO("sqlite:count.db");

       
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       
        $stmt = $pdo ->prepare('INSERT INTO count (count_counter_id,count_time) VALUES (:cci,:ct)');
        try{
            $stmt -> execute([':cci' => $counterId,
                              ':ct' => $dateTime]);

            $stmt = null;
            
            $stmt = $pdo -> prepare('UPDATE counter SET counter_current_total = counter_current_total+1,counter_last_update = :clu WHERE counter_id = :ci');
            
            $stmt -> execute([':clu' =>  $dateTime,
                              ':ci' => $counterId]);

           
            
            header('location:?view=main&success=counted');
            exit();  
         } catch (PDOException $e){
            die('Database error: ' . $e->getMessage());
         }

        

    }
}
