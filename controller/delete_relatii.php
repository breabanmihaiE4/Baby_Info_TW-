<?php
require '../model/_dbcon.php';

// Verifică dacă s-a trimis un ID valid pentru ștergere
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventId = $_GET['id'];

    // Verifică dacă evenimentul există în baza de date
    $sql = "SELECT * FROM relatii WHERE id = '$eventId'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Evenimentul există, puteți începe procesul de ștergere a evenimentului
        $deleteSql = "DELETE FROM relatii WHERE id = '$eventId'";
        if (mysqli_query($connect, $deleteSql)) {
            echo "Evenimentul a fost șters cu succes.";
        } else {
            echo "A apărut o eroare la ștergerea evenimentului.";
        }
    } else {
        // Evenimentul nu există în baza de date, puteți afișa un mesaj de eroare sau redirecționa utilizatorul
        echo "Evenimentul nu există.";
    }
} else {
    // ID invalid, puteți afișa un mesaj de eroare sau redirecționa utilizatorul
    echo "ID invalid.";
}

mysqli_close($connect);
?>
