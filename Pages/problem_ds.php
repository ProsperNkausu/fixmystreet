<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="alert">
           <?php 
            echo "<p><b>Problem description:</b> " . htmlspecialchars($row['problem_discription']) . "</p>";
            echo "<p>date:</b> " . htmlspecialchars($row['date']) . "</p>";
           ?>
            
        </div>   
</body>
</html>