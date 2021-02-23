<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\TemplateAsset;
use backend\assets\AwesomeAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

TemplateAsset::register($this);
AppAsset::register($this);
AwesomeAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <?= Html::a(
            '<!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">' . \Yii::$app->name . '</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">' . \Yii::$app->name . '</span>',
            Url::to(Yii::$app->homeUrl, true), ['class' => 'logo']); ?>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <?= Html::a('<i class="fa fa-sign-out" aria-hidden="true"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'sing-out']); ?>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <li class="header">MAIN NAVIGATION</li>
            <?php Menu::begin([

                'options' => [
                    'class' => 'nav-menu',
                ],
            ]);
            $menuItems[] = [
                'label' => '<i class="fa fa-dashboard"></i><span>Dashboard</span>',
                'url' => ['/site/index'],
                'options' => ['class' => 'treeview']
            ];
            $menuItems[] = [
                'label' => '<i class="fa fa-user" aria-hidden="true"></i><span>Users</span>',
                'url' => null,
                'items' => [
                    [
                        'label' => '<i class="fa fa-circle-o"></i><span> Administrators</span>',
                        'url' => ['/users/index?role=admin'],
                    ],
                    // [
                    //     'label' => '<i class="fa fa-circle-o"></i><span>Customers</span>',
                    //     'url' => ['/users/index?role=customer'],
                    // ],
                ],
                'options' => ['class' => 'treeview'],
                'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>'
            ];
//             $menuItems[] = [
//                 'label' => '
// <i class="fa fa-align-justify" aria-hidden="true"></i><span>Categories</span>',
//                 'url' => ['/categories/index'],
//                 'options' => ['class' => 'treeview']
//             ];
            $menuItems[] = [
                'label' => '
<i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Blog</span>',
                'url' => ['/blog/index'],
                'options' => ['class' => 'treeview']
            ];
            $menuItems[] = [
                'label' => '
<i class="fa fa-suitcase" aria-hidden="true"></i><span>Tours</span>',
                'url' => ['/tours/index'],
                'options' => ['class' => 'treeview']
            ];
            $menuItems[] = [
                'label' => '
<i class="fa fa-female" aria-hidden="true"></i><span>Guides</span>',
                'url' => ['/guides/index'],
                'options' => ['class' => 'treeview']
            ];
              $menuItems[] = [
                'label' => '
<i class="fa fa-user-circle-o"></i><span>Team</span>',
                'url' => ['/team/index'],
                'options' => ['class' => 'treeview']
            ];
            $menuItems[] = [
                'label' => '
<i class="fa fa-building" aria-hidden="true"></i><span>Accommodations</span>',
                'url' => ['/accommodations/index'],
                'options' => ['class' => 'treeview']
            ];
             $menuItems[] = [
                'label' => '
<i class="fa fa-comment" aria-hidden="true"></i><span>Feedbacks</span>',
                'url' => ['/feedbacks/index'],
                'options' => ['class' => 'treeview']
            ];
          
               $menuItems[] = [
                'label' => '<i class="fa fa-picture-o" aria-hidden="true"></i><span>Gallery</span>',
                'url' => null,
                'items' => [
                    [
                        'label' => '<i class="fa fa-camera-retro"></i><span>Photos</span>',
                        'url' => ['/gallery/index?type=photos'],
                    ],
                   [
                         'label' => '<i class="fa fa-video-camera"></i><span>Videos</span>',
                         'url' => ['/gallery/index?type=videos'],
                     ],
                ],
                'options' => ['class' => 'treeview'],
                'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>'
            ];
            $menuItems[] = [
                'label' => '<i class="fa fa-th" aria-hidden="true"></i><span>Blocks</span>',
                'url' => ['/blocks/index'],
                'options' => ['class' => 'treeview']
            ];
            

            echo Menu::widget([

                'options' => ['class' => 'sidebar-menu'],
                'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                'encodeLabels' => false,
                'activateParents' => true,
                'items' => $menuItems,
            ]);
            Menu::end(); ?>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="controller-name">
                <?= Yii::$app->controller->id; ?>
                <small>Control panel</small>
            </h1>

            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => Yii::t('yii', Yii::$app->controller->id),
                    'url' => Url::base() . '/' . Yii::$app->controller->id . '/index',
                    'template' => "<li><b class='controller-name'>{link}</b></li>\n",
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
            ?>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <?= Alert::widget() ?>
                    <?= $content; ?>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <!-- /.content-wrapper -->
    </div>
    <footer class="main-footer">
        Copyright &copy; <?= date('Y') ?> INLITE-GROUP All rights reserved.
    </footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
