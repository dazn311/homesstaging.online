<?php
function getFileNameFromDir() {
  global $root_path2;
  $dir = $root_path2 . $_ENV['BASE_API_URL']; // Замените на нужный вам путь
  $pattern = $dir . '/Kramp/' . '*.json'; // Шаблон для поиска файлов с расширением .php

  require $root_path2 . '/Lib/Utils/printLine.php';
  
  // echo $pattern;
  $files = glob($pattern);

  if ($files) {
      foreach ($files as $file) {
          // echo $file . "<br>";
          // printLine($file);
      }
  } else {
      echo "Файлы не найдены";
  }

  $dir = $root_path2 . $_ENV['BASE_API_URL'] . '/Kramp/'; // Замените на нужный вам путь
  $files = scandir($dir);

  if ($files) {
      foreach ($files as $file) {
          if ($file !== '.' && $file !== '..') { // Исключаем текущую и родительскую директории
              $filepath = $dir . $file;
              if (is_file($filepath) && strpos($file, '1248304') !== false) { // Проверяем, что это файл и ищем по имени
                  echo $filepath . "<br>";
                  // printLine($filepath);
              }
          }
      }
  } else {
      echo "Не удалось открыть директорию";
  }
}