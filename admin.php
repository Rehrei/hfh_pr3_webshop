<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Umsetzung der Aufgabe für die KÜ PR3 an der HFH">
    <meta name="author" content="Tobias Weiß">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PR3 Umsetzung Webshop Mitarbeiter</title>
    <h1> PR3 Umsetzung Webshop Mitarbeiter </h1>
</head>

<body>
    <!-- Formular zur Eingabe der Daten -->
         <form method="POST" action="<?php echo htmlspecialchars(string: $_SERVER["PHP_SELF"]);?>">
    <!-- Eingabefelder -->
        <label for="bez">Ich möchte folgende Produktbezeichnung hinzufügen:</label><br>
         <input type="text" id="bez" name="bez" value="" placeholder="Bezeichnung" required><br>
         <label for="beschr">Ich möchte folgende Produktbeschreibung hinzufügen:</label><br>
         <input type="text" id="beschr" name="beschr" value="" placeholder="Beschreibung" required><br>
         <!-- Tierart auswählen über ein DropDown Feld -->
         <label for="animal">Ich füge einen Artikel für folgende Tierart hinzu:</label><br>
         <select id="animal" name="animal">
            <option value="1">Hund</option>
            <option value="2">Katze</option>
         </select><br><br>
         <!-- Preis festlegen, Cent-Schritte über "step" definiert -->
         <label for="preis">Ich möchte folgenden Preis hinzufügen:</label><br>
         <input type="number" id="preis" name="preis" step="0.01" value="" placeholder="Preis" required><br>
    <!-- Button "Produkt ergänzen" -->
         <input type="submit" value="Produkt ergänzen">
    </form>

    <?php
        // Daten für DB-Verbindung:
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webshop";

        // Erstellen der DB-Verbindung
            $conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

        // Prüfen der DB-Verbindung
            if ($conn->connect_error) {
                exit("Connection failed: " . $conn->connect_error);
            }
            /*
                echo "
                DB-Verbindung aufgebaut <br>
                ";
            */
            
            //Weil ein Auto-Increment des Primary-keys bei "VARCHAR" nicht funktioniert muss ich zuerst auch noch die aktuell höchste ID des Primary-Keys herausfinden
            $lastrow_query = "SELECT COUNT(*) FROM produkt";
            $result_id = $conn->query(query: $lastrow_query);
            $lastrow = mysqli_fetch_assoc(result: $result_id);
            $lastid = end(array: $lastrow);
            /*
            echo "
                letzte ID = $lastid <br>
            ";
            $new_id = $lastid + 1;
            echo "
                neue ID = $new_id <br>
            ";
            */

        if (isset($_POST['bez'],$_POST['beschr'],$_POST['preis'])) { // Werte dürfen nicht NULL sein
            
            $bez_query = $conn->real_escape_string(string: $_POST['bez']);  // escape_string um sonderzeichen nicht zu übergeben
            $beschr_query = $conn->real_escape_string(string: $_POST['beschr']);  // escape_string um sonderzeichen nicht zu übergeben
            $preis_query = $conn->real_escape_string(string: $_POST['preis']);  // escape_string um sonderzeichen nicht zu übergeben
            $tierart = $_POST['animal']; // kein extra Check weil Drop-Down-Feld
                    /*
                    echo " 
                    bez-query = $bez_query <br>
                    beschr-query = $beschr_query <br>
                    preis-query = $preis_query <br>
                    tierart = $tierart <br>
                    "; // echo Werte für debugging 
                    */

            $sql = "INSERT INTO produkt (id, bez, beschr, preis, tierart)
                    VALUES ($new_id, '$bez_query', '$beschr_query', $preis_query, $tierart)";
                /*
                echo " 
                    SQL-Abfrage = $sql <br>
                    "; // echo SQL-Abfrage für Debugging
                */

            if ($conn->query(query: $sql) === TRUE) {
                $current_id = $new_id;
                echo "success! Last inserted ID is: $current_id ";
                
                if ($tierart == "1") {
                    $tierart = "Hund";
                } else {
                    $tierart = "Katze";
                }

                echo "
                    <table border = '2' style='border-collapse:collapse'> 
                        <tr>
                            <th>Produkt-ID</th>
                            <th>Produktbezeichnung</th>
                            <th>Produktbeschreibung</th>
                            <th>Preis</th>
                            <th>Tierart</th>  
                        </tr>
                        <tr>
                            <td>$new_id</td>
                            <td>$bez_query</td>
                            <td>$beschr_query</td>
                            <td>$preis_query</td>
                            <td>$tierart</td>
                        </tr>
                    </table>
                ";
                $new_id = $current_id + 1;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close(); // schließt die Verbindung zur Datenbank
    ?>

</body>
</html>