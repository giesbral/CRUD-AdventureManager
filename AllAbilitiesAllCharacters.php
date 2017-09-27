<?php
    $page_title = "Adventure! - All Abilities for All Characters";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>All Abilities for All Characters</caption>
                    <thead>
                        <tr>
                            <th>Character</th>
                            <th>Ability</th>
                        </tr>
                    </thead>
                    <?php
                        if(!($stmt = $mysqli->prepare("SELECT ch.`name`, a.`name` FROM `ability` as a
                                                            INNER JOIN `character_ability` as ca
                                                            ON a.`id` = ca.`ability_id`
                                                            INNER JOIN `character` as ch
                                                            ON ca.`character_id` = ch.`id`
                                                            ORDER BY ch.`name`, a.`name` ASC;")))
                        {
                            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                        }

                        if(!$stmt->execute()){
                            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }

                        if(!$stmt->bind_result($character, $ability)){
                            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                        }
                        
                        while($stmt->fetch()){
                        echo "<tr>\n<td>\n" . $character . "\n</td>\n<td>\n" . $ability . "\n</td>\n</tr>";
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