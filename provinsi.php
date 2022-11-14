<!DOCTYPE html>


<?php
    include "includes/config.php";
    if(isset($_POST['Simpan']))
    {
            if (isset($_REQUEST["inputkode"]))
            {
                $provinsikode = $_REQUEST["inputkode"];
            }

            if (!empty($provinsikode))
            {
                $provinsikode = $_REQUEST["inputkode"];
            }
            else {
                die ("Anda harus memasukkan kodenya");
            }

          
        $provinsinama = $_POST["inputnama"];
        $provinsitgl = $_POST["inputtgl"];
        
    
        mysqli_query($connection, "INSERT INTO provinsi VALUES ('$provinsikode',
        '$provinsinama','$provinsitgl')");
        header("Location:provinsi.php");
    }

    // $datakategori = mysqli_query($connection, "SELECT * FROM kategori");
    // $dataarea = mysqli_query($connection, "SELECT * FROM area");
 
?>


<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provinsi Wisata</title>
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
                    <h1 class="display-4">Input Provinsi Wisata</h1>
             </div>
            </div> <!-- Penutup jumbotron -->

        <form method="POST">
            <div class="form-group row">
                <label for="kodeprovinsi" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputkode" id="kodeprovinsi"
                        placeholder="kode provinsi" maxlength="4">
                </div>
            </div>

            <div class="form-group row">
                <label for="namaprovinsi" class="col-sm-2 col-form-label">Nama Provinsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputnama" id="namaprovinsi"
                        placeholder="nama provinsi">
                </div>
            </div>

            <div class="form-group row">
                <label for="tgl" class="col-sm-2 col-form-label">Tanggal Berdiri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputtgl" id="tgl"
                        placeholder="tanggal berdiri">
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


    <!-- Memulai menampilkan data --->                            
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Provinsi</h1>
                    <h2>Hasil Entri data pada Tabel Provinsi</h2>
             </div>
            </div> <!-- Penutup jumbotron -->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3">Nama Provinsi</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search"
                        value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Provinsi">
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
                        <th>Nama Provinsi</th>
                        <th>Tanggal Berdiri</th>
            
                    </tr>
                </thead>

                <tbody>

                <?php
                if(isset($_POST["kirim"]))
                {
                    $search = $_POST['search'];
                    $query = mysqli_query($connection, "SELECT *
                    FROM provinsi
                    WHERE provinsiNama 
                    LIKE '%".$search."%'");

                    
                }else
                    {
                    $query = mysqli_query($connection, "SELECT * FROM provinsi");
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query))
                    { ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $row['provinsiID'];?></td>
                            <td><?php echo $row['provinsiNama'];?></td>
                            <td><?php echo $row['provinsiTglBerdiri'];?></td>
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
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>


</html>