<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" href="../css/events.css">
</head>
<body>
<?php
require '../model/_dbcon.php';
$child_id = $_GET['id'];
$sql = "SELECT * FROM events WHERE child_id = '$child_id' ORDER BY event_date DESC";
$result = mysqli_query($connect, $sql);

// Afișarea evenimentelor într-un format de tip timeline
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='timeline-item'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Data: " . $row['event_date'] . "</p>";
        echo "<button class='btn-edit' onclick='editEvent(" . $row['id'] . ")'>Edit</button>";
        echo "<button class='btn-delete' onclick='deleteEvent(" . $row['id'] . ")'>Delete</button>";
        echo "</div>";
    }
} else {
    echo "Nu există evenimente de afișat.";
}

mysqli_close($connect);
?>

    <button class="btn-add" onclick="addEvent()">Add Event</button>
        <?php 
            echo'<form action="./babypage_view.php?id='.$child_id.'" method="POST" class="button">' 
         ?>
        <button class="btn-return">Return</button>
    </form>


<script>
    function editEvent(eventId) {
        // Redirecționează către pagina de editare a evenimentului cu ID-ul specificat
        window.location.href = "../controller/edit_event.php?id=" + eventId;
    }

    function deleteEvent(eventId) {
        // Trimite o solicitare AJAX către server pentru a șterge evenimentul cu ID-ul specificat
        var confirmation = confirm("Sigur doriți să ștergeți acest eveniment?");
        if (confirmation) {
            // Trimite solicitarea către server
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Răspunsul de la server
                    alert(this.responseText);
                    // Reîncarcă pagina pentru a actualiza lista de evenimente
                    location.reload();
                }
            };
            xhttp.open("GET", "../controller/delete_event.php?id=" + eventId, true);
            xhttp.send();
        }
    }

    function addEvent() {
        // Redirecționează către pagina de adăugare a evenimentului
        window.location.href = "../controller/add_event.php";
    }
</script>
</body>
</html>
