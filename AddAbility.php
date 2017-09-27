        <?php
            $page_title = "Adventure! - Delete Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(isset($_POST['create']))
                {
                    if(!($stmt = $mysqli->prepare("INSERT INTO `ability`(`name`, `description`, `deity_id`) 
														VALUES (?, ?, ?);"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("ssi",$_POST['name'],$_POST['description'],$_POST['deity']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Added " . $stmt->affected_rows . " rows to Abilities.";
                    }
                    $stmt->close();
                }      
                else
                {
                    if(!($stmt = $mysqli->prepare("UPDATE `ability`
														SET `ability`.`name` = ?,
															`ability`.`description` = ?,
															`ability`.`deity_id` = ?   
														WHERE `ability`.`id` = ?;"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("ssii",$_POST['name'],$_POST['description'],$_POST['deity'],$_POST['uability']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Updated " . $stmt->affected_rows . " rows in Ability.";
                    }
                    $stmt->close();
                }
            ?>
            <div class="foot">
                <form action="Ability.php">
                    <input class="input-secondary" type="submit" value="Back to Abilities" />
                </form>
            </div>
        </div>
    </body>
</html>