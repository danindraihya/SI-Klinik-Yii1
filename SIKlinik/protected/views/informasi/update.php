<div>
    <h3>Nama Pasien : </h3><h4><?= $pasien['nama'] ?></h4>

    <h3>Nama Pegawai :</h3><h4><?= $user['nama'] ?></h4>

    <hr>

    <h4>Tindakan</h4>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tindakan</th>
                <th scope="col">Biaya</th>
            </tr>
        </thead>
        <tbody>
    
            <?php
                $hargaTindakan = 0;

                foreach($biayaTindakan as $data) {
                    
                    $tindakan = Yii::app()->db->createCommand()
                        ->from('tindakan')
                        ->where('id=:id', array(':id' => $data['tindakan_id']))
                        ->queryRow();

                        $hargaTindakan += $tindakan['biaya'];

                    ?>
                    <tr>
                        <th scope="row"><?= $tindakan['id'] ?></th>
                        <td><?= $tindakan['nama'] ?></td>
                        <td><?= $tindakan['biaya'] ?></td>
                    </tr>
                    <?php
                }
            ?>
    
        </tbody>
    </table>

    <hr>

    <h4>Obat</h4>
    <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Obat</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total Harga</th>
        </thead>
        <tbody>
            <?php
                $hargaObat = 0;

                foreach($biayaObat as $data) {

                    $obat = Yii::app()->db->createCommand()
                        ->from('obat')
                        ->where('id=:id', array(':id' => $data['obat_id']))
                        ->queryRow();

                        $hargaObat += $obat['harga'] * $data['jumlah'];
                    
                    ?>
                    <tr>
                        <th scope="row"><?= $obat['id'] ?></th>
                        <td><?= $obat['nama'] ?></td>
                        <td><?= $data['jumlah'] ?></td>
                        <td><?= $obat['harga'] * $data['jumlah'] ?></td>
                    </tr>
                    <?php
                }
            ?>

        </tbody>
    </table>
    <br>

        

        <form id='form' onSubmit='return doSubmit()' action="<?php echo Yii::app()->createUrl("informasi/pembayaran"); ?>" method="post">
            <input type="hidden" name="idPasien" value=<?= $pasien['id'] ?>>
            <input type="hidden" name="totalHarga" value=<?= $hargaTindakan + $hargaObat ?>>
            <h5>Total Harga :</h5>
            <input type="number" name="total_pembayaran" class='total-pembayaran' value=<?= $hargaTindakan + $hargaObat ?> disabled>
            <h5>Cash :</h5>
            <input type="number" name="cash" class='cash'>

            <button type="submit" class='btn btn-secondary btn-sm'>Bayar</button>
        </form>
        

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function doSubmit() {
        let cash = parseInt($('.cash').val());
        let total_pembayaran = parseInt($('.total-pembayaran').val());
        console.log(cash);
        if(cash < total_pembayaran) {
            alert('Uang pembayaran kurang !');
            return false;
        } else {
            alert('Mencetak Invoice... ');
            return true;
        }}

    $(document).ready(function() {       

        $('.bayar').on('click', function() {
            let cash = parseInt($('.cash').val());
            let total_pembayaran = parseInt($('.total-pembayaran').val());
            if(cash < total_pembayaran) {
                alert('Uang pembayaran kurang !');
            } else {
                alert('Mencetak Invoice... ');
                $.ajax({
                    responseType: 'arraybuffer',
                    xhrFields: { responseType: 'blob' },
                    url: '<?php echo Yii::app()->createUrl("informasi/pembayaran"); ?>',
                    method: 'post',
                    data: {
                        idPasien: <?= $pasien['id'] ?>,
                        totalHarga: total_pembayaran,
                        cash: cash
                    },
                    success: function(data) {
                        var blob=new Blob([data], {type: 'application/pdf'});
                        var link=document.createElement('a');
                        link.href=window.URL.createObjectURL(blob);
                        link.download="invoice.pdf";
                        link.click();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    });
</script>
