        <?php
            $page_title = "Adventure! - Delete Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("DELETE FROM `deity` WHERE `deity`.id = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("i",$_POST['deity']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Deleted " . $stmt->affected_rows . " rows from Deity.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Deity.php">
                    <input class="input-secondary" type="submit" value="Back to Deities" />
                </form>
            </div>
        </div>
    </body>
</html>