<?php 
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodedestinasi = $_GET['hapus'];
        mysqli_query($connection, "DELETE FROM destinasi
            WHERE destinasiID = '$kodedestinasi'");
        echo "<script>alert('DATA BERHASIL DIHAPUS')
            document.location='destinasi2.php'</script>";
    }

?>