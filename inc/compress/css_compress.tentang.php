<?php
	header('Content-type: text/css');
	ob_start('compress_css');
	 
	function compress_css($buffer) {
	  /* remove comments in css file */
	  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	  /* also remove tabs, spaces, newlines, etc. */
	  $buffer = str_replace(array("\r", "\n", "\r\n", "\t", '  ', '    ', '    '), '', $buffer);
	  return $buffer;
	}
		include ('../../css/google.font.css');
		include('../../css/html_reset.css');
		include('../../css/tentang.css');
		include('../../css/bootstrap.min.css');
 
	ob_end_flush();
?>