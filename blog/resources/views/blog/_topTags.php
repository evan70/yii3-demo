<?php

declare(strict_types=1);

/**
 * @var DataReaderInterface|string[][] $tags
 * @var TranslatorInterface            $translator
 * @var UrlGeneratorInterface          $urlGenerator
 * @var WebView                        $this
 */

use Yiisoft\Data\Reader\DataReaderInterface;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

?>
<h4 class="text-muted mb-3">
    <?php
        echo Html::a(
            $translator->translate('layout.tags.top')
        );
    ?>
</h4>
<ul class="list-group mb-3">
    <?php
    $blockBegin = Html::openTag(
    'li',
    ['class' => 'list-group-item d-flex flex-column justify-content-between lh-condensed']
);
    $blockEnd = Html::closeTag('li');
    echo $blockBegin;
    if (count($tags)) {
        foreach ($tags->read() as $tagValue) {
            $label = $tagValue['label'];
            $count = (string) $tagValue['count'];

            echo Html::openTag('div', ['class' => 'd-flex justify-content-between align-items-center']);
            echo Html::a(
                Html::encode($label),
                $urlGenerator->generate('blog/tag', ['label' => $label]),
                ['class' => 'text-muted overflow-hidden']
            ), ' ', Html::span($count, ['class' => 'badge rounded-pill bg-secondary']);
            echo Html::closeTag('div');
        }
    } else {
        echo $translator->translate('tags not found');
    }
    echo $blockEnd;
    ?>
</ul>
