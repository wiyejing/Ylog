<?php
exec('locale -a', $out, $ret);
header('Content-type: text/plain');
if ($ret === 0) {
  echo join("\n", $out);
} else {
  echo 'Error: locale -a';
}