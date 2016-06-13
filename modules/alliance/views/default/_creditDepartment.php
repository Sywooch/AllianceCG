<?php 
    $creditcaledarCountRecords =  $model->getCreditcalendarcount();
    $creditcaledarCountRecords = ($creditcaledarCountRecords > 0) ? $creditcaledarCountRecords : 0;

    $creditTrafficCountRecords =  $model->getClientcirculationcount();
    $creditTrafficCountRecords = ($creditTrafficCountRecords > 0) ? $creditTrafficCountRecords : 0;

    $clientcirculationcommentcount =  $model->getClientcirculationcommentcount();
    $clientcirculationcommentcount = ($clientcirculationcommentcount > 0) ? $clientcirculationcommentcount : 0;
?>

<script type="text/javascript">
    var creditcaledarCountRecords = "<?php echo $creditcaledarCountRecords; ?>";
    var creditTrafficCountRecords = "<?php echo $creditTrafficCountRecords; ?>";
    var clientcirculationcommentcount = "<?php echo $clientcirculationcommentcount; ?>";
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo '<h4>' . Yii::t('app', '{icon} CREDITWIDGETS', ['icon' => '<i class="fa fa-users"></i>']) . '</h4>'; ?>
    </div> <!-- panelHeadingEnd -->

    <div class="panel-body">            
    
        <div class="animAllianceBody">

            <div class="col-lg-4">
                <div class="panel panel-default panel-shadow">
                    <div class="panel-body panel-green">
                        <div class="row panel-row">
                            <div class="col-xs-3">
                                <i class="fa fa-calendar fa-5x fa-inverse"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h1>
                                    <div id="creditCalendar">
                                    </div>
                                </h1>
                                <h4><?php echo Yii::t('app', 'COUNTRECORDS'); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row panel-footer-row">
                            <a href="/alliance/creditcalendar/calendar">
                                <div class="col-xs-9">
                                    <?php echo Yii::t('app', '{icon} NAV_ALLIANCE_CREDITCALENDAR', ['icon' => '<i class="fa fa-calendar"></i>']); ?>
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
                <div class="panel panel-success panel-shadow">
                    <div class="panel-body panel-blue">
                        <div class="row panel-row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x fa-inverse"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h1>
                                    <div id="clientCirculation">
                                    </div>
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
                <div class="panel panel-warning panel-shadow">
                    <div class="panel-body panel-orange">
                        <div class="row panel-row">
                            <div class="col-xs-3">
                                <i class="fa fa-car fa-5x fa-inverse"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <h1>
                                    <div id="clientCirculationCommentCount">
                                    </div>
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
        </div> <!-- animAllianceBody -->

    </div> <!-- panelBodyEnd -->
</div> <!-- panelEnd -->


<div class="col-lg-4">
    <div class="panel panel-default">
    <div class="panel-heading">
        <?php echo '<h4>' . Yii::t('app', '{icon} NAV_ALLIANCE_CREDITCALENDAR', ['icon' => '<i class="fa fa-calendar"></i>']) . '</h4>'; ?>
    </div> <!-- panelHeading End -->
        <div class="panel-body">
            <div id="creditlastcount"></div> <!-- creditLastCount End -->    
        </div> <!-- panelBody End -->
    </div> <!-- panelDefault End -->
</div> <!-- colLg4 End -->

        <div class="col-lg-4">
            <!-- график №2 -->
        </div> <!-- colLg4 End -->
        <div class="col-lg-4">
            <!-- график №3 -->
        </div> <!-- colLg4 End -->
