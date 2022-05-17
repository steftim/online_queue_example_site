<?php 
    require_once 'queueClass.php';

    $name = !empty($_POST['name']) ? $_POST['name'] : '';
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
    $film = !empty($_POST['film']) ? $_POST['film'] : '';
    $amount = !empty($_POST['amount']) ? $_POST['amount'] : '';


$isSubmitted;

$queue = new queue;
$db = $queue->connect();
$status = null;
if($db != null){
    $status = $queue->addQueue($db, $name, $phone, $film, $amount);
}


$queue->pageStart('Ваша заявка прийнята');
?>
            <div class="answer">
                <span><p>
                    <?php
                        if($status == null){
                            echo 'Вибачте сталася помилка, спробуйте пізніше.';
                        }else if($status == 177013){
                            echo 'Ви вже подавали заявку, почекайте поки її оброблять.';
                        }else{
                            echo 'Ваше заявка прийнята, чекайте дзівнка від оператора.';
                        }
                    ?></p></span>
            </div>

<?php $queue->pageEnd();?>