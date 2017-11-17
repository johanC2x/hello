<?php

use yii\helpers\Html;
use app\assets\YsummaAsset;
use yii\helpers\Url;

YsummaAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="wrapper">
            <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <center>
                        <img src="<?php echo Yii::getAlias('@web'); ?>/img/ysumma_2.png" width="260" height="50" />
                        </center>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 min</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </nav>
            <!--/. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li>
                            <a class="active-menu" href="<?= Url::to(['/']); ?>">
                                <i class="fa fa-dashboard"></i>Home
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['user/']); ?>">
                                <i class="fa fa-user"></i>Usuarios
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['customer/']); ?>">
                                <i class="fa fa-hand-o-down"></i>Clientes
                            </a>
                        </li>
                         <li>
                            <a href="<?= Url::to(['employees/']); ?>">
                                <i class="fa fa-arrows-alt"></i> Empleados
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['suppliers/']); ?>">
                                <i class="fa fa-phone"></i> Proveedores
                            </a>
                        </li>
                        <li>
                            <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
                        </li>

                        <li>
                            <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>
                        </li>
                        <li>
                            <a href="form.html"><i class="fa fa-edit"></i> Forms </a>
                        </li>


                        <li>
                            <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>

                                    </ul>

                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper">
                <div id="page-inner">
                    <?php echo $content; ?>
                </div>
                <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
