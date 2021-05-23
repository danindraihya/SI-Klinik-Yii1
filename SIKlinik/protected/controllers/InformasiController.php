<?php

class InformasiController extends Controller
{
	public function actionIndex()
    {
        $session=new CHttpSession;
  		$session->open();

        // $biayaObat = (new \yii\db\Query())
        //     ->select(['pasien_id', 'sum(total_harga) as total_harga'])
        //     ->from('biaya_obat')
        //     ->where(['status' => 0])
        //     ->groupBy(['pasien_id'])
        //     ->all();

        // $biayaTindakan = (new \yii\db\Query())
        //     ->select(['pasien_id', 'sum(total_harga) as total_harga'])
        //     ->from('biaya_tindakan')
        //     ->where(['status' => 0])
        //     ->groupBy(['pasien_id'])
        //     ->all();

		// $pasienBayar = Yii::app()->db->createCommand()
		// 	->select('o.pasien_id, t.user_id, sum(o.total_harga) as total_harga_obat, sum(t.total_harga) as total_harga_tindakan')
		// 	->from('biaya_obat o')
		// 	->join('biaya_tindakan t', 'o.pasien_id=t.pasien_id')
		// 	->orWhere('o.status=:status', array(':status' => 0,))
		// 	->group('o.pasien_id')
		// 	->queryAll();
        
        $biayaTindakan = Yii::app()->db->createCommand()
            ->select('pasien_id, user_id')
            ->from('biaya_tindakan')
            ->where('status=:status', array(':status' => 0))
            ->group('pasien_id')
            ->queryAll();

        // $pasien = Yii::app()->db->createCommand()
        //     ->select('id')
        //     ->from('pasien')
        //     ->where('status=:status', array(':status' => 0))
        //     ->order('id')
        //     ->queryRow();
        
		$pasienSelesai = Yii::app()->db->createCommand()
			->select('o.pasien_id, t.user_id, sum(o.total_harga) as total_harga_obat, sum(t.total_harga) as total_harga_tindakan')
			->from('biaya_obat o')
			->join('biaya_tindakan t', 'o.pasien_id=t.pasien_id')
			->orWhere('o.status=:status', array(':status' => 1,))
			->group('o.pasien_id')
			->queryAll();

        // $pasienBayar = (new \yii\db\Query())
        //     ->select(['o.pasien_id', 't.pegawai_id', 'sum(o.total_harga) as total_harga_obat', 'sum(t.total_harga) as total_harga_tindakan'])
        //     ->from(['o' => 'biaya_obat'])
        //     ->innerJoin(['t' => 'biaya_tindakan'], '`o`.`pasien_id` = `t`.`pasien_id`')
        //     ->orWhere(['or', ['o.status' => 0], ['t.status' => 0]])
        //     ->groupBy(['o.pasien_id'])
        //     ->all();
        
        // $pasienSelesai = (new \yii\db\Query())
        //     ->select(['o.pasien_id', 't.pegawai_id', 'sum(o.total_harga) as total_harga_obat', 'sum(t.total_harga) as total_harga_tindakan'])
        //     ->from(['o' => 'biaya_obat'])
        //     ->innerJoin(['t' => 'biaya_tindakan'], '`o`.`pasien_id` = `t`.`pasien_id`')
        //     ->orWhere(['or', ['o.status' => 1], ['t.status' => 1]])
        //     ->groupBy(['o.pasien_id'])
        //     ->all();
        
        
        return $this->render('index', [
            'pasienBayar' => $biayaTindakan,
            'pasienSelesai' => $pasienSelesai
        ]);
        
    }

    public function actionUpdate($idPasien, $idUser)
    {
		
		$pasien = Yii::app()->db->createCommand()
			->select('*')
			->from('pasien')
			->where('id=:id', array(':id' => $idPasien))
			->queryRow();

		$user = Yii::app()->db->createCommand()
			->select('*')
			->from('user')
			->where('id=:id', array(':id' => $idUser))
			->queryRow();

		$biayaObat = Yii::app()->db->createCommand()
			->select('*')
			->from('biaya_obat')
			->where('pasien_id=:pasien_id', array(':pasien_id' => $idPasien))
			->andWhere('status=:status', array(':status' => 0))
			->queryAll();

		$biayaTindakan = Yii::app()->db->createCommand()
			->select('*')
			->from('biaya_tindakan')
			->where('pasien_id=:pasien_id', array(':pasien_id' => $idPasien))
			->andWhere('status=:status', array(':status' => 0))
			->queryAll();

        // $pasien = (new \yii\db\Query())
        //     ->from('pasien')
        //     ->where(['id' => $idPasien])
        //     ->one();
        
        // $pegawai = (new \yii\db\Query())
        //     ->from('pegawai')
        //     ->where(['id' => $idPegawai])
        //     ->one();

        // $biayaObat = (new \yii\db\Query())
        //     ->from('biaya_obat')
        //     ->where(['pasien_id' => $idPasien, 'status' => 0])
        //     ->all();

        // $biayaTindakan = (new \yii\db\Query())
        //     ->from('biaya_tindakan')
        //     ->where(['pasien_id' => $idPasien, 'status' => 0])
        //     ->all();

        $session=new CHttpSession;
  		$session->open();

		$session['pasien'] = $pasien;
		$session['user'] = $user;
		$session['biayaObat'] = $biayaObat;
		$session['biayaTindakan'] = $biayaTindakan;

        return $this->render('update', [
            'pasien' => $pasien,
            'user' => $user,
            'biayaObat' => $biayaObat,
            'biayaTindakan' => $biayaTindakan
        ]);
    }

