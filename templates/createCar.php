<html>
    <head>
        <title>Home</title>
    </head>
    <body>
    <?php 
        if (isset($_GET['update'])) { 
            ?>
            <h1>Update Car</h1>
            <form method="post" action="controler.php?action=3">
                <input id="id" name="id" type="hidden" value="<?php echo $_GET['update']; ?>">
                <label for="make">Make:</label>
                <input type="text" name="make" id="make" value="<?php echo getMake($_GET['update']); ?>" required>
                <br>
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" value="<?php echo getModel($_GET['update']); ?>" required>
                <br>
                <label for="year">Year:</label>
                <input type="number" name="year" id="year" value="<?php echo getYear($_GET['update']); ?>" required>
                <br>
                <input type="submit" value="Update">
            </form>
            <?php 
        } else {
            ?>
            <h1>Create Car</h1>
            <form method="post" action="controler.php?action=2">
                <label for="make">Make:</label>
                <input type="text" name="make" id="make" required>
                <br>
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" required>
                <br>
                <label for="year">Year:</label>
                <input type="number" name="year" id="year" required>
                <br>
                <input type="submit" value="Create">
            </form>
            <?php 
        }
    ?>
    </body>
</html>