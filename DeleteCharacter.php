        <?php
            $page_title = "Adventure! - Delete Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("DELETE FROM `character` WHERE `character`.id = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("i",$_POST['character']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Deleted " . $stmt->affected_rows . " rows from Characters.";
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