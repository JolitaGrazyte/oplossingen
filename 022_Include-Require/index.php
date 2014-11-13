<?php

$link = mysqli_connect('localhost', 'jolita', 'zN6br4fLYVJ8pSNy', 'web-backend');

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = "SELECT * FROM articles ORDER by ID LIMIT 3";
$result = mysqli_query($link, $query);


$artikels = array();
while ($row = mysqli_fetch_array($result)) {
      $artikels[] = array('title' => $row['title'], 'text' => $row['text'], 'tags' => $row['tags']);  
}

/* free result set */
mysqli_free_result($result);

/* close connection */
mysqli_close($link);


// $artikels = array(

// 	array('title' => 'Titel van artikel 1', 'text' =>  'Tekst van artikel 1', 'tags' => array('tag 1 van artikel 1')),
// 	array('title' => 'Titel van artikel 2', 'text' => 'Tekst van artikel 2', 'tags'=>array('tag 1 van artikel 2', 'tag 2 van artikel 2')),
// 	array('title' => 'Titel van artikel 3', 'text' => 'Tekst van artikel 3', 'tags'=>array('tag 1 van artikel 3', 'tag 2 van artikel 3', 'tag 3 van artikel 3')));

    include('view/header-partial.html');
    include('view/body-partial.html');
    include('view/footer-partial.html');

 ?>