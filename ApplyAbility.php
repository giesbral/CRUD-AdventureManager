        <?php
            $page_title = "Adventure! - Delete Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("INSERT INTO `character_ability`(`character_id`, `ability_id`)
                                                    SELECT c.id, a.id FROM `character` AS c
                                                    CROSS JOIN ability AS a
                                                    WHERE c.id = ? AND a.id = ?"))){
                echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("ii",$_POST['character'],$_POST['ability']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Added " . $stmt->affected_rows . " rows to character_ability.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Character.php">
                    <input class="input-secondary" type="submit" value="Back to Characters" />
                </form>
                <form action="Ability.php">
                    <input class="input-secondary" type="submit" value="Back to Abilities" />
                </form>
            </div>
        </div>
    </body>
</html>