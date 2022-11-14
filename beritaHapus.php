<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
        $fotokode = $_GET['hapusfoto'];
        $hapusfoto = mysqli_query($connection, "SELECT * FROM berita
            WHERE beritaID = '$fotokode'");
        $hapus = mysqli_fetch_array($hapusfoto);
        $namafile = $hapus['beritaFoto'];

        mysqli_query($connection, "DELETE FROM berita
            WHERE beritaID = '$fotokode'");

        unlink('iamges/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS');
        document.location='berita.php'</script>";
    }
?>