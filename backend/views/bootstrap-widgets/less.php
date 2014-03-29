<h2>
    Использование .less файлов напрямую в Bootstrap
</h2>
<hr />
<p>
    Если вы хотите включить Bootstrap CSS прямо в ваши less файлы, вам может понадобиться отключить оригинальные Bootstrap CSS файлы, которые будут загружены. Вы можете сделать это, установив CSS свойство в [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] пустым. Для этого вам нужно настроить компонент приложения assetManagner следующим образом:<br />
    <?php
    highlight_string("<?php
'assetManager' => [
        'bundles' => [
            'yii\\bootstrap\\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
?>");
    ?>
</p>