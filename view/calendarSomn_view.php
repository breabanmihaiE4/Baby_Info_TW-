<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/calendarSomn.css">
    <title>calendarSomn</title>
</head>
<body>

<?php
if (!isset($_COOKIE['cookieUserName'])) {
    header("Location: login.php");
} else {
    $userName = $_COOKIE['cookieUserName'];
    $childId = $_GET['id'];
    require '../model/_dbcon.php';
    $sql = "SELECT * FROM copil WHERE Id='$childId'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $childName = $row['NumeCopil'];

    $sql = "SELECT Id FROM somn WHERE idCopil='$childId'";
    $sqlres = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($sqlres);
    $IdStart = intval($row['Id']);

    $sql = "SELECT * FROM somn WHERE id = '$IdStart'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $dimineataLuni = $row['Luni'];
    $dimineataMarti = $row['Marti'];
    $dimineataMiercuri = $row['Miercuri'];
    $dimineataJoi = $row['Joi'];
    $dimineataVineri = $row['Vineri'];
    $dimineataSambata = $row['Sambata'];
    $dimineataDuminica = $row['Duminica'];

    $IdStart = $IdStart + 1;
            $sql = "SELECT * FROM somn WHERE id = '$IdStart'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $somnOdihnaLuni1 = $row['Luni'];
            $somnOdihnaMarti1 = $row['Marti'];
            $somnOdihnaMiercuri1 = $row['Miercuri'];
            $somnOdihnaJoi1 = $row['Joi'];
            $somnOdihnaVineri1 = $row['Vineri'];
            $somnOdihnaSambata1 = $row['Sambata'];
            $somnOdihnaDuminica1 = $row['Duminica'];

            $IdStart = $IdStart + 1;
            $sql = "SELECT * FROM somn WHERE id = '$IdStart'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $somnOdihnaLuni2 = $row['Luni'];
            $somnOdihnaMarti2 = $row['Marti'];
            $somnOdihnaMiercuri2 = $row['Miercuri'];
            $somnOdihnaJoi2 = $row['Joi'];
            $somnOdihnaVineri2 = $row['Vineri'];
            $somnOdihnaSambata2 = $row['Sambata'];
            $somnOdihnaDuminica2 = $row['Duminica'];

            $IdStart = $IdStart + 1;
            $sql = "SELECT * FROM somn WHERE id = '$IdStart'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $searaLuni = $row['Luni'];
            $searaMarti = $row['Marti'];
            $searaMiercuri = $row['Miercuri'];
            $searaJoi = $row['Joi'];
            $searaVineri = $row['Vineri'];
            $searaSambata = $row['Sambata'];
            $searaDuminica = $row['Duminica'];
}
?>

