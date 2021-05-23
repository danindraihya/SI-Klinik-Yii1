<?php

class TransaksiController extends Controller
{
	public function actionIndex()
	{
		$antrianPasien = Yii::app()->db->createCommand()
			->select('*')
			->from('pasien')
			->where('status=:status', array(':status' => 0))
			->order('id ASC')
			->queryAll();

		// $antrianPasien = Pasien::find()->where(['status' => 0])->orderBy(['id' => SORT_ASC])->all();
        
        return $this->render('index', ['antrianPasien' => $antrianPasien]);
	}

	public function actionUpdate($id)
	{
		$session=new CHttpSession;
  		$session->open();

        $allTindakan = Yii::app()->db->createCommand()
			->select('*')
			->from('tindakan')
			->queryAll();
        $allObat = Yii::app()->db->createCommand()
			->select('*')
			->from('obat')
			->queryAll();
		$pasien = Yii::app()->db->createCommand()
			->select('*')
			->from('pasien')
			->where('id=:id', array(':id' => $id))
			->queryRow();
		$users = Yii::app()->db->createCommand()
			->select('*')
			->from('user')
			->queryAll();
		$biayaObat = Yii::app()->db->createCommand()
			->select('*')
			->from('biaya_obat')
			->where('pasien_id=:pasien_id', array(':pasien_id' => $id))
			->queryAll();
		$biayaTindakan = Yii::app()->db->createCommand()
			->select('*')
			->from('biaya_tindakan')
			->where('pasien_id=:pasien_id', array(':pasien_id' => $id))
			->queryAll();

        foreach($biayaTindakan as $tindakan) {
			$dataTindakan = Yii::app()->db->createCommand()
				->select('*')
				->from('tindakan')
				->where('id=:id', array(':id' => $tindakan['tindakan_id']))
				->queryRow();

                if($session['tindakan']) {
                    $data = $session['tindakan']; 
                    $data[strval($dataTindakan['id'])] = [
                        'id' => $dataTindakan['id'],
                        'nama' => $dataTindakan['nama'],
                        'biaya' => $dataTindakan['biaya']
                    ];
                    $session['tindakan'] = $data;
                } else {
                    $session['tindakan'] = array(
                        $dataTindakan['id'] => [
                            'id' => $dataTindakan['id'],
                            'nama' => $dataTindakan['nama'],
                            'biaya' => $dataTindakan['biaya']
                        ]
                    );
                }

			
        }

        foreach($biayaObat as $obat) {
			$dataObat = Yii::app()->db->createCommand()
				->select('*')
				->from('obat')
				->where('id=:id', array(':id' => $obat['obat_id']))
				->queryRow();

            $dataBiayaObat = Yii::app()->db->createCommand()
                ->select('*')
                ->from('biaya_obat')
                ->where('obat_id=:obat_id', array(':obat_id' => $dataObat['id']))
                ->andWhere('pasien_id=:pasien_id', array(':pasien_id' => $pasien['id']))
                ->queryRow();
                
                if($session['obat']) {
                    $data = $session['obat']; 
                    $data[strval($dataObat['id'])] = [
                        'id' => $dataObat['id'],
                        'nama' => $dataObat['nama'],
                        'jumlah' => $dataBiayaObat['jumlah'],
                        'harga' => $dataObat['harga']
                    ];
                    $session['obat'] = $data;
                } else {
                    $session['obat'] = array(
                        $dataObat['id'] => [
                            'id' => $dataObat['id'],
                            'nama' => $dataObat['nama'],
                            'jumlah' => $dataBiayaObat['jumlah'],
                            'harga' => $dataObat['harga']
                        ]
                    );
                }
                
			
        }




        return $this->render('update', [
            'allTindakan' => $allTindakan,
            'allObat' => $allObat,
            'pasien' => $pasien,
            'users' => $users,
            'biayaObat' => $biayaObat,
            'biayaTindakan' => $biayaTindakan
        ]);
	}

	public function actionTambahTindakan()
    {

        $session=new CHttpSession;
  		$session->open();

        $tindakan = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tindakan')
            ->where('id=:id', array(':id' => $_POST['id']))
            ->queryRow();

        if($session['tindakan']) {
            $data = $session['tindakan']; 
            $data[strval($_POST['id'])] = [
                'id' => $tindakan['id'],
                'nama' => $tindakan['nama'],
                'biaya' => $tindakan['biaya']
            ];
            $session['tindakan'] = $data;
        } else {
            $session['tindakan'] = [
                $_POST['id'] => [
                    'id' => $tindakan['id'],
                    'nama' => $tindakan['nama'],
                    'biaya' => $tindakan['biaya']
                ]
                ];
        }
        return $this->renderJSON($session['tindakan']);
    }

