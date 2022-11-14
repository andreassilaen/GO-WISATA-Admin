<!DOCTYPE html>


<?php
    include "includes/config.php";
    if(isset($_POST['Simpan']))
    {
            if (isset($_REQUEST["inputkode"]))
            {
                $areakode = $_REQUEST["inputkode"];
            }

            if (!empty($areakode))
            {
                $areakode = $_REQUEST["inputkode"];
            }
            else {
                die ("Anda harus memasukkan kodenya");
            }

          
        $areanama = $_POST["inputnama"];
        $wilayah = $_POST["inputwilayah"];
        $areaketerangan = $_POST["inputketerangan"]; 
        $kodeprovinsi = $_POST["kodeprovinsi"];
        // $kodearea = $_POST["kodearea"]; 
    
        mysqli_query($connection, "INSERT INTO area VALUES ('$areakode',
        '$areanama','$wilayah','$areaketerangan', '$kodeprovinsi')");
        header("Location:area.php");
    }

    $dataprovinsi= mysqli_query($connection, "SELECT * FROM provinsi");
    // $dataarea = mysqli_query($connection, "SELECT * FROM area");
 
?>


<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Wisata</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com
    /ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>


<?php include "header.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">




    <div class="row">
    <div class="col-sm-1">
    </div>

    <div class="col-sm-10">
    <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Input Area Wisata</h1>
             </div>
            </div> <!-- Penutup jumbotron -->

        <form method="POST">
            <div class="form-group row">
                <label for="kodearea" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputkode" id="kodearea"
                        placeholder="kode area" maxlength="4">
                </div>
            </div>

            <div class="form-group row">
                <label for="namaarea" class="col-sm-2 col-form-label">Nama Area</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputnama" id="namaarea"
                        placeholder="nama area">
                </div>
            </div>

            <div class="form-group row">
                <label for="wilayah" class="col-sm-2 col-form-label">Wilayah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputwilayah" id="wilayah"
                        placeholder="wilayah">
                </div>
            </div>

            <div class="form-group row">
                <label for="keteranganarea" class="col-sm-2 col-form-label">Area Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputketerangan" id="keteranganarea"
                        placeholder="keterangan">
                </div>
            </div>


            <div class="form-group row">
                <label for="kodeprovinsi" class="col-sm-2 col-form-label">Provinsi</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kodeprovinsi" name="kodeprovinsi">  <!---- Ditambahain Name lagi --------->
                        <div name="kodeprovinsi">
                            <option>Provinsi Wisata</option>
                            <?php while($row = mysqli_fetch_array($dataprovinsi))
                            { ?>
                                <option value="<?php echo $row["provinsiID"] ?>">
                                    <?php echo $row["provinsiID"]?>
                                    <?php echo $row["provinsiNama"]?>

                                </option>
                            <?php } ?>  
                        </div>  
                    </select>
                </div>
            </div>
  



            <div class="form-group row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
                    <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
                    <a href="provinsi.php"><button type="button" class="btn btn-warning">Form Provinsi</button></a>
                </div>
            </div>

        </form>
    </div>

    <div class="col-sm-1">
    </div>
    </div> <!-- Penutup class row-->


    <!-- Memulai menampilkan data --->                            
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Area Wisata</h1>
                    <h2>Hasil Entri data pada Tabel Area</h2>
             </div>
            </div> <!-- Penutup jumbotron -->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3">Nama Area</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search"
                        value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Area">
                    </div>
                    <input type="submit" name="kirim" class="col-bi-1 btn btn-primary" 
                    value="Search">
                </div>
            </form>


            <table class="table table-hover table-success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Area Wisata</th>
                        <th>Wilayah</th>
                        <th>Keterangan</th>
                        <th>Provinsi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                if(isset($_POST["kirim"]))
                {
                    $search = $_POST['search'];
                    $query = mysqli_query($connection, "SELECT area.*,
                    provinsi.provinsiID 
                    FROM area, provinsi
                    WHERE area.provinsiID = provinsi.provinsiID
                    AND areaNama
                    LIKE '%".$search."%'");

                }else
                    {
                    $query = mysqli_query($connection, "SELECT area.*,
                    provinsi.provinsiID 
                    FROM area, provinsi
                    WHERE area.provinsiID = provinsi.provinsiID");

                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query))
                    { ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $row['areaID'];?></td>
                            <td><?php echo $row['areaNama'];?></td>
                            <td><?php echo $row['areaWilayah'];?></td>
                            <td><?php echo $row['areaKeterangan'];?></td>
                            <td><?php echo $row['provinsiID'];?></td>
                        </tr>
                        <?php $nomor = $nomor + 1;?>
                        <?php } ?>
                    
                </tbody>
            </table>

        

        </div>
        <div class="col-sm-1"></div>

        
    </div>

    <script type="text/javascript" src="js/bootsrtap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/
    jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/
    select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#kodekategori').select2({


            });
        }):
    </script>        

</div> <!--- penutup container-fluid --->
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>
</html>