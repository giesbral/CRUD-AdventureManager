<?php
    $page_title = "Adventure! - Abilities by Patron";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <?php
                        $deityinfo = json_decode($_POST['deity'], TRUE);
                        echo "<caption>Abilities by Patron -</br>". $deityinfo['name'] ."</caption>";     
                    ?>
                    <thead>
                        <tr>
                            <th>Ability</th>
                            <th>Description</th>
                            <th>Deity</th>
                        </tr>
                    </thead>
                    <?php
                        if(!($stmt = $mysqli->prepare("SELECT a.`name`, a.`description`, d.`name` FROM `ability` as a
                                                            INNER JOIN `deity` as d
                                                            ON a.`deity_id` = d.`id`
                                                            WHERE d.id = ?
                                                            ORDER BY a.`name` ASC;")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!($stmt->bind_param("i",$deityinfo['id']))){
                            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result($name, $description, $deity)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $description . "\n</td>\n<td>\n" . $deity . "\n</td>\n</tr>";
                        }
                        $stmt->close();
                    ?>
                </table>
            </div>
            <div class="foot">
                <form action="Ability.php">
                    <input class="input-secondary" type="submit" value="Back to Abilities" />
                </form>
            </div>
        </div>
    </body>
</html>