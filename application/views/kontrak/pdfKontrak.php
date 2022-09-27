<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Cetak PPNPN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style type="text/css">
        body {
            font-family: arial;
            background-color: #fff;
        }

        .kop {
            width: 1000px;
            margin: 0 auto;
            padding: 10px;
            /* border-bottom: 3px solid #000; */
            padding: 2px;
        }

        .logo {
            padding-left: 25px;
        }

        .tengah {
            line-height: 5px;
        }

        .isi {
            width: 1000px;
            margin: 0 auto;
            padding: 10px;
            padding: 2px;
        }

        table,
        th,
        td {
            border-collapse: collapse;
        }

        .garis {
            width: 380px;
            height: 1px;
            border-top: 3px solid black;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="kop">
            <table>
                <tr>
                    <td class="tengah">
                        <h4>BADAN NARKOTIKA NASIONAL</h4>
                        <h4 align="center">KOTA KEDIRI</h4>
                        <div class="garis"></div>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="isi">
            <u>
                <h5 align="center">SURAT IJIN</h5>
            </u>
            </p>
            <div class="isi form">
                <div class="data">
                    <table width="100%">
                        <tr>
                            <td colspan="4">Saya yang bertanda tangan di bawah ini mengajukan permohonan ijin sebagai berikut : </td>
                        </tr>
                        <tr>
                            <td width="150px">&nbsp; 1. &nbsp; Nama</td>
                            <td> : &nbsp; </td>
                        </tr>
                        <tr>
                            <td width="150px">&nbsp; 2. &nbsp; NRP/NIP</td>
                            <td> : &nbsp; </td>
                        </tr>
                        <tr>
                            <td width="150px">&nbsp; 3. &nbsp; Unit Kerja</td>
                            <td> : &nbsp; </td>
                        </tr>
                        <tr>
                            <td width="150px">&nbsp; 4. &nbsp; Keperluan</td>
                            <td> : &nbsp; <?php echo date("Y"); ?> </td>
                        </tr>
                        </tr>
                        <tr colspan="3">
                            <td height="50px"></td>
                        </tr>
                        <tr>
                            <td width="150px">&nbsp; 5. &nbsp; Hari/Tanggal</td>
                            <td> : &nbsp; </td>
                        </tr>
                    </table>
                </div>
                <br />
                <div class="data-ijin">
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td width="100px">Kediri, </td>
                            <td width="300px"></td>
                        </tr>
                        <tr>
                            <td align="center"></td>
                            <td colspan="2" align="center">Pemohon</td>
                        </tr>
                        <tr colspan="3">
                            <td height="75px"></td>
                        </tr>
                        <tr>
                            <td align="center"><b></b></td>
                            <td colspan="2" align="center">(...........................................................................)</td>
                        </tr>
                        <tr>
                            <td align="center"></td>
                            <td colspan="2">NRP/NIP.</td>
                        </tr>
                    </table>
                </div>
                <br />
                <div class="alamat">
                    <table width="100%">
                        <tr>
                            <td colspan="4">Pertimbangan persetujuan / Penolakan *) atasan langsung : </td>
                        </tr>
                        <tr colspan="3">
                            <td height="150px"></td>
                        </tr>
                    </table>
                </div>
                <div class="alamat">
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td width="100px">Kediri, </td>
                            <td width="300px"></td>
                        </tr>
                        <tr>
                            <td align="center"></td>
                            <td colspan="2" align="center"><b>KEPALA BNN KOTA KEDIRI</b></td>
                        </tr>
                        <tr colspan="3">
                            <td height="75px"></td>
                        </tr>
                        <tr>
                            <td align="center"><b></b></td>
                            <td colspan="2" align="center"><b>BUNAWAR, SH</b></td>
                        </tr>
                        <tr>
                            <td align="center"></td>
                            <td colspan="2" align="center"><b>AJUN KOMISARIS BESAR POLISI NRP. 70040695</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>