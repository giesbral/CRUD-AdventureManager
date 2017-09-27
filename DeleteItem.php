        <?php
            $page_title = "Adventure! - Delete Item";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(!($stmt = $mysqli->prepare("DELETE FROM `item` WHERE `item`.id = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!($stmt->bind_param("i",$_POST['item']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                if(!$stmt->execute()){
                    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                } else {
                    echo "</br>Deleted " . $stmt->affected_rows . " rows from Item.";
                }
                $stmt->close();
            ?>
            <div class="foot">
                <form action="Item.php">
                    <input class="input-secondary" type="submit" value="Back to Items" />
                </form>
            </div>
        </div>
    </body>
</html>