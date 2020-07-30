<?php
// var_dump($_FILE);
// exit();

// 送信が正常に行われたときの処理
if(isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0){
  $uploadedFileName = $_FILES['upfile']['name']; //ファイル名の取得
  $tempPathName = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所
  $fileDirectoryPath = 
  'upload/'; //アップロード先フォルダ（自分で決める）

  $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
  $uniqueName = date('YmdHis').md5(session_id()) . "." . $extension;
  $fileNameToSave = $fileDirectoryPath.$uniqueName;
  // var_dump($fileNameToSave);
  // exit();

if(is_uploaded_file($tempPathName)) {
  if (move_uploaded_file($tempPathName, $fileNameToSave)) {
      chmod($fileNameToSave,0644);
      $img = '<img src="'. $fileNameToSave . '" >';
    } else {
      exit('Error:保存できませんでした');
    }
  } else {
    exit('Error:ファイルがありません');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>file_upload</title>
</head>

<body>
<form action="file_upload.php" method="POST" enctype="multipart/form-data">
  <?= $img ?>
</body>

</html>