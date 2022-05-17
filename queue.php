<?php
require_once 'queueClass.php';

$queue = new queue;

$db = $queue->connect();

$req = $queue->getQueue($db);


$queue->pageStart('Черга');
?>
<link rel="stylesheet" href="css/queue.css">

<table class="qtable">
<th class="qid qitem"> id</th>
<th class="qname qitem"> ім'я </th>
<th class="qphone qitem"> телефон </th>
<th class="qfilm qitem"> фільм </th>
<th class="qamount qitem"> кіль-сть </br> квітків</th>
<th class="qoperator qitem"> оператор </th>
<th class="qstatus qitem"> статус </th>

<?php
foreach($req as $row){
    switch($row['status']){
        case 0:
            $status = 'Не опрацьовано';
            break;
        case 1:
            $status = 'В опрацюванні';
            break;
        case 2:
            $status = 'Опрацьовано';
    }
echo '<tr>';
    echo '<th class="qid qitem">' . $row['id'] . '</th>';
    echo '<th class="qname qitem">' . $row['name'] . '</th>';
    echo '<th class="qphone qitem">' . $row['phone'] . '</th>';
    echo '<th class="qfilm qitem">' . $row['film'] . '</th>';
    echo '<th class="qamount qitem">' . $row['amount'] . '</th>';
    echo '<th class="qoperator qitem">' . $row['operator'] . '</th>';
    echo '<th class="qstatus qitem">' . $status . '</th>';
echo '</tr>';
}

?>

</table>


<?php $queue->pageEnd(); ?>