<?php

namespace frontend\components;

use Yii;
use Yii\base\component;
use frontend\models\Statistic;

class StatisticRecorder extends Component
{
	const EVENT_AFTER_SOMETHING = 'after accessing item page';

	public function record(){
		$statistic = new Statistic();
        $statistic->attributes = [
            'user_ip' => Yii::$app->request->userIP,
            'user_host' => Yii::$app->request->userHost,
            'path_info' => Yii::$app->request->pathInfo,
            'query_string' => Yii::$app->request->queryString,
        ];
        $statistic->save();
	}
}

?>