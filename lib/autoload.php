<?php
/**
 * @Created by          : Waris Agung Widodo (ido.alit@gmail.com)
 * @Date                : 24/03/20 11.21
 * @File name           : autoload.php
 *
 * Original source code : https://stackoverflow.com/a/39774973
 */

$namespaces = [
  "SLiMS\\" => "/"
];

foreach ($namespaces as $namespace => $classpaths) {
  if (!is_array($classpaths)) {
    $classpaths = array($classpaths);
  }
  spl_autoload_register(function ($classname) use ($namespace, $classpaths) {
    if (preg_match("#^" . preg_quote($namespace) . "#", $classname)) {
      $classname = str_replace($namespace, "", $classname);
      $filename = preg_replace("#\\\\#", "/", $classname) . ".php";
      foreach ($classpaths as $classpath) {
        $fullpath = __DIR__ . "/" . $classpath . "/$filename";
        if (file_exists($fullpath)) include_once $fullpath;
      }
    }
  });
}