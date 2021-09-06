<?php
$v->layout("_theme"); ?>
<div class="container">
    <div class="row">
        <div class="col">2) Algoritimo de ordenação Bubble Sort</h4></div>
    </div>
    <div class="row">
        <div class="col"><h4>Original Array: <?= $bubble->getArray() ?></h4></div>
    </div>
    <div class="row">
        <div class="col"><h4>Sort Array: <?= $bubble->bubbleSort() ?></h4></div>
    </div>
</div>