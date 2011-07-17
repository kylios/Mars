<?php

include("include/template.php");
include("include/body.php");

include_css("/css/index.css");
include_css("/css/home.css");

include_js("https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js");
include_js("/js/terminal.js");

$html = '';

$html .= render_page_start();
$html .= render_head();
$html .= render_body_start();

$html .= render_page_body_start();
$html .= render_terminal();
$html .= render_page_body_end();

$html .= render_body_end();
$html .= render_page_end();

echo $html;

?>
