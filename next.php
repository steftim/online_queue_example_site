<?php
require_once 'queueClass.php';

$id = !empty($_POST['id']) ? $_POST['id'] : '';
$operator = !empty($_POST['operator']) ? $_POST['operator'] : '';
$empty = !empty($_POST['empty']) ? $_POST['empty'] : '';
$next = !empty($_POST['next']) ? $_POST['next'] : '';

$isSubmitted;

$queue = new queue;
$db = $queue->connect();
if ($db == null) {
    $isSubmitted = false;
} else {
    if($empty == 'false'){
        $queue->updateQueue($db, $id, 2, 0);
    }
    if ($next > 0) {
        $queue->updateQueue($db, $next, 1, $operator);
    }
    
}

?>
<script type="text/javascript">
    document.referrer ? window.location = document.referrer : history.back();
</script>