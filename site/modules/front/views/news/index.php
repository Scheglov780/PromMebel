<?php

use app\models\ar\News;

/** @var $news News[] */

//$this->params['breadcrumbs'][] = ['label' => '1111', 'url' => ['index']];

$this->params['breadcrumbs'][] = "Все новости";

?>

<div class="news-title">Все новости</div>
<div class="news-block df jc-fs">
    <?php foreach($news as $new): ?>
        <a href="/news/<?= $new->slug ?>" class="news-item">
            <div class="img-cont" style="background-image: url('<?= $new->getFullImg() ?>')"></div>
            <div class="news-right">
                <div class="news-date"><?= date('d.m.Y', strtotime($new->created_at)) ?></div>
                <div class="news-text"><?= $new->name ?></div>
                <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.6164 9.06595L14.9491 0.383864C14.7017 0.136033 14.372 0 14.0204 0C13.6684 0 13.3388 0.136229 13.0914 0.383864L12.3045 1.17231C12.0573 1.41975 11.9211 1.75025 11.9211 2.10265C11.9211 2.45485 12.0573 2.7965 12.3045 3.04394L17.3608 8.11997H1.29657C0.572288 8.11997 0 8.68795 0 9.41365V10.5283C0 11.254 0.572288 11.8793 1.29657 11.8793H17.4182L12.3047 16.9836C12.0575 17.2315 11.9213 17.553 11.9213 17.9054C11.9213 18.2574 12.0575 18.5836 12.3047 18.8312L13.0916 19.6171C13.339 19.8649 13.6686 20 14.0206 20C14.3722 20 14.7019 19.8632 14.9493 19.6154L23.6166 10.9335C23.8646 10.6849 24.001 10.353 24 10.0002C24.0008 9.64624 23.8646 9.31417 23.6164 9.06595Z"/>
                </svg>
            </div>
        </a>
    <?php endforeach; ?>
</div>