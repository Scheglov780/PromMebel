<?php

use app\models\ar\News;

/** @var $news News */

$this->params['breadcrumbs'][] = ['label' => "Все новости", 'url' => ['index']];
$this->params['breadcrumbs'][] = $news->name;

?>

<div class="news-title"><?= $news->name ?></div>
<div class="news-block">
    <?= $news->description ?>
</div>
<div class="date"><?= date('d.m.Y', strtotime($news->created_at)) ?></div>
<style>
    .date {
        margin-top: 40px;
    }
</style>