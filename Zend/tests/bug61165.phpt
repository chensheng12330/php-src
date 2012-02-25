--TEST--
Bug #61165 (Segfault - strip_tags())
--XFAILD--
#61165 doesn't fix yet
--FILE--
<?php

$handler = NULL;
class T {
    public $_this;

    public function __toString() {
		global $handler;
	    $handler = $this;
        $this->_this = $this; // <-- uncoment this
        return 'A';
    }
}

$t = new T;
for ($i = 0; $i < 3; $i++) {
    strip_tags($t);
	strip_tags(new T);
    echo "$i\n";
}
--EXPECTF--
object(T)#%d (1) {
  ["_this"]=>
  *RECURSION*
}