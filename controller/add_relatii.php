<?php
require '../model/_dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesează datele formularului de adăugare a evenimentului

    // Verifică dacă s-au furnizat toate câmpurile necesare
    if (!empty($_POST['option']) && !empty($_POST['description']) && !empty($_POST['memories'])) {
        // Obțineți datele din formular
        $option = $_POST['option'];
        $description = $_POST['description'];
        $memories = $_POST['memories'];
        $cookieId = $_COOKIE['cookieChildId'];

        // Efectuați operațiunile de inserare în baza de date
        if(!isset($_COOKIE['cookieChildId'])){
            echo "Nu ai selectat un copil";
        } else {
            $child_id = $_COOKIE['cookieChildId'];
        }
        $sql = "INSERT INTO relatii (child_id,relatie, description, memories) VALUES ('$child_id','$option', '$description', '$memories')";
        if (mysqli_query($connect, $sql)) {
            // Redirecționați către pagina timeline-ului sau la pagina evenimentului adăugat
            header("Location: ../view/relatiiCopii_view.php?id=$cookieId");
            exit;
        } else {
            echo "Eroare la inserarea evenimentului în baza de date: " . mysqli_error($connect);
        }
    } else {
        echo "Vă rugăm să completați toate câmpurile.";
        exit;
    }
} else {
    // Afiseaza formularul de adăugare a evenimentului
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Add Event</title>
        <link rel="stylesheet" href="../css/add_relatii.css">
    </head>
    <body>
    <h1>Add Relatie</h1>
    <form method="POST">
        <label for="select-option">Scrieti tipul relatiei pe care o aveti, de rudenie/prietenie:</label>
        <textarea id="option" name="option"></textarea><br><br>
        <label for="description">Description: </label><br>
        <textarea id="description" name="description"></textarea><br><br>
        <label for="event_date">Memories:</label><br>
        <textarea id="memories" name="memories"></textarea><br><br>
        <input  type="submit" value="Add">
    </form>
    </body>
    </html>
    <?php
}

mysqli_close($connect);
?>
