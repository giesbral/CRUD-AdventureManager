        <?php
            $page_title = "Adventure! - Add/Update Equipment";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(isset($_POST['create']))
                {
                    if(!($stmt = $mysqli->prepare("INSERT INTO `character_item`(`item_id`, `durability`, `character_id`) 
                                                            VALUES (?, ?, ?)"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("iii",$_POST['item'],$_POST['durability'],$_POST['character']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Added " . $stmt->affected_rows . " rows to Character_Item.";
                    }
                    $stmt->close();
                }      
                else
                {
                    if(!($stmt = $mysqli->prepare("UPDATE `character_item` as ci
														SET `ci`.`item_id` = ?,
															`ci`.`character_id` = ?,
															`ci`.`durability` = ?
														WHERE `ci`.`id` = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("iiii",$_POST['item'],$_POST['character'],$_POST['durability'],$_POST['uequipment']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Updated " . $stmt->affected_rows . " rows in Character_Item.";
                    }
                    $stmt->close();
                }
            ?>
            <div class="foot">
                <form action="Equipment.php">
                    <input class="input-secondary" type="submit" value="Back to Equipment" />
                </form>
            </div>
        </div>
    </body>
</html>