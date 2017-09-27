<?php
    $page_title = "Adventure! - Characters by Deity";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <?php
                        $deityinfo = json_decode($_POST['deity'], TRUE);
                        echo "<caption>Characters by Deity -</br>". $deityinfo['name'] ."</caption>";     
                    ?>
                    <thead>
                        <tr>
                            <th>Deity</th>
                            <th>Character</th>
                        </tr>
                    </thead>
                    <?php
                        if(!($stmt = $mysqli->prepare("SELECT d.`name`, c.`name` FROM `deity` as d
                                                            JOIN `character_deity` as cd
                                                            ON d.`id` = cd.`deity_id`
                                                            JOIN `character` as c
                                                            ON cd.`character_id` = c.`id`
                                                            WHERE d.`id` = ?
                                                            ORDER BY c.`name` ASC")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!($stmt->bind_param("i",$deityinfo['id']))){
                            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        if(!$stmt->bind_result($dname, $cname)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $dname . "\n</td>\n<td>\n" . $cname . "\n</td>\n</tr>";
                        }
                        $stmt->close();
                    ?>
                </table>
            </div>
            <div class="foot">
                <form action="Deity.php">
                    <input class="input-secondary" type="submit" value="Back to Deities" />
                </form>
                <form action="Character.php">
                    <input class="input-secondary" type="submit" value="Back to Characters" />
                </form>
            </div>
        </div>
    </body>
</html>