    public function actionPembayaran()
    {
		Yii::app()->db->createCommand()
					->update('biaya_tindakan', array('status' => 1), 'id=:id', array(':id' => $_POST['idPasien']));

		$biayaObat = Yii::app()->db->createCommand()
			->select('*')
			->from('biaya_obat')
			->where('pasien_id=:pasien_id', array(':pasien_id' => $_POST['idPasien']))
			->queryAll();

        // $biayaObat = (new \yii\db\Query())
        //     ->from('biaya_obat')
        //     ->where(['pasien_id' => $request->post('idPasien')])
        //     ->all();
        
        foreach($biayaObat as $data) {
			Yii::app()->db->createCommand()
					->update('biaya_obat', array('status' => 1), 'id=:id', array(':id' => $data['id']));
			
        }

		$biayaTindakan = Yii::app()->db->createCommand()
			->select('*')
			->from('biaya_tindakan')
			->where('pasien_id=:pasien_id', array(':pasien_id' => $_POST['idPasien']))
			->queryAll();

        // $biayaTindakan = (new \yii\db\Query())
        //     ->from('biaya_tindakan')
        //     ->where(['pasien_id' => $request->post('idPasien')])
        //     ->all();
        
        foreach($biayaTindakan as $data) {
			Yii::app()->db->createCommand()
					->update('biaya_tindakan', array('status' => 1), 'id=:id', array(':id' => $data['id']));
        }

        $session=new CHttpSession;
        $session->open();

		$session['totalHarga'] = $_POST['totalHarga'];
		$session['cash'] = $_POST['cash'];

        Yii::app()->db->createCommand()
            ->update('pasien', array('cash' => $_POST['cash']), 'id=:id', array(':id' => $_POST['idPasien']));
        
        Yii::app()->db->createCommand()
            ->update('pasien', array('status' => 1), 'id=:id', array(':id' => $_POST['idPasien']));

        return $this->redirect(['informasi/cetak']);
    }

    public function actionCetak()
    {		
        $session=new CHttpSession;
        $session->open();
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # render (full page)
        // $mPDF1->WriteHTML($this->render('index', array(), true));

        # Load a stylesheet
        // $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        // $mPDF1->WriteHTML($stylesheet, 1);

        # renderPartial (only 'view' of current controller)
        $mPDF1->writeHTML($this->renderPartial('print', array(
             	'pasien' => $session['pasien'],
             	'user' => $session['user'],
         	    'biayaObat' => $session['biayaObat'],
            	'biayaTindakan' => $session['biayaTindakan'],
             	'totalHarga' => $session['totalHarga'],
            	'cash' => $session['cash']), true));
        
        // $mPDF1->writeHTML($this->renderPartial('cetak', array(), true));

        # Renders image
        // $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Outputs ready PDF
        return $mPDF1->Output();


		// $html2pdf = Yii::app()->ePdf->HTML2PDF();
		// $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
		// $html2pdf->output('my.pdf');


        // $session=new CHttpSession;
        // $session->open();

		// $html2pdf = Yii::app()->ePdf->HTML2PDF();
        // $html2pdf->WriteHTML($this->renderPartial('print', array(
		// 	'pasien' => $session['pasien'],
		// 	'pegawai' => $session['pegawai'],
		// 	'biayaObat' => $session['biayaObat'],
		// 	'biayaTindakan' => $session['biayaTindakan'],
		// 	'totalHarga' => $session['totalHarga'],
		// 	'cash' => $session['cash']), true));
        // $html2pdf->Output();

        // $content = $this->renderPartial('print', [
        //     'pasien' => $session->get('pasien'),
        //     'pegawai' => $session->get('pegawai'),
        //     'biayaObat' => $session->get('biayaObat'),
        //     'biayaTindakan' => $session->get('biayaTindakan'),
        //     'totalHarga' => $session->get('totalHarga'),
        //     'cash' => $session->get('cash')
        // ]);
 
        // $pdf = new Pdf([
        //     'mode' => Pdf::MODE_CORE,
        //     'format' => Pdf::FORMAT_A4,
        //     'orientation' => Pdf::ORIENT_PORTRAIT,
        //     'destination' => Pdf::DEST_BROWSER,
        //     'content' => $content,
        //     'options' => []
 
        // ]);

        // Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

        // return $pdf->render();
    }

    public function actionHistory($idPasien, $idUser)
    {
        $pasien = Yii::app()->db->createCommand()
            ->select('*')
            ->from('pasien')
            ->where('id=:id', array(':id' => $idPasien))
            ->queryRow();
        
        $user = Yii::app()->db->createCommand()
            ->select('*')
            ->from('user')
            ->where('id=:id', array(':id' => $idUser))
            ->queryRow();

        $biayaObat = Yii::app()->db->createCommand()
            ->select('*')
            ->from('biaya_obat')
            ->where('pasien_id=:pasien_id', array(':pasien_id' => $idPasien))
            ->queryAll();

        $biayaTindakan = Yii::app()->db->createCommand()
            ->select('*')
            ->from('biaya_tindakan')
            ->where('pasien_id=:pasien_id', array(':pasien_id' => $idPasien))
            ->queryAll();
        
        $totalHarga = 0;
        
        foreach($biayaObat as $obat)
        {
            $totalHarga += $obat['total_harga'];
        }

        foreach($biayaTindakan as $tindakan)
        {
            $totalHarga += $tindakan['total_harga'];
        }

        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # renderPartial (only 'view' of current controller)
        $mPDF1->writeHTML($this->renderPartial('print', array(
            'pasien' => $pasien,
            'user' => $user,
            'biayaObat' => $biayaObat,
           'biayaTindakan' => $biayaTindakan,
            'totalHarga' => $totalHarga,
           'cash' => $pasien['cash']), true));
        
        # Outputs ready PDF
        return $mPDF1->Output();
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