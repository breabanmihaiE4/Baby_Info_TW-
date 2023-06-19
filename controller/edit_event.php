<?php
// Verifică dacă s-a trimis un ID valid al evenimentului
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $eventId = $_GET['id'];
    $cookieId = $_COOKIE['cookieChildId'];

    // Verifică dacă s-a trimis formularul de editare
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesează datele formularului de editare

        // Obțineți datele din formular (titlu, descriere, data)
        $title = $_POST['title'];
        $description = $_POST['description'];
        $eventDate = $_POST['event_date'];

        // Realizați operațiunile de actualizare în baza de date
        require '../model/_dbcon.php';
        $updateSql = "UPDATE events SET title = '$title', description = '$description', event_date = DATE('$eventDate') WHERE id = '$eventId'";

        if (mysqli_query($connect, $updateSql)) {
            // Redirecționați către pagina timeline-ului sau la pagina evenimentului editat
            header("Location: ../view/events_view.php?id=$cookieId");
            exit();
        } else {
            echo "A apărut o eroare la actualizarea evenimentului.";
        }

        mysqli_close($connect);
    } else {
        // Afiseaza formularul de editare

        // Conectați-vă la baza de date și obțineți datele evenimentului
        require '../model/_dbcon.php';
        $sql = "SELECT * FROM events WHERE id = '$eventId'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $description = $row['description'];
            $eventDate = $row['event_date'];
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
        <h1>Edit Event</h1>
        <form method="POST">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>"><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo $description; ?></textarea><br><br>
            <label for="event_date">Date:</label><br>
            <input type="date" id="event_date" name="event_date" value="<?php echo $eventDate; ?>"><br><br>
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
