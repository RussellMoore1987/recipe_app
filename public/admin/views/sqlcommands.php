<?php
  $link = 'http://localhost:8080/recipe_app/public/api/contextApi/v1/';

  var_dump(get_include_path());
  // var_dump($_SERVER['DOCUMENT_ROOT']);

  if (isset($_GET['create'])) {
    $data = post($link, ['instructions' => '{"createAllTables":"devTool::devTool_create_all_tables"}']);
    var_dump($data);
  }

  if (isset($_GET['insert'])) {
//    {"insertRecordsAll":"devTool::devTool_insert_records_all"}
    $data = post($link, ['instructions' => '{"insertRecordsAll":"devTool::devTool_insert_records_all"}']);
    var_dump($data);
  }

  if (isset($_GET['drop'])) {
  //  {"dropAllTables":"devTool::devTool_drop_all_tables"}
    $data = post($link, ['instructions' => '{"dropAllTables":"devTool::devTool_drop_all_tables"}']);
    var_dump($data);
  }

  if (isset($_GET['all'])) {
    $data = post($link, ['instructions' => '{"dropAllTables":"devTool::devTool_drop_all_tables","createAllTables":"devTool::devTool_create_all_tables","insertRecordsAll":"devTool::devTool_insert_records_all"}']);
    var_dump($data);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <a href="sqlcommands">No Commands</a><br>
  <a href="sqlcommands?create=yes">Create</a><br>
  <a href="sqlcommands?insert=yes">Insert</a><br>
  <a href="sqlcommands?drop=yes">Drop</a><br>
  <a href="sqlcommands?all=yes">All</a>
</body>
</html>