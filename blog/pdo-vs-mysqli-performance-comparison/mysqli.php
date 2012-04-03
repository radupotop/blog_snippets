<?php

$conn = new mysqli('localhost', 'root', 'root', 'pdo_mysqli');

function insert($i) {
    global $conn;
    
    $stmt = $conn->prepare('insert into users values(?, ?, ?, ?, ?, ?)');

    $id_group='1';
    $first_name='some first name';
    $fam_name='some family name';
    $email='username@example.org';
    $pass='da39a3ee5e6b4b0d3255bfef95601890a';

    $stmt->bind_param('iissss', $i, $id_group, $first_name, $fam_name, $email, $pass);

    return $stmt->execute();
}

function select($i) {
    global $conn;
    
    $stmt = $conn->prepare('select * from users where id_user=?');
    $stmt->bind_param('i', $i);

    return $stmt->execute();    
}

function update($i) {
    global $conn;
    
    $stmt = $conn->prepare('update users set first_name=?, fam_name=?, email=?, pass=? where id_user=?');
    
    $first_name='another first name';
    $fam_name='another family name';
    $email='anotherusername@example.org';
    $pass='b858cb282617fb0956d960215c8e84d1ccf909c6';

    $stmt->bind_param('ssssi', $first_name, $fam_name, $email, $pass, $i);
    
    return $stmt->execute();
}

function delete($i) {
    global $conn;
    
    $stmt = $conn->prepare('delete from users where id_user=?');
    $stmt->bind_param('i', $i);
    
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
