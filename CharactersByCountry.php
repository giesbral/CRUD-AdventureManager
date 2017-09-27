<?php
    $page_title = "Adventure! - Characters by Country";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <?php
                        $countryinfo = json_decode($_POST['country'], TRUE);
                        echo "<caption>Abilities by Character -</br>". $countryinfo['name'] ."</caption>";     
                    ?>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Age</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <?php
                        if(!($stmt = $mysqli->prepare("SELECT ch.`name`, ch.`title`, ch.`age`, c.`name` FROM `character` as ch INNER JOIN `country` as c ON ch.`country_id` = c.`id` WHERE c.id = ? ORDER BY ch.`name` ASC;")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!($stmt->bind_param("i",$countryinfo['id']))){
                            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result($name, $title, $age, $country)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $title . "\n</td>\n<td>\n" . $age . "\n</td>\n<td>\n" . $country . "\n</td>\n</tr>";
                        }
                        $stmt->close();
                    ?>
                </table>
            </div>
            <div class="foot">
                <form action="Character.php">
                    <input class="input-secondary" type="submit" value="Back to Characters" />
                </form>
            </div>
        </div>
    </body>
</html>