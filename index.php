<?php
require_once 'queueClass.php';

$queue = new queue;

$isSubmitted;

$db = $queue->connect();
if($db == null){
    $isSubmitted = false;
}



$queue->pageStart('Кіно');
?>

<div class="card-bg-left">
<p class="card-bg-left">Придбати квиток у кіно</p>
</div>
<div class="card-bg-right">
<div class="card-reg">
    <form class="reg-form" action="submit.php" method="post">
        <label class="reg-form">Імʼя</label>
        <input class="reg-form" type="text" id="name" name="name" placeholder="Введіть імʼя" required>

        <label class="reg-form">Телефон</label>
        <input class="reg-form" type="tel" id="phone" name="phone" pattern="[3]{1}[8]{1}[0-9]{10}" minlength=12 maxlength=12 placeholder="38 (__) __ __ __"
            required>

        <label class="reg-form">Фільм</label>
        <select class="reg-form" name="film" id="select" required>
            <option value="film_1" selected>Фільм 1</option>
            <option value="film_2">Фільм 2</option>
            <option value="film_3">Фільм 3</option>
            <option value="film_4">Фільм 4</option>
            <option value="film_5">Фільм 5</option>
            <option value="film_6">Фільм 6</option>
        </select>

        <div class="tickets">
            <select class="tickets-amount" name="amount" id="amount" required>
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <button id="submit" class="reg-form" type="submit">Придбати</button>
        </div>
    </form>

</div>
</div>

<?php $queue->pageEnd();?>