<?php
// Verifică dacă s-a trimis un ID valid al evenimentului
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $relatieId = $_GET['id'];
    $cookieId = $_COOKIE['cookieChildId'];

    // Verifică dacă s-a trimis formularul de editare
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesează datele formularului de editare

        // Obțineți datele din formular (titlu, descriere, data)
        $option = $_POST['option'];
        $description = $_POST['description'];
        $memories = $_POST['memories'];

        // Realizați operațiunile de actualizare în baza de date
        require '../model/_dbcon.php';
        $updateSql = "UPDATE relatii SET relatie = '$option', description = '$description', memories = '$memories' WHERE id = '$relatieId'";

        if (mysqli_query($connect, $updateSql)) {
            // Redirecționați către pagina timeline-ului sau la pagina evenimentului editat
            header("Location: ../view/relatiiCopii_view.php?id=$cookieId");
            exit();
        } else {
            echo "A apărut o eroare la actualizarea evenimentului.";
        }

        mysqli_close($connect);
    } else {
        // Afiseaza formularul de editare

        // Conectați-vă la baza de date și obțineți datele evenimentului
        require '../model/_dbcon.php';
        $sql = "SELECT * FROM relatii WHERE id = '$relatieId'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            $option = $row['relatie'];
            $description = $row['description'];
            $memories = $row['memories'];
        } else {
            echo "Evenimentul nu a fost găsit.";
            exit;
        }

        mysqli_close($connect);
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Event</title>
            <link rel="stylesheet" href="../css/edit_event.css">
        </head>
        <body>
            <h1>Edit Relatie</h1>
            <form method="POST">
            <label for="select-option">Scrieti tipul relatiei pe care o aveti, de rudenie/prietenie:</label>
            <textarea id="option" name="option"> <?php echo $option; ?> </textarea><br><br>    
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo $description; ?></textarea><br><br>
            <label for="event_date">Memories:</label><br>
            <textarea id="memories" name="memories"><?php echo $memories; ?></textarea><br><br>
            <input  type="submit" value="Save">
        </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "ID invalid al evenimentului.";
    exit;
}
?>
