        <?php
            $page_title = "Adventure! - Delete Country";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("DELETE FROM `country`
                                                    WHERE `country`.`id` = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("i",$_POST['country']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Deleted " . $stmt->affected_rows . " rows from Country.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Country.php">
                    <input class="input-secondary" type="submit" value="Back to Countries" />
                </form>
            </div>
        </div>
    </body>
</html>