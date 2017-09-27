        <?php
            $page_title = "Adventure! - Add/Update Country";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(isset($_POST['create']))
                {
                    if(!($stmt = $mysqli->prepare("INSERT INTO `country`(`name`) 
														VALUES (?);"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("s",$_POST['name']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Added " . $stmt->affected_rows . " rows to Country.";
                    }
                    $stmt->close();
                }      
                else
                {
                    if(!($stmt = $mysqli->prepare("UPDATE `country`
														SET `country`.`name` = ?
														WHERE `country`.`id` = ?;
														"))){
                    	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("si",$_POST['name'],$_POST['ucountry']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Updated " . $stmt->affected_rows . " rows in Country.";
                    }
                    $stmt->close();
                }
            ?>
            <div class="foot">
                <form action="Country.php">
                    <input class="input-secondary" type="submit" value="Back to Countries" />
                </form>
            </div>
        </div>
    </body>
</html>