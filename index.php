<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Umsetzung der Aufgabe für die KÜ PR3 an der HFH">
    <meta name="author" content="Tobias Weiß">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PR3 Umsetzung Webshop Kunde</title>
    <h1> PR3 Umsetzung Webshop Kunde </h1>
</head>

<body>
    <!-- Formular zur Eingabe der Suchparameter -->
         <form method="GET" action="<?php echo htmlspecialchars(string: $_SERVER["PHP_SELF"]);?>">
    <!-- Suchfeld -->
        <label for="suche">Ich möchte folgendes suchen:</label><br>
         <input type="text" id="suche" name="suche" value="" placeholder="Suchbegriff eingeben"><br>
    <!-- "Tierart" auswählen mit Radio-Button 
        <label for="hund">Hund</label>
         <input type="radio" id="hund" name="animal" value="1" checked><br>  "Checked" weil immer eine Wahl getroffen werden muss für die Abfrage, damit erspare ich mir späteres abfragen davon
        <label for="katze">Katze</label>
         <input type="radio" id="katze" name="animal" value="2"> <br>
    -->
         <!-- Tierart auswählen über ein DropDown Feld -->
         <label for="animal">Ich suche etwas für Tierart:</label><br>
         <select id="animal" name="animal">
            <option value="1">Hund</option>
            <option value="2">Katze</option>
         </select><br><br>
    <!-- Button "Suche starten"-->
         <input type="submit" value="Suche starten">
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

        if (isset($_GET["sort"])) { //definiert ob nach ASC / DESC sortiert wird und stellt sicher das die Variable definiert ist
            $sort = $_GET["sort"];
        }
            else {
            $sort = "ASC";
        }

        if (isset($_GET['suche'])) { //benötigt weil ein String übergeben werden muss, allerdings ist auch ein leerer String ein String solange dieser nicht NULL ist
            $id = $_GET['animal'];
                /* 
                echo " 
                id = $id <br>
                "; // echo welcher Radio-Button selektiert ist für Debugging
                */

            $search_query = $conn->real_escape_string(string: $_GET['suche']);  // escape_string um sonderzeichen nicht zu übergeben
                /*
                    echo " 
                    search-query = $search_query <br>
                    "; // echo suchbegriff für debugging 
                */

            $sql = "SELECT * FROM produkt WHERE beschr LIKE '%$search_query%' AND tierart = $id ORDER BY preis $sort";
                /*
                echo " 
                    SQL-Abfrage = $sql <br>
                    "; // echo SQL-Abfrage für Debugging
                */

            $result = $conn->query(query: $sql);  
            
            $i = 0; // zum Zählen wie viele Reihen/Ergebnisse ausgegeben werden
            if ($result->num_rows > 0) {
                
                if ($sort == "DESC") { // einfacher "switch" zwischen der Sortierung
                    $sort = "ASC";
                }
                else {
                    $sort = "DESC";
                }

                $actual_link = "$_SERVER[REQUEST_URI]"; //holt sich den aktuellen Link aus der Adresszeile - den server "localhost" kann man sich hier sparen
                /*
                    echo "
                    actual Link: $actual_link <br>
                    "; // echo des aktuellen Links für debugging
                */
                        
                        $end_DESC = "DESC"; //definition der strings in einer Variable damit ich nur eine Stelle anpassen muss
                        $end_ASC = "ASC";
// weil ich die Sortierung über eine Ergänzugn des Aufruflinks abgebildet habe, ist es nötig den Link auch immer wieder zu bereinigen, ansonsten werden Sortierungen immer weiter hinten angehängt und irgendwann kaputt
            if (str_ends_with(haystack: $actual_link, needle: $end_DESC)) {     
                            $work_link = rtrim(string: $actual_link, characters: "&sort=DESC"); //rtrim weil ich weiß, dass der String auf der rechten Seite gekürzt werden muss
/*
                            echo "
                            work-link-desc = $work_link <br>
                            "; // echo des DESC-ifs für debugging
                        */    
                        }
                        elseif (str_ends_with(haystack: $actual_link, needle:$end_ASC)) {
                            $work_link = rtrim(string: $actual_link, characters:"&sort=ASC"); //rtrim weil ich weiß, dass der String auf der rechten Seite gekürzt werden muss
                        /*
                            echo "
                            work-link-asc = $work_link <br>
                            "; // echo des ASC-ifs für debugging
                        */
                        }
                        else { // falls keine Sortierung erfolgt ist bleibt der Link gleich
                            $work_link = $actual_link;
                        /*
                            echo "
                            work-link = $work_link <br>
                            "; // echo des else für debugging
                        */
                        }
                // erstellen der Tabelle mit den Spaltennamen und der Link für die Sortierung nach preis
                // außerdem Formatierung damit diese "etwas" schöner ist
                echo "
                <table border = '2' style='border-collapse:collapse'> 
                    <tr>
                        <th>Produktbezeichnung</th>
                        <th>Produktbeschreibung</th>
                        <th><a href ='$work_link&sort=$sort'>Preis</a></th> 
                    </tr>
                "; // work-link ist der zu verwendende Aufruf und die Sortierung wird dem Aufruf angefügt
            
            while($row = $result->fetch_assoc()) { // erstellt ein assoziatives Array
                $bez = $row['bez'];
                $beschr = $row['beschr'];
                $preis = $row['preis'];

            echo "
                <tr>
                    <td>$bez</td>
                    <td>$beschr</td>
                    <td>$preis</td>
                </tr>
                ";

            $i++; // erhöht de Zähler wie viele Ergebnisse gefunden werden jeden Durchlauf um 1
            }
            echo "
                </table> <br>
            ";
            echo "
                Ihre Suche hat $i Ergebnisse geliefert <br>
            ";
            echo "
                Die Suchergebnisse können mit einem Klick auf 'Preis' auf- bzw. absteigend sortiert werden. <br>
            ";
            } else {
            echo "
                Ihre Suche hat nichts gefunden <br>
            ";
            }
        }

        $conn->close(); // schließt die Verbindung zur Datenbank
    ?>

</body>
</html>