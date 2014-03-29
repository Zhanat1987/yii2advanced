<p>
    Yii обеспечивает удобный способ подключить bootstrap на
    ваших страницах, это делается добавлением одной строки в AppAsset.php,
    расположенного в папке assets:<br />
    <?php
    highlight_string("<?php
public \$depends = [
    'yii\\web\\YiiAsset',
    'yii\\bootstrap\\BootstrapAsset', // this line
    // 'yii\\bootstrap\\BootstrapThemeAsset' // uncomment to apply bootstrap 2 style to bootstrap 3
];
?>");
    ?>
</p>