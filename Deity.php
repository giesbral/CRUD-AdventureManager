<?php
    $page_title = "Deities";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>Dieties</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($stmt = $mysqli->prepare("SELECT deity.`name`, deity.`title`, deity.`age` FROM `deity` ORDER BY `name` ASC")))
                            {
                                echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                            }

                            if(!$stmt->execute())
                            {
                                echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }

                            if(!$stmt->bind_result($name, $title, $age))
                            {
                                echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }
                            
                            while($stmt->fetch())
                            {
                                echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $title . "\n</td>\n<td class=\"td-num\">\n" . $age . "\n</td>\n</tr>";
                            }
                            $stmt->close();
                        ?>
                    </tbody>    
                </table>
            </div>

        <div>
            <div>
                <form method="post" action="AddDeity.php"> <!--CHANGE-->
                    <fieldset>
                        <legend>Add/Update Deity</legend>
                        <div class="form-text">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name"/>
                            </div>
                            <div>
                                <label for="title">Title</label>
                                <input type="text" name="title"/>
                            </div>
                            <div>
                                <label for="age">Age</label>
                                <input type="text" name="age"/>
                            </div>
                        </div>
                        <div class="form-select">
                            <label for="udeity">Deity to Update</label>
                            <select name="udeity">
                                <option disabled selected value></option>
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT d.`id`, d.`name` FROM `deity` as d")))
                                    {
	                                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="create" value="Create Deity"/>
                            <input class="input-secondary" type="submit" name="update" value="Update Deity"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="CharactersByDeity.php"> <!--CHANGE-->
                    <fieldset>
                        <legend>Filter Characters by their Creator</legend>
                        <div class="form-select">
                            <label for="deity">Deity</label>
                            <select name="deity">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT d.`id`, d.`name` FROM `deity` as d")))
                                    {
	                                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo "<option value='{\"id\":\"" . $id . "\",\"name\":\"" . $name . "\"}'>" . $name . "</option>\n";
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                    
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="filter" value="Apply Filter"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="AllCharactersAllDeities.php">
                    <fieldset>
                        <legend>All Characters and their Creator(s)</legend>                  
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="filter" value="Apply Filter"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="DeleteDeity.php"> <!--CHANGE-->
                    <fieldset>
                        <legend>Delete Deity</legend>
                        <div class="form-select">
                            <label for="character">Deity to Delete</label>
                            <select name="character">
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT d.`id`, d.`name` FROM `deity` as d")))
                                    {
	                                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="Filter" value="Delete Deity"/>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="foot">
                <form action="Home.php">
                    <input class="input-secondary" type="submit" value="Home" />
                </form>
            </div>
        </div>  
    </body>
</html>