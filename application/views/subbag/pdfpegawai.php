<!DOCTYPE html>
<html  lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Print Laporan Data Pegawai</title>
    <style type="text/css">
      body {
        font-family: arial;
        background-color: #fff;
      }
      .kop {
        width: 1000px;
        margin: 0 auto;
        padding: 10px;
        border-bottom: 4px solid #000;
        padding: 2px;
      }
      .logo {
        padding-right: 30px;
      }
      .tengah {
        text-align: center;
        line-height: 5px;
      }
      .isi {
        width: 1000px;
        margin: 0 auto;
        padding: 10px;
        padding: 2px;
      }
      th,
      td {
        text-align: center;
        border-collapse: collapse;
        border: 1px solid #666;
      }
    </style>
  </head>
  <body>
    <div class="kop">
      <table width="97%">
        <tr>
          <!-- <div class="logo"><img src="<?php echo base_url("assets/foto/logo/bnn.jpg");?>" width="130px" /></div> -->
          <div class="tengah">
            <h3>BADAN NARKOTIKA NASIONAL REPUBLIK INDONESIA</h3>
            <h3>KOTA KEDIRI</h3>
            <h5>Jalan Selomangkleng No. 03 Kota Kediri</h5>
            <h5>Telp : 0354-776226; Call Center : 0354-777333</h5>
            <h5>Sms Center : 0822 3030 9001; Email : bnnkotakediri@gmail.com</h5>
            <h5>Website : www.kedirikota.bnn.go.id</h3>
          </div>
        </tr>
      </table>
    </div>
    <div class="isi">
    <?php
    function tgl_indo($tanggal){
	$bulan = array (
		1 =>'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
	    );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }      
    ?>
    <p align="right">Kediri, <?php echo tgl_indo(date('Y-m-d')); ?></p>
      <h5 align="center"><b>
        DAFTAR DATA PEGAWAI
      </b></h5></br>
      <div class="isi">
        <div class="data">
          <table width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIP/NRP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Masa Kerja</th>
                    <th>Unit Kerja</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pegawai as $key => $value):?>
                    <tr>
                      <td><?= $key+1 ?></td>
                      <td><?= $value->nrpnip ?></td>
                      <td><?= $value->nama ?></td>
                      <td><?= $value->jabatan ?></td>
                      <td><?= $value->masa_kerja ?></td>
                      <td><?= $value->unit_kerja ?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
        </div>
      <div class="keterangan">
        <br><br><br><br><br><br>
          <!-- <p>
            Catatan : <br>
            *    Coret uang tidak perlu <br>
            **   Pilih salah satu dengan tanda centang <br>
            ***  Diisi oleh pejabat yang menangani bidang kepegawaian sebelum PNS mengajukan cuti <br>
            **** Diberikan tanda centang dan alasanya <br>
            N    = Cuti tahun berjalan <br>
            N-1  = Sisa cuti 1 tahum sebelumnya <br>
            N-2  = Ssisa cuti 2 tahun sebelumnya <br>
          </p> -->
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
  </body>
</html>
