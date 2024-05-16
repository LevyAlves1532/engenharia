<?php

global $extensions;
$extensions = [
  'image/png' => 'png',
  'image/jpg' => 'jpg',
  'image/jpeg' => 'jpg',
  'application/pdf' => 'pdf',
  'application/x-zip-compressed' => 'zip',
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
];

function uploadFile($file) {
  global $extensions;

  if (!empty($file['tmp_name'])) {
    $extension = $extensions[$file['type']];
    $file_name = md5(date('Y-m-d H:i:s') . rand(0, 9999)) . '.' . $extension;

    $folder_name = date('Y-m-d');
    $path = 'assets/images/' . $folder_name;

    if (!file_exists($path)) {
      mkdir($path);
    }

    $path = $path . '/' . $file_name;
    move_uploaded_file($file['tmp_name'], $path);

    return BASE . $path;
  } else {
    return null;
  }
}

function uploadMutipleFiles($files) {
  global $extensions;
  $arr = [];

  for ($x=0;$x<count($files['tmp_name']);$x++) {
    if (!empty($files['tmp_name'][$x])) {
      $extension = $extensions[$files['type'][$x]];
      $file_name = md5(date('Y-m-d H:i:s') . rand(0, 9999)) . '.' . $extension;
      
      $folder_name = date('Y-m-d');
      $path = 'assets/images/' . $folder_name;
      
      if (!file_exists($path)) {
        mkdir($path);
      }

      $path = $path . '/' . $file_name;
      move_uploaded_file($files['tmp_name'][$x], $path);

      array_push($arr, BASE . $path);
    } else {
      break;
    }
  }

  return $arr;
}

function deleteFile($file_path) {
  $path_old = parse_url($file_path, PHP_URL_PATH); // Extrair o caminho da URL
  $filename_with_dir = basename($path_old); // Obter a parte final do caminho (nome do arquivo com diretório)
  $parent_dir = dirname($path_old); // Obter o diretório pai do arquivo
  $last_two_parts = '/' . substr($parent_dir, strrpos($parent_dir, '/') + 1) . '/' . $filename_with_dir; // Obter as duas últimas partes

  if (file_exists('assets/images' . $last_two_parts)) {
    unlink('assets/images' . $last_two_parts);
  }
}
