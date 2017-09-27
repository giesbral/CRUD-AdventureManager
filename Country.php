<?php
    $page_title = "Countries";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>Country</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($stmt = $mysqli->prepare("SELECT country.`name` FROM country
                                                            ORDER BY country.`name` ASC;")))
                            {
                                echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                            }

                            if(!$stmt->execute())
                            {
                                echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }

                            if(!$stmt->bind_result($name))
                            {
                                echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }
                            
                            while($stmt->fetch())
                            {
                                echo "<tr>\n<td>\n" . $name . "\n</td>\n</tr>";
                            }
                            $stmt->close();
                        ?>
                    </tbody>    
                </table>
            </div>

            <div>
                <form method="post" action="AddCountry.php">
                    <fieldset>
                        <legend>Add/Update Country</legend>
                        <div class="form-text">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name"/>
                            </div>
                        </div>
                        <div class="form-select">
                            <label for="ucountry">Country to Update</label>
                            <select name="ucountry">
                                <option disabled selected value></option>
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT id, name FROM country")))
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
                            <input class="input-primary" type="submit" name="create" value="Create Country"/>
                            <input class="input-secondary" type="submit" name="update" value="Update Country"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="DeleteCountry.php">
                    <fieldset>
                        <legend>Delete Country</legend>
                        <div class="form-select">
                            <label for="country">Country to Delete</label>
                            <select name="country">
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT id, name FROM country")))
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
                            <input class="input-primary" type="submit" name="Filter" value="Delete Country"/>
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