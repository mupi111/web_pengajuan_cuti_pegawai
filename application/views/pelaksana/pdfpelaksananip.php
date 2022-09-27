<!DOCTYPE html>
<html>
  <head>
    <title>Print Pengajuan Cuti PNS</title>
    <style type="text/css">
      body {
        font-family: arial;
        background-color: #fff;
      }
      .kop {
        width: 1100px;
        margin: 0 auto;
        padding: 10px;
        border-bottom: 5px solid #000;
        padding: 2px;
      }
      .logo {
        padding-left: 25px;
      }
      .tengah {
        text-align: center;
        line-height: 5px;
      }
      .isi {
        width: 1100px;
        margin: 0 auto;
        padding: 10px;
        padding: 2px;
      }
      table,
      th,
      td {
        border-collapse: collapse;
      }
    </style>
  </head>
  <body>
    <div class="kop">
      <table width="100%">
        <tr>
          <td class="logo"><img src="<?php echo base_url("assets/foto/logo/bnn.jpg");?>" width="130px" /></td>
          <td class="tengah">
            <h1>BADAN NARKOTIKA NASIONAL REPUBLIK INDONESIA</h1>
            <h1>KOTA KEDIRI</h1>
            <h3>Jalan Selomangkleng No. 03 Kota Kediri</h3>
            <h3>Telp : 0354-776226; Call Center : 0354-777333</h3>
            <h3>Sms Center : 0822 3030 9001; Email : bnnkotakediri@gmail.com</h3>
            <h3>Website : www.kedirikota.bnn.go.id</h3>
          </td>
        </tr>
      </table>
    </div>
    <div class="isi">
      <p align="right">Kediri, 08 Agustus 2022</p>
      <p>
        Kepada <br />
        Yth. Kepala BNN Kota Kediri <br />
        di <br />KEDIRI
      </p>
      <p align="center">
        FORMULIR PERMINTAAN DAN PEMBERIAN CUTI <br />
        NOMOR :
      </p>
      <div class="isi form">
        <div class="data">
          <table border="1px" width="100%">
            <tr>
              <td colspan="4">I. DATA PEGAWAI</td>
            </tr>
            <tr>
              <td width="100px">Nama</td>
              <td width="500px"><?= $cuti['nama'] ?></td>
              <td width="100px">NIP/NRP</td>
              <td width="200px"><?= $cuti['nrpnip'] ?></td>
            </tr>
            <tr>
              <td width="100px">Jabatan</td>
              <td width="500px"><?= $cuti['jabatan'] ?></td>
              <td width="100px">Masa Kerja</td>
              <td width="200px"><?= $cuti['masa_kerja'] ?></td>
            </tr>
            <tr>
              <td width="100px">Unit Kerja</td>
              <td colspan="3" width="500px"><?= $cuti['unit_kerja'] ?></td>
            </tr>
          </table>
        </div>
        <br />
        <div class="jenis">
          <table border="1px" width="100%">
            <tr>
              <td colspan="4">II. JENIS CUTI YANG DIAMBIL**</td>
            </tr>
            <tr>
              <td width="400px">1. Cuti Tahunan</td>
              <td align="center"><?= $cuti['jenis_cuti'] == "Cuti Tahunan" ? "✔️" : "" ?></td>
              <td width="400px">2. Cuti Besar</td>
              <td align="center"><?= $cuti['jenis_cuti'] == "Cuti Besar" ? "✔️" : "" ?></td>
            </tr>
            <tr>
              <td width="400px">3. Cuti Sakit</td>
              <td align="center"><?= $cuti['jenis_cuti'] == "Cuti Sakit" ? "✔️" : "" ?></td>
              <td width="400px">4. Cuti Melahirkan</td>
              <td align="center"><?= $cuti['jenis_cuti'] == "Cuti Melahirkan" ? "✔️" : "" ?></td>
            </tr>
            <tr>
              <td width="400px">5. Cuti Karena Alasan Penting</td>
              <td align="center"><?= $cuti['jenis_cuti'] == "Cuti Karena Alasan Penting" ? "✔️" : "" ?></td>
              <td width="400px">6. Cuti di Luar Tanggungan Negara</td>
              <td align="center"><?= $cuti['jenis_cuti'] == "Cuti di Luar Tanggunan Negara" ? "✔️" : "" ?></td>
            </tr>
          </table>
        </div>
        <br />
        <div class="alasan">
          <table border="1px" width="100%">
            <tr>
              <td>III. ALASAN CUTI</td>
            </tr>
            <tr>
              <td><?= $cuti['alasan'] ?></td>
            </tr>
          </table>
        </div>
        <br />
        <div class="lama">
          <table border="1px" width="100%">
            <tr>
              <td colspan="6">IV. LAMANYA CUTI</td>
            </tr>
            <tr>
              <td width="100px">Selama</td>
              <td width="300px" align="center">(<?= $cuti['jmlh_cuti'] ?>/<s>bulan</s><s>tahun)*</s></td>
              <td width="100px" align="center">Mulai Tanggal</td>
              <td width="200px"><?= $cuti['tgl_awal'] ?></td>
              <td width="50px" align="center">s/d</td>
              <td width="150px"><?= $cuti['tgl_akhir'] ?></td>
            </tr>
          </table>
        </div>
        <br />
        <div class="catatan">
          <table border="1px" width="100%">
            <tr>
              <td colspan="5">V. CATATAN CUTI****</td>
            </tr>
            <tr>
              <td colspan="3" width="200px">1. CUTI TAHUNAN</td>
              <td width="210px">2. CUTI BESAR</td>
              <td width="180px"></td>
            </tr>
            <tr>
              <td colspan="1" width="80px" align="center">Tahun</td>
              <td colspan="1" width="50px" align="center">Sisa</td>
              <td colspan="1" width="200px" align="center">Keterangan</td>
              <td colspan="1" width="210px">3. CUTI SAKIT</td>
              <td width="200px"></td>
            </tr>
            <tr>
              <td colspan="1" width="80px">N-2</td>
              <td colspan="1" width="50px"><?= $cuti['sisa_cuti'] ?> Hari</td>
              <td colspan="1" width="200px"></td>
              <td colspan="1" width="210px">4. CUTI MELAHIRKAN</td>
              <td width="180px"></td>
            </tr>
            <tr>
              <td colspan="1" width="80px">N-1</td>
              <td colspan="1" width="50px"></td>
              <td colspan="1" width="200px"></td>
              <td colspan="1" width="210px">5. CUTI KARENA ALASAN PENTING</td>
              <td width="180px"></td>
            </tr>
            <tr>
              <td colspan="1" width="80px">N</td>
              <td colspan="1" width="50px"></td>
              <td colspan="1" width="200px"></td>
              <td colspan="1" width="210px">6. CUTI DI LUAR TANGGUNGAN NEGARA</td>
              <td width="180px"></td>
            </tr>
          </table>
        </div>
        <br />
        <div class="alamat">
          <table border="1px" width="100%">
            <tr>
              <td colspan="3">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
            </tr>
            <tr>
              <td><?= $cuti['alamat_cuti'] ?></td>
              <td width="50px" align="center">Telp</td>
              <td width="350px"><?= $cuti['telp'] ?></td>
            </tr>
            <tr>
              <td align="center">Kepala Sub Bagian Umum</td>
              <td colspan="2" align="center">Hormat Saya,</td>
            </tr>
            <tr colspan="2">
              <td height="75px"></td>
            </tr>
            <tr>
              <td align="center"><b>TRI WULANDARI, SKM</b></td>
              <td colspan="2" align="center"><b>(............................................................)</b></td>
            </tr>
            <tr>
              <td align="center">NRP. 64040066</td>
              <td colspan="2" align="center">NIP. ........................................</td>
            </tr>
          </table>
        </div>
        <br />
        <div class="pertimbangan">
          <table border="1px" width="100%">
            <tr>
              <td colspan="4">VII. PERTIMBANGAN ATASAN LANGSUNG**</td>
            </tr>
            <tr>
              <td>DISETUJUI</td>
              <td>PERUBAHAN****</td>
              <td>DITANGGUHKAN****</td>
              <td>TIDAK DISETUJUI****</td>
            </tr>
            <tr>
              <td align="center" height="20px"><?= $cuti['status'] == "Disetujui" ? "✔️" : "" ?></td>
              <td align="center" height="20px"><?= $cuti['status'] == "Perubahan" ? "✔️" : "" ?></td>
              <td align="center" height="20px"><?= $cuti['status'] == "Ditangguhkan" ? "✔️" : "" ?></td>
              <td align="center" height="20px"><?= $cuti['status'] == "Tidak Disetujui" ? "✔️" : "" ?></td>
            </tr>
          </table>
        </div>
        <div>
          <table border="1px" align="right">
            <tr>
              <td align="center" width="275px">Kepala Sub Bagian Umum</td>
            </tr>
            <tr>
              <td height="75 px"></td>
            </tr>
            <tr>
              <td align="center"><b>TRI WULANDARI, SKM</b></td>
            </tr>
            <tr>
              <td align="center">NIP. 197403132000122004</td>
            </tr>
          </table>
        </div>
        <br>
        <div class="pertimbangan">
          <table border="1px" width="100%">
            <tr>
              <td colspan="4">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI**</td>
            </tr>
            <tr>
              <td>DISETUJUI</td>
              <td>PERUBAHAN****</td>
              <td>DITANGGUHKAN****</td>
              <td>TIDAK DISETUJUI****</td>
            </tr>
            <tr>
              <td align="center" height="20px"><?= $cuti['status'] == "Disetujui" ? "✔️" : "" ?></td>
              <td align="center" height="20px"><?= $cuti['status'] == "Perubahan" ? "✔️" : "" ?></td>
              <td align="center" height="20px"><?= $cuti['status'] == "Ditangguhkan" ? "✔️" : "" ?></td>
              <td align="center" height="20px"><?= $cuti['status'] == "Tidak Disetujui" ? "✔️" : "" ?></td>
            </tr>
          </table>
        </div>
        <div>
          <table border="1px" align="right">
            <tr>
              <td align="center" width="275px">KEPALA BNN KOTA KEDIRI</td>
            </tr>
            <tr>
              <td height="75 px"></td>
            </tr>
            <tr>
              <td align="center"><b>BUNAWAR, SH</b></td>
            </tr>
            <tr>
              <td align="center">NRP. 70040695</td>
            </tr>
          </table>
        </div>
        <br>
        <div class="keterangan">
          <br><br><br><br><br><br>
          <p>
            Catatan : <br>
            *    Coret uang tidak perlu <br>
            **   Pilih salah satu dengan tanda centang <br>
            ***  Diisi oleh pejabat yang menangani bidang kepegawaian sebelum PNS mengajukan cuti <br>
            **** Diberikan tanda centang dan alasanya <br>
            N    = Cuti tahun berjalan <br>
            N-1  = Sisa cuti 1 tahum sebelumnya <br>
            N-2  = Ssisa cuti 2 tahun sebelumnya <br>
          </p>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
  </body>
</html>
