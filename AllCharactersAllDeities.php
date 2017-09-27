<?php
    $page_title = "Adventure! - All Characters and their Creator(s)";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>All Characters and their Creator(s)</caption>
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
                                                            ORDER BY d.`name` ASC;")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }

                        if(!$stmt->bind_result($deity, $character)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $deity . "\n</td>\n<td>\n" . $character . "\n</td>\n</tr>";
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