
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo '<h4>' . Yii::t('app', '{icon} CREDITWIDGETS', ['icon' => '<i class="fa fa-users"></i>']) . '</h4>'; ?>
    </div> <!-- panelHeadingEnd -->

    <div class="panel-body">            

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body panel-green">
                    <div class="row panel-row">
                        <div class="col-xs-3">
                            <i class="fa fa-calendar fa-5x fa-inverse"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h1>
                                <?php echo $model->getCreditcalendarcount(); ?>
                            </h1>
                            <h4><?php echo Yii::t('app', 'COUNTRECORDS'); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row panel-footer-row">
                        <a href="/alliance/creditcalendar/calendar">
                            <div class="col-xs-9">
                                <?php echo Yii::t('app', 'NAV_ALLIANCE_CREDITCALENDAR'); ?>
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-right"></i>
                            </div> <!-- col-xs-3 End -->
                        </a> <!-- a href creditcalendar End -->
                    </div> <!-- row panel-footer-tow End -->
                </div> <!-- panelFooter End -->
            </div> <!-- panel panelPrimary End -->
        </div> <!-- col-lg-3 End -->

        <div class="col-lg-4">
            <div class="panel panel-success">
                <div class="panel-body panel-blue">
                    <div class="row panel-row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x fa-inverse"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h1>
                                <?php echo $model->getClientcirculationcount(); ?>
                            </h1>
                            <h4>
                                <?php echo Yii::t('app', 'COUNTRECORDS'); ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row panel-footer-row">
                        <a href="/alliance/clientcirculation/">
                            <div class="col-xs-9">
                                <?php echo Yii::t('app', 'CREDITTRAFFIC'); ?>
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-right"></i>
                            </div> <!-- col-xs-3 End -->
                        </a> <!-- a href creditcalendar End -->
                    </div> <!-- row panel-footer-tow End -->
                </div> <!-- panelFooter End -->
            </div> <!-- panel panelPrimary End -->
        </div> <!-- col-lg-3 End -->

        <div class="col-lg-4">
            <div class="panel panel-warning">
                <div class="panel-body panel-orange">
                    <div class="row panel-row">
                        <div class="col-xs-3">
                            <i class="fa fa-car fa-5x fa-inverse"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h1>
                                <?php echo $model->getClientcirculationcommentcount(); ?>
                            </h1>
                            <h4>
                                <?php echo Yii::t('app', 'COUNTRECORDS'); ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row panel-footer-row">
                        <a href="/alliance/clientcirculationcomment/">
                            <div class="col-xs-9">
                                <?php echo Yii::t('app', 'CREDITEVENTS'); ?>
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-right"></i>
                            </div> <!-- col-xs-3 End -->
                        </a> <!-- a href creditcalendar End -->
                    </div> <!-- row panel-footer-tow End -->
                </div> <!-- panelFooter End -->
            </div> <!-- panel panelPrimary End -->
        </div> <!-- col-lg-3 End -->

    </div> <!-- panelBodyEnd -->
</div> <!-- panelEnd -->