<?php

include("include/template.php");
include("include/body.php");

include_css("/css/index.css");
include_css("/css/home.css");

$html = '';

/* Header */
$html .= render_page_start();
$html .= render_head();
$html .= render_body_start();
$html .= render_header();

$html .= render_page_body_start();
$html .= render_projects();
$html .= render_page_body_end();

$html .= render_body_end();
$html .= render_page_end();

echo $html;

?>
