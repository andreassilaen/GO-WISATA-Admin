<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
        $fotokode = $_GET['hapusfoto'];
        $hapusfoto = mysqli_query($connection, "SELECT * FROM transportasi
            WHERE transportasiID = '$fotokode'");
        $hapus = mysqli_fetch_array($hapusfoto);
        $namafile = $hapus['hotelFoto'];

        mysqli_query($connection, "DELETE FROM transportasi
            WHERE transportasiID = '$fotokode'");

        unlink('iamges/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS');
        document.location='transportasi.php'</script>";
    }
?>