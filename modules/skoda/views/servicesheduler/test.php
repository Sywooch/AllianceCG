<?php

use yii\helpers\Json;

$items = Yii::$app->db->createCommand("SELECT DISTINCT(`responsible`) AS worker, COUNT(sk_statusmonitor.regnumber) AS carcount FROM sk_servicesheduler INNER JOIN sk_statusmonitor ON date = DATE_FORMAT(`to`, '%Y-%m-%d') AND YEAR(date) = YEAR(NOW()) AND MONTH(date) = MONTH(NOW()) GROUP BY worker")->queryAll();

echo Json::encode($items);