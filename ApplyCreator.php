        <?php
            $page_title = "Adventure! - Delete Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("INSERT INTO `character_deity`(`character_id`, `deity_id`)
                                                    SELECT c.id, d.id FROM `character` AS c
                                                    CROSS JOIN deity AS d
                                                    WHERE c.id = ? AND d.id = ?"))){
                echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("ii",$_POST['character'],$_POST['deity']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Added " . $stmt->affected_rows . " rows to character_deity.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Character.php">
                    <input class="input-secondary" type="submit" value="Back to Characters" />
                </form>
            </div>
        </div>
    </body>
</html>