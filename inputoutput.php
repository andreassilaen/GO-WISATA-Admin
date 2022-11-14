<!DOCTYPE html>


<?php
    include "includes/config.php";
    if(isset($_POST['Simpan']))
    {
            if (isset($_REQUEST["inputkode"]))
            {
                $kategorikode = $_REQUEST["inputkode"];
            }

            if (!empty($kategorikode))
            {
                $kategorikode = $_REQUEST["inputkode"];
            }
            else {
                ?> <h1>Anda harus mengisi data</h1> <?php
                die ("Anda harus memasukan datanya");
            }

          
        $kategorinama = $_POST["inputname"];
        $kategoriket = $_POST["inputketerangan"];
        $kategorireferensi = $_POST["inputreferensi"]; 
    
        mysqli_query($connection, "INSERT INTO kategori VALUES ('$kategorikode','$kategorinama','$kategoriket','$kategorireferensi')");
        header("Location:inputoutput.php");
    }
 
?>


<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output Kategori Wisata</title>
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
                    <h1 class="display-4">Input Kategori Wisata</h1>
             </div>
            </div> <!-- Penutup jumbotron -->
        <form method="POST">

            <div class="form-group row">
                <label for="kodekategori" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputkode" id="kodekategori"
                        placeholder="kode kategori" maxlength="4">
                </div>
            </div>

            <div class="form-group row">
                <label for="namakategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputname" id="namakategori"
                        placeholder="nama kategori">
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangankategori" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputketerangan" id="keterangankategori"
                        placeholder="keterangan kategori">
                </div>
            </div>

            <div class="form-group row">
                <label for="kodereferensi" class="col-sm-2 col-form-label">Referensi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputreferensi" id="kodereferensi"
                        placeholder="referensi kategori">
                </div>
            </div>




            <div class="form-group row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
                    <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
                </div>
            </div>

        </form>
    </div>

    <div class="col-sm-1">
    </div>
    </div> <!-- Penutup class row-->



    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Kategori Wisata</h1>
                    <h2>Hasil Entri data pada Tabel Kategori</h2>
             </div>
            </div> <!-- Penutup jumbotron -->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3">Nama Kategori</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search"
                        value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Kategori">
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
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Referensi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                if(isset($_POST["kirim"]))
                {
                    $search = $_POST['search'];
                    $query = mysqli_query($connection, "SELECT * 
                    FROM kategori
                    WHERE kategoriNama 
                    LIKE '%".$search."%'
                    OR kategoriKeterangan LIKE '%".$search."%'
                    OR kategoriReferensi LIKE '%".$search."%'");
                }else
                    {
                    $query = mysqli_query($connection, "SELECT * FROM kategori");
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query))
                    { ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $row['kategoriID'];?></td>
                            <td><?php echo $row['kategoriNama'];?></td>
                            <td><?php echo $row['kategoriKeterangan'];?></td>
                            <td><?php echo $row['kategoriReferensi'];?></td>
                        </tr>
                        <?php $nomor = $nomor + 1;?>
                        <?php } ?>
                    
                </tbody>
            </table>

        

        </div>
        <div class="col-sm-1"></div>

        <script type="text/javascript" src="js/bootsrtap.min.js"></script>
    </div>

    
</div>
</div> <!--- penutup container-fluid --->
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>


</html>