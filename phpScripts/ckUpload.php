<?php

if (isset($_FILES['upload']['name'])) {


    $file = $_FILES['upload']['tmp'];
    $fileName = $_FILES['upload']['name'];
    $fileNameArray = explode('.', $fileName);
    $fileExtention = end($fileNameArray);
    $newFileName = rand() . '.' . $fileExtention;
    chmod('upload', 0777);
    $allwoedExtention = array('jpg', 'gif', 'png');
    if (in_array($fileExtention, $allwoedExtention)) {
        copy($file, '/admin/img/' . $newFileName);
        $functionNumber = $_GET['CKEditorFunc'];
        $url = '/admin/img/' . $newFileName;
        $message = '';
        echo '<script>

                window.parent.CKEDITOR.tools.callFunction(' . $functionNumber . $url . $message . ');

              </script>';
    }// end if
}// end if
