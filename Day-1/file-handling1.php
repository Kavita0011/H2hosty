<?php
// file reading through script
// $file=fopen("day1.txt","r");
// $content=fread($file,filesize("day1.txt"));
// echo ("$content");
// fclose($file);
  
//   // Open the file in write mode
//   $file1 = fopen("gfg.txt", 'w+');
  
//   if ($file1) {
//       $text = $content;
//       fwrite($file1, $text);
//         fclose($file1);
//   }

//   deleting file
  if(file_exists("data.json")) {
    unlink("data.json");
    echo "done";

  }else{
    echo "file doesn't exist";
  }
  
  ?>
