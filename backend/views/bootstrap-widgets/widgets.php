<?php

use yii\bootstrap\Alert,
    yii\bootstrap\Button,
    yii\bootstrap\ButtonDropdown,
    yii\bootstrap\ButtonGroup,
    yii\bootstrap\Carousel,
    yii\bootstrap\Collapse,
    yii\bootstrap\Dropdown,
    yii\bootstrap\Modal,
    yii\bootstrap\Nav,
    yii\bootstrap\NavBar,
    yii\bootstrap\Progress,
    yii\bootstrap\Tabs;
use backend\assets\BootstrapWidgetsAsset;

BootstrapWidgetsAsset::register($this);
?>
<div class="row">
    <h2>
        yii\bootstrap\Alert
    </h2>
    <a href="http://getbootstrap.com/javascript/#alerts" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#alerts
    </a>
    <?php
    echo Alert::widget([
        'options' => [
            'class' => 'alert-info mb-10',
        ],
        'body' => 'Say hello...',
    ]);
    Alert::begin([
        'options' => [
            'class' => 'alert-warning mb-10',
        ],
    ]);
    echo 'Say hello...';
    Alert::end();
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Button
    </h2>
    <a href="http://getbootstrap.com/javascript/#buttons" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#buttons
    </a>
    <?php
    echo Button::widget([
        'label' => 'Action',
        'options' => ['class' => 'btn-lg mb-10'],
    ]);
    echo Button::widget([
        'label' => 'Save',
        'options' => ['class' => 'btn-lg btn-success mb-10'],
    ]);
    echo Button::widget([
        'label' => 'Info',
        'options' => ['class' => 'btn-info mb-10'],
    ]);
    echo Button::widget([
        'label' => 'Loading state',
        'options' => [
            'class' => 'btn-primary mb-10',
            'id' => 'loading-example-btn',
            'data-loading-text' => 'Loading...',
        ],
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\ButtonDropdown
    </h2>
    <a href="http://getbootstrap.com/javascript/#dropdowns" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#dropdowns
    </a>
    <?php
    echo ButtonDropdown::widget([
        'label' => '<i>Action</i>',
        'dropdown' => [
            'items' => [
                ['label' => 'DropdownA', 'url' => '/'],
                ['label' => 'DropdownB', 'url' => '#'],
            ],
        ],
        'options' => [
            'class' => 'btn-primary mb-10',
        ],
    ]);
    echo ButtonDropdown::widget([
        'label' => '<i>Error</i>',
        'dropdown' => [
            'items' => [
                ['label' => 'DropdownA', 'url' => '#'],
                ['label' => 'DropdownB', 'url' => '#'],
                ['label' => 'DropdownC', 'url' => '#'],
            ],
        ],
        'options' => [
            'class' => 'btn-warning',
        ],
        'split' => true,
        'tagName' => 'a',
        'encodeLabel' => false,
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\ButtonGroup
    </h2>
    <a href="http://getbootstrap.com/components/#btn-groups" target="_blank"
       class="mb-10">
        http://getbootstrap.com/components/#btn-groups
    </a>
    <?php
    // a button group with items configuration
    echo ButtonGroup::widget([
        'buttons' => [
            ['label' => 'A'],
            ['label' => 'B'],
        ]
    ]);
    echo '<br /><br />';
    // button group with an item as a string
    echo ButtonGroup::widget([
        'buttons' => [
            Button::widget(['label' => 'A']),
            ['label' => 'B'],
        ]
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Carousel
    </h2>
    <a href="http://getbootstrap.com/javascript/#carousel" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#carousel
    </a>
    <?php
    echo Carousel::widget([
        'controls' => ['&lsaquo;', '&rsaquo;'],
        'items' => [
            // the item contains only the image
            '<img src="/img/flag.jpeg" alt="Флаг Казахстана" />',
            // equivalent to the above
            ['content' => '<img src="/img/flag2.jpeg" alt="Флаг Казахстана" />'],
            // the item contains both the image and the caption
            [
                'content' => '<img src="/img/gerb.jpeg" alt="Герб Казахстана" />',
                'caption' => '<h4>Герб Казахстана</h4><p>Символ нации</p>',
                'options' => [

                ],
            ],
            // the item contains both the image and the caption
            [
                'content' => '<img src="/img/Flag_of_Kazakhstan.svg" alt="Флаг Казахстана" />',
                'caption' => '<h4>Флаг Казахстана</h4><p>Символ нации</p>',
                'options' => [

                ],
            ],
        ],
        'options' => [
            'style' => 'width: 500px; height: 300px; margin: 0 auto;'
        ],
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Collapse
    </h2>
    <a href="http://getbootstrap.com/javascript/#collapse" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#collapse
    </a>
    <?php
    echo Collapse::widget([
        'items' => [
            // equivalent to the above
            'Collapsible Group Item #1' => [
                'content' => 'Anim pariatur cliche...',
                // open its content by default
                'contentOptions' => ['class' => 'in']
            ],
            // another group item
            'Collapsible Group Item #2' => [
                'content' => 'Anim pariatur cliche...',
                'contentOptions' => [

                ],
                'options' => [

                ],
            ],
        ]
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Dropdown
    </h2>
    <a href="http://getbootstrap.com/javascript/#dropdowns" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#dropdowns
    </a>
    <?php
    echo Dropdown::widget([
        'items' => [
            ['label' => 'DropdownA', 'url' => '#'],
            ['label' => 'DropdownB', 'url' => '#'],
            ['label' => 'DropdownC', 'url' => '#'],
        ],
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Modal
    </h2>
    <a href="http://getbootstrap.com/javascript/#modals" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#modals
    </a>
    <?php
    Modal::begin([
        'header' => '<h2>Hello world</h2>',
        'toggleButton' => ['label' => 'click me'],
    ]);
    echo 'Say hello...';
    Modal::end();
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Nav
    </h2>
    <a href="http://getbootstrap.com/components/#nav" target="_blank"
       class="mb-10">
        http://getbootstrap.com/components/#nav
    </a>
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Home',
                'url' => ['site/index'],
                'linkOptions' => [],
            ],
            [
                'label' => 'Dropdown',
                'items' => [
                    ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Dropdown Header</li>',
                    ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                ],
            ],
        ],
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\NavBar
    </h2>
    <a href="http://getbootstrap.com/components/#navbar" target="_blank"
       class="mb-10">
        http://getbootstrap.com/components/#navbar
    </a>
    <?php
    NavBar::begin(['brandLabel' => 'NavBar Test']);
    echo Nav::widget([
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
        ],
    ]);
    NavBar::end();
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Progress
    </h2>
    <a href="http://getbootstrap.com/components/#progress" target="_blank"
       class="mb-10">
        http://getbootstrap.com/components/#progress
    </a>
    <?php
    // default with label
    echo Progress::widget([
        'percent' => 60,
        'label' => 'test',
    ]);
    // styled
    echo Progress::widget([
        'percent' => 65,
        'barOptions' => ['class' => 'progress-bar-danger']
    ]);
    // striped
    echo Progress::widget([
        'percent' => 70,
        'barOptions' => ['class' => 'progress-bar-warning'],
        'options' => ['class' => 'progress-striped']
    ]);
    // striped animated
    echo Progress::widget([
        'percent' => 70,
        'barOptions' => ['class' => 'progress-bar-success'],
        'options' => ['class' => 'active progress-striped']
    ]);
    // stacked bars
    echo Progress::widget([
        'bars' => [
            ['percent' => 30, 'options' => ['class' => 'progress-bar-danger']],
            ['percent' => 30, 'label' => 'test', 'options' => ['class' => 'progress-bar-success']],
            ['percent' => 35, 'options' => ['class' => 'progress-bar-warning']],
        ]
    ]);
    ?>
</div>
<div class="row">
    <h2>
        yii\bootstrap\Tabs
    </h2>
    <a href="http://getbootstrap.com/javascript/#tabs" target="_blank"
       class="mb-10">
        http://getbootstrap.com/javascript/#tabs
    </a>
    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'One',
                'content' => 'Anim pariatur cliche 1...',
                'active' => true
            ],
            [
                'label' => 'Two',
                'content' => 'Anim pariatur cliche 2...',
                'headerOptions' => [],
                'options' => ['id' => 'myveryownID'],
            ],
            [
                'label' => 'Dropdown',
                'items' => [
                    [
                        'label' => 'DropdownA',
                        'content' => 'DropdownA, Anim pariatur cliche...',
                    ],
                    [
                        'label' => 'DropdownB',
                        'content' => 'DropdownB, Anim pariatur cliche...',
                    ],
                ],
            ],
        ],
    ]);
    ?>
</div>