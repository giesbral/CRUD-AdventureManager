        <?php
            $page_title = "Adventure! - Delete Ability";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("DELETE FROM `ability` WHERE `ability`.`id` = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("i",$_POST['ability']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Deleted " . $stmt->affected_rows . " rows from Ability.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Ability.php">
                    <input class="input-secondary" type="submit" value="Back to Abilities" />
                </form>
            </div>
        </div>
    </body>
</html>