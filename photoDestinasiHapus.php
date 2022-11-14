<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
        $fotokode = $_GET['hapusfoto'];
        $hapusfoto = mysqli_query($connection, "SELECT * FROM fotodestinasi
            WHERE fotoID = '$fotokode'");
        $hapus = mysqli_fetch_array($hapusfoto);
        $namafile = $hapus['fotoFile'];

        mysqli_query($connection, "DELETE FROM fotodestinasi
            WHERE fotoID = '$fotokode'");

        unlink('iamges/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS');
        document.location='photoDestinasi.php'</script>";
    }
?>