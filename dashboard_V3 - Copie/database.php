<?php
    $conn = new mysqli('localhost', 'root', '', 'brief_dashboard_v3');

    if(isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'insert':
                for ($i = 0; $i < count($_POST['names']); $i++) {
                    $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
                    $stmt->bind_param("ss", $_POST['names'][$i], $_POST['emails'][$i]);
                    $stmt->execute();
                }
                break;
            case 'update':
                $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                $stmt->bind_param("ssi", $_POST['username'], $_POST['email'], $_POST['id']);
                $stmt->execute();
                break;
            case 'delete':
                $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
                $stmt->bind_param("i", $_POST['id']);
                $stmt->execute();
                break;
        }
    }

    $query = "SELECT id, username, email FROM users";
    if(isset($_GET['order'])){
        $query .= " ORDER BY ".$_GET['columns'][$_GET['order'][0]['column']]['data']." ".$_GET['order'][0]['dir'];
    }
    if(isset($_GET['search']['value']) && !empty($_GET['search']['value'])){
        $query .= " WHERE username LIKE '%".$_GET['search']['value']."%' OR email LIKE '%".$_GET['search']['value']."%' ";
    }

    $result = $conn->query($query);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $data['data'] = $data;
    echo json_encode($data);
