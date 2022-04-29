<?php

namespace Drupal\word_counter;

class WordCounter {

  /**
   * Count words in text, can contain html tags, which doesn't count.
   *
   * @param string|null $text Count contain words
   *
   * @return int count words in text
   */
  public static function count(?string $text): int{
    if (!$text) {
      return 0;
    }

    $textWithoutTags = strip_tags($text);
    $res = preg_split('/(&nbsp;|\W)/u', $textWithoutTags, -1, PREG_SPLIT_NO_EMPTY);
    return count($res);
  }

}