    public function actionHapusTindakan()
    {
        $session=new CHttpSession;
  		$session->open();

        $data = $session['tindakan'];
        unset($data[strval($_POST['id'])]);
        $session['tindakan'] = $data;

        if($session['tindakan'] == []) {
            $session->remove('tindakan');
        }

        return $this->renderJSON($session['tindakan']);
    }

    public function actionTambahObat()
    {
        $session=new CHttpSession;
  		$session->open();

        $obat = Yii::app()->db->createCommand()
          ->select('*')
          ->from('obat')
          ->where('id=:id', array(':id' => $_POST['id']))
          ->queryRow();

        if($session['obat']) {
            $data = $session['obat']; 
            $data[strval($_POST['id'])] = [
                'id' => $obat['id'],
                'nama' => $obat['nama'],
                'jumlah' => $_POST['jumlah'],
                'harga' => $obat['harga']
            ];
            $session['obat'] = $data;
        } else {
            $session['obat'] = [
                $_POST['id'] => [
                    'id' => $obat['id'],
                    'nama' => $obat['nama'],
                    'jumlah' => $_POST['jumlah'],
                    'harga' => $obat['harga']
                ]
            ];
        }

        return $this->renderJSON($session['obat']);
    }

    public function actionHapusObat()
    {

        $session=new CHttpSession;
  		$session->open();        

        $data = $session['obat'];
        unset($data[strval($_POST['id'])]);
        $session['obat'] = $data;

        if($session['obat'] == []) {
            $session->remove('obat');
        }

        return $this->renderJSON($session['obat']);
    }

	public function actionSubmitTransaksi()
	{
		$session=new CHttpSession;
  		$session->open();
        $total_harga = 0;

        $biayaTindakan = Yii::app()->db->createCommand()
            ->delete('biaya_tindakan', 'pasien_id=:pasien_id', array(':pasien_id' => $_POST['idPasien']));

		
        // $biayaTindakan = BiayaTindakan::deleteAll('pasien_id = ' . $idPasien);

        if($session['obat']) {
            
            foreach($session['obat'] as $obat) {
                $newData = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('biaya_obat')
                    ->where('obat_id=:obat_id', array(':obat_id' => $obat['id']))
                    ->andWhere('pasien_id=:pasien_id', array(':pasien_id' => $_POST['idPasien']))
                    ->queryRow();

                if(!$newData) {
                    $biayaObat = new BiayaObat();

                    $biayaObat->obat_id = $obat['id'];
                    $biayaObat->pasien_id = $_POST['idPasien'];
                    $biayaObat->jumlah = $obat['jumlah'];
                    $biayaObat->total_harga = $obat['harga'] * $obat['jumlah'];
                    $biayaObat->tanggal_periksa = date('Y-m-d');
                    $biayaObat->save();
                }elseif($newData['jumlah'] != $obat['jumlah']) {
                    Yii::app()->db->createCommand()
                        ->update('biaya_obat', array('jumlah' => $obat['jumlah'], 'total_harga' => $obat['harga'] * $obat['jumlah']), 'id=:id', array(':id' => $newData['id']));
                }
            }

            $session->remove('obat');
        }

        if($session['tindakan']) {
            foreach($session['tindakan'] as $tindakan) {

                $newData = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('biaya_tindakan')
                    ->where('tindakan_id=:tindakan_id', array(':tindakan_id' => $tindakan['id']))
                    ->andWhere('pasien_id=:pasien_id', array(':pasien_id' => $_POST['idPasien']))
                    ->queryRow();
                
                if(!$newData){
                    $biayaTindakan = new BiayaTindakan();

                    $biayaTindakan->pasien_id = $_POST['idPasien'];
                    $biayaTindakan->user_id = $_POST['idUser'];
                    $biayaTindakan->tindakan_id = $tindakan['id'];
                    $biayaTindakan->total_harga = $tindakan['biaya'];
                    $biayaTindakan->tanggal_periksa = date('Y-m-d');
                    $biayaTindakan->save();
                }
                
            }

            $session->remove('tindakan');
        }

        $session->close();

        // $pasien = Yii::app()->db->createCommand()
        //     ->select('*')
        //     ->from('pasien')
        //     ->where('id=:id', array(':id' => $_POST['idPasien']))
        //     ->queryRow();

        return $this->redirect(['informasi/index', 
            'idPasien' => $_POST['idPasien']
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