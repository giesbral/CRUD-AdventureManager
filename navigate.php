<script type="text/javascript">
    function toggleDropdown() 
    {
        document.getElementById("nav-dropdown").classList.toggle("show");
    }

    window.onclick = function (event) 
    {
        if (!event.target.matches('.dropdown-toggle')) {

            var dropdowns = document.getElementsByClassName("dropdown-menu");

            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };
</script>

<nav id="nav">
    <div id="navbar">
        <div id="navbar-title">
            <a id="navbar-brand" href="Home.php">ADVENTURE!</a>
        </div>
        <div class="dropdown">
            <?php
                echo '<button class="dropdown-toggle" onclick="toggleDropdown()">'. $page_title . '</button>';
            ?>
            <div id="nav-dropdown" class="dropdown-menu">
                <a class="nav-menu-option" href="Character.php">Characters</a>
                <a class="nav-menu-option" href="Deity.php">Deities</a>
                <a class="nav-menu-option" href="Ability.php">Abilities</a>
                <a class="nav-menu-option" href="Country.php">Countries</a></>
                <a class="nav-menu-option" href="Item.php">Items</a>
                <a class="nav-menu-option" href="Equipment.php">Equipment</a>                
            </div>
        </div>
        <div id="connect-msg">
            <?php
                echo '<p id="msg">' . $success . '</p>';
            ?>
        </div>
    </div>
</nav>