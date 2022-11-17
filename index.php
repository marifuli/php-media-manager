<?php

//- Config for the file
$config = [
    'user' => ['username' => 'admin', 'password' => 'admin'], //- For upload, edit and delete
    'cache_path' => 'cache/'
];

//- App codes
session_start();
$cache_path = $config['cache_path'];

//--------- FUNCTIONS ----------
function join_paths ($path1, $path2) {
    return rtrim($path1, '/') . '/' . ltrim($path2, '/');
}

//--------- SHOW FILES ---------
$working_path = __DIR__ ;
if($_GET['path'] && $_GET['path'] !== '/') {
    $path = $_GET['path'];
    $working_path = join_paths($working_path, $path);
}
// var_dump($working_path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            
            foreach(array_diff(scandir($working_path), ['.', '..']) as $file)
            {
                $main_path = join_paths($working_path, $file);
                $mime = @explode(';', shell_exec("file -bi " . escapeshellarg($main_path)))[0];
                $type = @explode('/', $mime)[0];
                // $info = mime_content_type($file);
                ?>

                <?php
            }        
            ?>
        </div>
    </div>
</body>
</html>

