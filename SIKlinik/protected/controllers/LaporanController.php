<?php

class LaporanController extends Controller
{
	public function actionIndex()
    {
        $listDate = [];
        $listPasien = [];
        $listObat = [];

        for($i = 0; $i < 10; $i++) {
            $date = date('Y-m-d',strtotime("-". $i ." days"));
            array_push($listDate, $date);
        }

        foreach($listDate as $date) {
			$data = Yii::app()->db->createCommand()
				->select('count(tanggal_periksa) as jumlah')
				->from('pasien')
				->where('tanggal_periksa=:tanggal_periksa',	 array(':tanggal_periksa' => $date))
				->queryRow();
				
            // $data = Pasien::find()
            //     ->where(['tanggal_periksa' => $date])
            //     ->count();
            
                array_push($listPasien, $data['jumlah']);
        }

		$dataObat = Yii::app()->db->createCommand()
			->select('*')
			->from('obat')
			->queryAll();
		$biayaObat = Yii::app()->db->createCommand()
			->select('obat_id, sum(jumlah) as jumlah')
			->from('biaya_obat')
			->where('status=:status', array(':status' => 1))
			->group('obat_id')
			->queryAll();

        // $dataObat = Obat::find()->all();
        // $biayaObat = (new \yii\db\Query())
        //     ->select(['obat_id','sum(jumlah) as jumlah'])
        //     ->from('biaya_obat')
        //     ->where(['status' => 1])
        //     ->groupBy(['obat_id'])
        //     ->all();

        return $this->render('index', [
            'listDate' => json_encode($listDate),
            'listPasien' => json_encode($listPasien),
            'jumlahObat' => $biayaObat,
            'dataObat' => json_encode($dataObat)
        ]);
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}