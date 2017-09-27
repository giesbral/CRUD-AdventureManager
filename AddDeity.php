        <?php
            $page_title = "Adventure! - Delete Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
				if(isset($_POST['create']))
				{
					if(!($stmt = $mysqli->prepare("INSERT INTO `deity`(`name`, `title`, `age`) VALUES (?,?,?)"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!($stmt->bind_param("ssi",$_POST['name'],$_POST['title'],$_POST['age']))){
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
					} else {
						echo "</br>Added " . $stmt->affected_rows . " rows to Deity.";
					}
					$stmt->close();
				}      
				else
				{
					if(!($stmt = $mysqli->prepare("UPDATE `deity` SET `deity`.`name` = ?, `deity`.`title` = ?, `deity`.`age` = ? WHERE `deity`.`id` = ?"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!($stmt->bind_param("ssii",$_POST['name'],$_POST['title'],$_POST['age'],$_POST['udeity']))){
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
					} else {
						echo "</br>Updated " . $stmt->affected_rows . " rows in Deity.";
					}
					$stmt->close();
				}
			?>
			<div class="foot">
				<form action="Deity.php">
					<input class="input-secondary" type="submit" value="Back to Deities" />
				</form>
			</div>
		</div>
    </body>
</html>