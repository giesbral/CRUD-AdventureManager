<?php
    $page_title = "Adventure! - Equipment by Character";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <?php
                        $charinfo = json_decode($_POST['character'], TRUE);
                        echo "<caption>Equipment by Character -</br>". $charinfo['name'] ."</caption>";     
                    ?>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Durability</th>
                            <th>Owner</th>
                        </tr>
                    </thead>
                    <?php
                        if(!($stmt = $mysqli->prepare("SELECT  i.`name`, ci.`durability`, ch.`name` FROM `character_item` as ci
                                                            INNER JOIN `character` as ch
                                                            ON ci.`character_id` = ch.`id`
                                                            INNER JOIN `item` as i
                                                            ON ci.`item_id` = i.`id`
                                                            WHERE ch.id = ?
                                                            ORDER BY i.`name` ASC;")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!($stmt->bind_param("i",$charinfo['id']))){
                            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result($item, $durability, $character)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $item . "\n</td>\n<td class=\"td-num\">\n" . $durability . "\n</td>\n<td>\n" . $character . "\n</td>\n</tr>";
                        }
                        $stmt->close();
                    ?>
                </table>
            </div>
            <div class="foot">
                <form action="Equipment.php">
                    <input class="input-secondary" type="submit" value="Back to Equipment" />
                </form>
            </div>
        </div>
    </body>
</html>