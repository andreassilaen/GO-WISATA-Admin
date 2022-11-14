<!DOCTYPE html>



<?php
    include "includes/config.php";
    if(isset($_POST['Edit']))
    {
            if (isset($_REQUEST["inputkode"]))
            {
                $destinasikode = $_REQUEST["inputkode"];
            }

            if (!empty($destinasikode))
            {
                $destinasikode = $_REQUEST["inputkode"];
            }
            else {
                die ("Anda harus memasukkan kodenya");
            }

          
        $destinasinama = $_POST["inputnama"];
        $alamat = $_POST["inputalamat"];
        $kodekategori = $_POST["kodekategori"]; 
        $kodearea = $_POST["kodearea"]; 
    
    /*    mysqli_query($connection, "INSERT INTO destinasi VALUES ('$destinasikode',
        '$destinasinama','$alamat','$kodekategori', '$kodearea')");
        header("Location:destinasi2.php");
    */
        
        mysqli_query($connection, "UPDATE destinasi SET destinasiNama = '$destinasinama',
            destinasiAlamat = '$alamat', kategoriID = '$kodekategori',areaID = '$kodearea'
            WHERE destinasiID = '$destinasikode'");
        header("location:destinasi2.php");  

    }

    $datakategori = mysqli_query($connection, "SELECT * FROM kategori");
    $dataarea = mysqli_query($connection, "SELECT * FROM area");
 

// untuk menampilkan data pada form edit
$kodedestinasi = $_GET["ubah"];
$editdestinasi = mysqli_query($connection, "SELECT * FROM destinasi 
        WHERE destinasiID = '$kodedestinasi'");
$rowedit = mysqli_fetch_array($editdestinasi);

$editkategori = mysqli_query($connection, "SELECT * 
        FROM destinasi, kategori
        WHERE destinasiID = '$kodedestinasi' 
        AND destinasi.kategoriID = kategori.kategoriID");

$rowedit2 = mysqli_fetch_array($editkategori);

$editarea = mysqli_query($connection, "SELECT * 
        FROM destinasi, area
        WHERE destinasiID = '$kodedestinasi' 
        AND destinasi.areaID = area.areaID");

$rowedit3 = mysqli_fetch_array($editarea);


?>


<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com
    /ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<?php include "header.php";?>

<div class="container-fluid">
<div class="card shadow mb-4">




    <div class="row">
    <div class="col-sm-1">
    </div>

    <div class="col-sm-10">
    <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Edit Destinasi Wisata</h1>
             </div>
            </div> <!-- Penutup jumbotron -->

        <form method="POST">
            <div class="form-group row">
                <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputkode" id="kodedestinasi"
                        value="<?php echo $rowedit["destinasiID"]?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="namadestinasi" class="col-sm-2 col-form-label">Nama Destinasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputnama" id="namadestinasi"
                    value="<?php echo $rowedit["destinasiNama"]?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Destinasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputalamat" id="alamat"
                    value="<?php echo $rowedit["destinasiAlamat"]?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="kodereferensi" class="col-sm-2 col-form-label">Kategori Wisata</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kodekategori" name="kodekategori">  <!---- Ditambahain Name lagi --------->
                        
                           <option value="<?php echo $rowedit["kategoriID"]?>"><?php echo 
                           $rowedit['kategoriID']?>  <?php echo $rowedit2['destinasiNama']?></option> 
                            <?php while($row = mysqli_fetch_array($datakategori))
                            { ?>
                                <option value="<?php echo $row["kategoriID"] ?>">
                                    <?php echo $row["kategoriID"]?>
                                    <?php echo $row["kategoriNama"]?>

                                </option>
                            <?php } ?>  
                         
                    </select>
                </div>
            </div>



            <div class="form-group row">
                <label for="kodereferensi" class="col-sm-2 col-form-label">Area Wisata</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kodearea" name="kodearea">  <!---- Ditambahain Name lagi --------->
                           <option value="<?php echo $rowedit["areaID"]?>"><?php echo 
                           $rowedit['areaID']?>  <?php echo $rowedit3['areaNama']?></option> 
                            <?php while($row = mysqli_fetch_array($dataarea))
                            { ?>
                                <option value="<?php echo $row["areaID"] ?>">
                                    <?php echo $row["areaID"]?>
                                    <?php echo $row["areaNama"]?>

                                </option>
                            <?php } ?>  
                         
                    </select>
                </div>
            </div>
  



            <div class="form-group row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Edit" name="Edit">
                    <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
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
                    <h1 class="display-4">Daftar Destinasi Wisata</h1>
                    <h2>Hasil Entri data pada Tabel Destinasi</h2>
             </div>
            </div> <!-- Penutup jumbotron -->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3">Nama Destinasi</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search"
                        value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Destinasi">
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
                        <th>Nama Destinasi Wisata</th>
                        <th>Alamat Destinasi Wisata</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Kode Area</th>
                        <th>Nama Area</th>

                        <th colspan="3" style="text-align: center">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                if(isset($_POST["kirim"]))
                {
                    $search = $_POST['search'];
                    $query = mysqli_query($connection, "SELECT destinasi.*,
                    kategori.kategoriID, kategori.kategoriNama, area.areaID,
                    area.areaNama 
                    FROM destinasi, kategori, area
                    WHERE destinasiNama 
                    LIKE '%".$search."%'
                    AND destinasi.kategoriID = kategori.kategoriID
                    AND destinasi.areaID = area.areaID");
                }else
                    {
                    $query = mysqli_query($connection, "SELECT destinasi.*,
                    kategori.kategoriID, kategori.kategoriNama, area.areaID,
                    area.areaNama 
                    FROM destinasi, kategori, area
                    WHERE destinasi.kategoriID = kategori.kategoriID
                    AND destinasi.areaID = area.areaID");
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query))
                    { ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $row['destinasiID'];?></td>
                            <td><?php echo $row['destinasiNama'];?></td>
                            <td><?php echo $row['destinasiAlamat'];?></td>
                            <td><?php echo $row['kategoriID'];?></td>
                            <td><?php echo $row['kategoriNama'];?></td>
                            <td><?php echo $row['areaID'];?></td>
                            <td><?php echo $row['areaNama'];?></td>


        <!--- UNTUK ICON edit dan delete ----->
                        <td>
                        <a href="destinasiEdit.php?ubah=<?php echo $row["destinasiID"]?>"
                            class="btn btn-success btn-sm" title="EDIT">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 
                        2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 
                        0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </a>  
                        </td>

                        <td>
                        <a href="destinasiHapus.php?hapus=<?php echo $row["destinasiID"]?>"
                            class="btn btn-danger btn-sm" title="DELETE">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 
                        0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1
                        1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        </a>
                        <td>


        <!--- AKHIR icon edit dan delete ----->


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

</div>
</div> <!--- penutup container-fluid --->
<?php include "footer.php";?>
<?php
mysqli_close($connection);
ob_end_flush();
?>
</html>