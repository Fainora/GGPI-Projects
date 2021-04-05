<?php
    

    $id = $_GET['id'];
    $sortable = $_GET['sortable'];

    $stmt = $db->prepare("UPDATE dashboard SET sortable = :sortable WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':sortable', $sortable);
    $stmt->execute();
?>