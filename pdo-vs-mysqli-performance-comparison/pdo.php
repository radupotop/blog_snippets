<?php

$conn = new PDO('mysql:host=localhost;dbname=pdo_mysqli', 'root', 'root');

function insert($i) {
    global $conn;
    
    $stmt = $conn->prepare('insert into users values(:id_user, :id_group, :first_name, :fam_name, :email, :pass)');

    $stmt->bindParam('id_user', $i);
    $stmt->bindValue('id_group', '1');
    $stmt->bindValue('first_name', 'some first name');
    $stmt->bindValue('fam_name', 'some family name');
    $stmt->bindValue('email', 'username@example.org');
    $stmt->bindValue('pass', 'da39a3ee5e6b4b0d3255bfef95601890afd80709');

    return $stmt->execute();
}

function select($i) {
    global $conn;
    
    $stmt = $conn->prepare('select * from users where id_user=:id_user');
    $stmt->bindParam('id_user', $i);

    return $stmt->execute();    
}

function update($i) {
    global $conn;
    
    $stmt = $conn->prepare('update users set first_name=:first_name, fam_name=:fam_name, email=:email, pass=:pass where id_user=:id_user');
    
    $stmt->bindValue('first_name', 'another first name');
    $stmt->bindValue('fam_name', 'another family name');
    $stmt->bindValue('email', 'anotherusername@example.org');
    $stmt->bindValue('pass', 'b858cb282617fb0956d960215c8e84d1ccf909c6');
    $stmt->bindParam('id_user', $i);
    
    return $stmt->execute();
}

function delete($i) {
    global $conn;
    
    $stmt = $conn->prepare('delete from users where id_user=:id_user');
    $stmt->bindParam('id_user', $i);
    
    return $stmt->execute();
}

// bench
$starttime = microtime($get_as_float=true);

for($i=1;$i<=1000000;$i++) {

//    insert($i);


//    select($i);


//    update($i);


//    delete($i);

}

$endtime = microtime($get_as_float=true);

echo $endtime - $starttime;

?>
