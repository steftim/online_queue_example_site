<?php
require_once 'queueClass.php';

$param = $_SERVER['QUERY_STRING'];
parse_str($param, $param);

$queue = new queue;

$db = $queue->connect();

$row = $queue->getActiveRequestOP($db, $param['operator']);

$queue->pageStart('Черга');
?>
<div class="column">
    <link rel="stylesheet" href="css/queue.css">
    <?php if($row != null){
    echo '<table class="qtable">'
        .'<th class="qid qitem"> id</th>'
        .'<th class="qname qitem"> ім\'я </th>'
        .'<th class="qphone qitem"> телефон </th>'
        .'<th class="qfilm qitem"> фільм </th>'
        .'<th class="qamount qitem"> кіль-сть </br> квітків</th>'
        .'<th class="qoperator qitem"> оператор </th>'
        .'<th class="qstatus qitem"> статус </th>';
        ?>
        <?php
        switch ($row['status']) {
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

        ?>

    </table>
    <?php 
    $next = $queue->Unprocessed($db);
    echo '<div class="navigate">'
    .'<div class="spacer"></div>'
    .'<form class="reg-form" action="next.php" method="post">'
        .'<input name="id" value='.$row['id'].' type="hidden"></input>'
        .'<input name="empty" value=false type="hidden"></input>'
        .'<input name="operator" value='.$param['operator'].' type="hidden"></input>'
        .'<input name="next" value='.$next.' type="hidden"></input>'
        .'<button type="submit" class="reg-form">Обробити</button>'
    .'</form>'
    .'</div>';
    }else{
        echo 'Немає вільних заявок.';
        $next = $queue->Unprocessed($db);
        if($next != 0){
        echo '<div class="navigate">'
        .'<div class="spacer"></div>'
        .'<form class="reg-form" action="next.php" method="post">'
            .'<input name="id" value=0 type="hidden"></input>'
            .'<input name="empty" value=true type="hidden"></input>'
            .'<input name="operator" value='.$param['operator'].' type="hidden"></input>'
            .'<input name="next" value='.$next.' type="hidden"></input>'
            .'<button type="submit" class="reg-form">Взяти заявку</button>'
        .'</form>'
        .'</div>';
        }
    }
?>
<div class="navigate">
    <?php 
    if(($param['operator'] - 1) != 0){
             echo "<button onclick=\"document.location='/operator.php?operator=". ($param['operator'] - 1) ."'\" class=\"reg-form\">Попередній</button>";
      } 
      echo '<div class="spacer"></div>';
      
    if(($param['operator'] + 1) <= 4){
        echo "<button onclick=\"document.location='/operator.php?operator=". ($param['operator'] + 1) ."'\" class=\"reg-form\">Наступний</button>";
 } ?>
 </div>


 

<?php $queue->pageEnd(); ?>