<div class="page">
    <div class="babypage">
        <h2>Calendar Somn <?php echo $childName ?></h2>
    </div>

    <div class="child">
        <div class="tabel">
            <form method="POST" class="button"
                  enctype="multipart/form-data">
                <table>
                    <thead>
                    <tr>
                        <th class="heads">Luni</th>
                        <th class="heads">Marti</th>
                        <th class="heads">Miercuri</th>
                        <th class="heads">Joi</th>
                        <th class="heads">Vineri</th>
                        <th class="heads">Sambata</th>
                        <th class="heads">Duminica</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="inserts"><input type="text" name="DimineataLuni" placeholder="trezire dimineata" value="<?php echo $dimineataLuni; ?>"></td>
                        <td class="inserts"><input type="text" name="DimineataMarti" placeholder="trezire dimineata" value="<?php echo $dimineataMarti; ?>"></td>
                        <td class="inserts"><input type="text" name="DimineataMiercuri" placeholder="trezire dimineata" value="<?php echo $dimineataMiercuri; ?>"></td>
                        <td class="inserts"><input type="text" name="DimineataJoi" placeholder="trezire dimineata" value="<?php echo $dimineataJoi; ?>"></td>
                        <td class="inserts"><input type="text" name="DimineataVineri" placeholder="trezire dimineata" value="<?php echo $dimineataVineri; ?>"></td>
                        <td class="inserts"><input type="text" name="DimineataSambata" placeholder="trezire dimineata" value="<?php echo $dimineataSambata; ?>"></td>
                        <td class="inserts"><input type="text" name="DimineataDuminica" placeholder="trezire dimineata" value="<?php echo $dimineataDuminica; ?>"></td>
                    </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td class="inserts"> <input type="text" name="somnOdihnaLuni1" placeholder="somn de odihna" value="<?php echo $somnOdihnaLuni1; ?>"> </td>
                            <td class="inserts"><input type="text" name="somnOdihnaMarti1" placeholder="somn de odihna" value="<?php echo $somnOdihnaMarti1; ?>"> </td>
                            <td class="inserts"><input type="text" name="somnOdihnaMiercuri1" placeholder="somn de odihna" value="<?php echo $somnOdihnaMiercuri1; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaJoi1" placeholder="somn de odihna" value="<?php echo $somnOdihnaJoi1; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaVineri1" placeholder="somn de odihna" value="<?php echo $somnOdihnaVineri1; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaSambata1" placeholder="somn de odihna" value="<?php echo $somnOdihnaSambata1; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaDuminica1" placeholder="somn de odihna" value="<?php echo $somnOdihnaDuminica1; ?>"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td class="inserts"> <input type="text" name="somnOdihnaLuni2" placeholder="somn de odihna" value="<?php echo $somnOdihnaLuni2; ?>"> </td>
                            <td class="inserts"><input type="text" name="somnOdihnaMarti2" placeholder="somn de odihna" value="<?php echo $somnOdihnaMarti2; ?>"> </td>
                            <td class="inserts"><input type="text" name="somnOdihnaMiercuri2" placeholder="somn de odihna" value="<?php echo $somnOdihnaMiercuri2; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaJoi2" placeholder="somn de odihna" value="<?php echo $somnOdihnaJoi2; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaVineri2" placeholder="somn de odihna" value="<?php echo $somnOdihnaVineri2; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaSambata2" placeholder="somn de odihna" value="<?php echo $somnOdihnaSambata2; ?>"></td>
                            <td class="inserts"><input type="text" name="somnOdihnaDuminica2" placeholder="somn de odihna" value="<?php echo $somnOdihnaDuminica2; ?>"></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td class="inserts"><input type="text" name="SearaLuni" placeholder="trezire seara" value="<?php echo $searaLuni; ?>"></td>
                            <td class="inserts"><input type="text" name="SearaMarti" placeholder="trezire seara" value="<?php echo $searaMarti; ?>"></td>
                            <td class="inserts"><input type="text" name="SearaMiercuri" placeholder="trezire seara" value="<?php echo $searaMiercuri; ?>"></td>
                            <td class="inserts"><input type="text" name="SearaJoi" placeholder="trezire seara" value="<?php echo $searaJoi; ?>"></td>
                            <td class="inserts"><input type="text" name="SearaVineri" placeholder="trezire seara" value="<?php echo $searaVineri; ?>"></td>
                            <td class="inserts"><input type="text" name="SearaSambata" placeholder="trezire seara" value="<?php echo $searaSambata; ?>"></td>
                            <td class="inserts"><input type="text" name="SearaDuminica" placeholder="trezire seara" value="<?php echo $searaDuminica; ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="numFields" name="numFields" value="1">
                <button class="btn-save" name="Save">Save</button>
            </form>

            <form action="./babypage_view.php?id=<?php echo $childId; ?>" method="POST" class="button">
                <button class="btn-return">Return</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['Save'])) {
    $sql = "SELECT Id FROM somn WHERE idCopil='$childId'";
    $sqlres = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($sqlres);
    $IdStart = intval($row['Id']);  
    $numFields = $_POST['numFields'];


    $dimineataLuni = $_POST['DimineataLuni'];
    $dimineataMarti = $_POST['DimineataMarti'];
    $dimineataMiercuri = $_POST['DimineataMiercuri'];
    $dimineataJoi = $_POST['DimineataJoi'];
    $dimineataVineri = $_POST['DimineataVineri'];
    $dimineataSambata = $_POST['DimineataSambata'];
    $dimineataDuminica = $_POST['DimineataDuminica'];
    
    $sql = "UPDATE somn SET Luni='$dimineataLuni', Marti='$dimineataMarti', Miercuri='$dimineataMiercuri', Joi='$dimineataJoi', Vineri='$dimineataVineri', Sambata='$dimineataSambata', Duminica='$dimineataDuminica' WHERE id='$IdStart'";
        $result = mysqli_query($connect, $sql);
    
    
    $IdStart = $IdStart + 1;

    $SomnOdihnaLuni1 = $_POST['somnOdihnaLuni1'];
    $SomnOdihnaMarti1 = $_POST['somnOdihnaMarti1'];
    $SomnOdihnaMiercuri1 = $_POST['somnOdihnaMiercuri1'];
    $SomnOdihnaJoi1 = $_POST['somnOdihnaJoi1'];
    $SomnOdihnaVineri1 = $_POST['somnOdihnaVineri1'];
    $SomnOdihnaSambata1 = $_POST['somnOdihnaSambata1'];
    $SomnOdihnaDuminica1 = $_POST['somnOdihnaDuminica1'];
    
    $sql = "UPDATE somn SET Luni='$SomnOdihnaLuni1', Marti='$SomnOdihnaMarti1', Miercuri='$SomnOdihnaMiercuri1', Joi='$SomnOdihnaJoi1', Vineri='$SomnOdihnaVineri1', Sambata='$SomnOdihnaSambata1', Duminica='$SomnOdihnaDuminica1' WHERE id='$IdStart'";
        $result = mysqli_query($connect, $sql);

    $IdStart = $IdStart + 1;    

    $SomnOdihnaLuni2 =  $_POST['somnOdihnaLuni2'];
    $SomnOdihnaMarti2 = $_POST['somnOdihnaMarti2'];
    $SomnOdihnaMiercuri2 = $_POST['somnOdihnaMiercuri2'];
    $SomnOdihnaJoi2 = $_POST['somnOdihnaJoi2'];
    $SomnOdihnaVineri2 = $_POST['somnOdihnaVineri2'];
    $SomnOdihnaSambata2 = $_POST['somnOdihnaSambata2'];
    $SomnOdihnaDuminica2 = $_POST['somnOdihnaDuminica2'];
        
        $sql = "UPDATE somn SET Luni='$SomnOdihnaLuni2', Marti='$SomnOdihnaMarti2', Miercuri='$SomnOdihnaMiercuri2', Joi='$SomnOdihnaJoi2', Vineri='$SomnOdihnaVineri2', Sambata='$SomnOdihnaSambata2', Duminica='$SomnOdihnaDuminica2' WHERE id='$IdStart'";
            $result = mysqli_query($connect, $sql);   
            
     $IdStart = $IdStart + 1;       

     $searaLuni = $_POST['SearaLuni'];
     $searaMarti = $_POST['SearaMarti'];
     $searaMiercuri = $_POST['SearaMiercuri'];
     $searaJoi = $_POST['SearaJoi'];
     $searaVineri = $_POST['SearaVineri'];
     $searaSambata = $_POST['SearaSambata'];
     $searaDuminica = $_POST['SearaDuminica'];
     
    $sql = "UPDATE somn SET Luni='$searaLuni', Marti='$searaMarti', Miercuri='$searaMiercuri', Joi='$searaJoi', Vineri='$searaVineri', Sambata='$searaSambata', Duminica='$searaDuminica' WHERE id='$IdStart'";
         $result = mysqli_query($connect, $sql);
}
?>


</body>
</html>