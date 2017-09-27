<?php
    $page_title = "Adventure! - Items by Country";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <?php
                        $countryinfo = json_decode($_POST['country'], TRUE);
                        echo "<caption>Items by Origin - ". $countryinfo['name'] ."</caption>";     
                    ?>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <?php
                        if(!($stmt = $mysqli->prepare("SELECT i.`name`, i.`value`, c.`name` FROM `item` as i
                                                            INNER JOIN `country` as c
                                                            ON i.`country_id` = c.`id`
                                                            WHERE c.id = ?
                                                            ORDER BY i.`name` ASC;")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!($stmt->bind_param("i",$countryinfo['id']))){
                            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result($name, $value, $country)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $name . "\n</td>\n<td class=\"td-num\">\n" . $value . "\n</td>\n<td>\n" . $country . "\n</td>\n</tr>";
                        }
                        $stmt->close();
                    ?>
                </table>
            </div>
            <div class="foot">
                <form action="Item.php">
                    <input class="input-secondary" type="submit" value="Back to Items" />
                </form>
            </div>
        </div>
    </body>
</html>