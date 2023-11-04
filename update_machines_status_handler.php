<?php 

include 'config.php';

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

foreach ($data as $row) {
    $id = $row["id"];
    $is_active = $row["is_active"];
    
    // SQL-запрос на обновление данных в таблице (замените table_name на имя вашей таблицы)
    $update_user_sql = "UPDATE machines SET is_active = :is_active WHERE id = :id";

    $update_stmt = $pdo->prepare($update_user_sql);
    $update_stmt->bindParam(':is_active', $is_active);
    $update_stmt->bindParam(':id', $id);
    $update_stmt->execute();
}
echo 'ok';
?>