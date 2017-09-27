        <?php
            $page_title = "Adventure! - Delete Equipment";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("DELETE FROM `character_item` WHERE `character_item`.id = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("i",$_POST['equipment']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Deleted " . $stmt->affected_rows . " rows from Character_Item.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Equipment.php">
                    <input class="input-secondary" type="submit" value="Back to Equipment" />
                </form>
            </div>
        </div>
    </body>
</html>