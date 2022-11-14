<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
        $fotokode = $_GET['hapusfoto'];
        $hapusfoto = mysqli_query($connection, "SELECT * FROM hotel
            WHERE hotelID = '$fotokode'");
        $hapus = mysqli_fetch_array($hapusfoto);
        $namafile = $hapus['hotelFoto'];

        mysqli_query($connection, "DELETE FROM hotel
            WHERE hotelID = '$fotokode'");

        unlink('iamges/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS');
        document.location='hotel.php'</script>";
    }
?>