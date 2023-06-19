<?php
require '../model/_dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesează datele formularului de adăugare a evenimentului

    // Verifică dacă s-au furnizat toate câmpurile necesare
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['event_date'])) {
        // Obțineți datele din formular
        $title = $_POST['title'];
        $description = $_POST['description'];
        $eventDate = $_POST['event_date'];
        $cookieId = $_COOKIE['cookieChildId'];

        // Efectuați operațiunile de inserare în baza de date
        if(!isset($_COOKIE['cookieChildId'])){
            echo "Nu ai selectat un copil";
        } else {
            $child_id = $_COOKIE['cookieChildId'];
        }
        $sql = "INSERT INTO events (child_id,title, description, event_date) VALUES ('$child_id','$title', '$description', '$eventDate')";
        if (mysqli_query($connect, $sql)) {
            // Redirecționați către pagina timeline-ului sau la pagina evenimentului adăugat
            header("Location: ../view/events_view.php?id=$cookieId");
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
        <link rel="stylesheet" href="../css/add_event.css">
    </head>
    <body>
    <h1>Add Event</h1>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>
        <label for="event_date">Date:</label><br>
        <input type="date" id="event_date" name="event_date"><br><br>
        <input  type="submit" value="Add">
    </form>
    </body>
    </html>
    <?php
}

mysqli_close($connect);
?>
