<?php
// test/unit/JobeetTest.php
require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(9, new lime_output_color());
 
$t->comment('::slugfy()');
$t->is(Jobeet::slugfy('Sensio'), 'sensio', '::slugfy() converts all characters to lower case');
$t->is(Jobeet::slugfy('sensio labs'), 'sensio-labs', '::slugfy() replaces a white space by a -');
$t->is(Jobeet::slugfy('sensio   labs'), 'sensio-labs', '::slugfy() replaces several white spaces by a single -');
$t->is(Jobeet::slugfy('  sensio'), 'sensio', '::slugfy() removes - at the beginning of a string');
$t->is(Jobeet::slugfy('sensio  '), 'sensio', '::slugfy() removes - at the end of a string');
$t->is(Jobeet::slugfy('paris,france'), 'paris-france', '::slugfy() replaces non-ASCII characters by a -');
$t->is(Jobeet::slugfy(''), 'n-a', '::slugify() converts the empty string to n-a');
$t->is(Jobeet::slugfy(' - '), 'n-a', '::slugify() converts a string that only contains non-ASCII characters to n-a');
if (function_exists('iconv')){
  $t->is(Jobeet::slugfy('Développeur Web'), 'developpeur-web', '::slugify() removes accents');
}else{
  $t->skip('::slugify() removes accents - iconv not installed');
}
?>