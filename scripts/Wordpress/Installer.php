<?php

namespace Wordpress;

use Composer\Script\Event;

class Installer {
  /**
  * Languages are installed into vendor directory so we can just copy the contents
  * of multiple directories into languages folder
  */
  public static function installLanguages(Event $event) {
    $io = $event->getIO();
    $extra = $event->getComposer()->getPackage()->getExtra();
    if (!empty($extra['wordpress-languages-dir'])) {

      $root = dirname(dirname(__DIR__));
      $wp_languages_folder = "{$root}/{$extra['wordpress-languages-dir']}";
      $wp_languages_vendor = "{$root}/vendor/koodimonni-language";

      if (!file_exists($wp_languages_folder)) {
        $io->write("wordpress-languages-dir doesn't exist!");
        exit(1);
      }

      $io->write("Copying languagefiles into: {$wp_languages_folder}");
      //Copy all but composer.json
      exec("rsync -va {$wp_languages_vendor}/*/* {$wp_languages_folder} --exclude=composer.json");
    }
  }
  /**
  * Remove wp-content from wordpress and symlink it to correct location
  */
  public static function symlinkContent(Event $event) {
    $io = $event->getIO();
    $root = dirname(dirname(__DIR__));
    $wp_core_content_folder = "{$root}/htdocs/wordpress/wp-content";
    $wp_content_folder = "{$root}/htdocs/wp-content";

    if (!is_link($wp_core_content_folder)) {
      if(file_exists($wp_core_content_folder)) {
        Installer::rrmdir($wp_core_content_folder);
      }
      symlink("../wp-content", $wp_core_content_folder);
      $io->write("Removed wp-content from core and symlinked it to {$wp_content_folder}");
    }
  }

  //Remove dir recursively
  public static function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
      if(is_dir($file)) Installer::rrmdir($file); else unlink($file);
    } rmdir($dir);
  }
}