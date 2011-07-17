<?php

$css_files = array();
$js_files = array();

function include_css($css) {
    global $css_files;
    $css_files[$css] = 1;
}

function include_js($js) {
    global $js_files;
    $js_files[$js] = 1;
}

function render_page_start() {
    return '
<html>';
}

function render_head() {
    global $css_files;
    global $js_files;

    $html = '
    <head>
        <title>MARS - Personal Page of Kyle Racette</title>';
    foreach ($css_files as $k => $v) {
        $html .= '
        <link rel="stylesheet" href="' . $k . '" type="text/css" />';
    }
    foreach ($js_files as $k => $v) {
        $html .= '
        <script type="text/javascript" src="' . $k . '"></script>';
    }
    $html .= '
    </head>';
    return $html;
}

function render_body_start() {
    return '
    <body>
        <center>';
}

function render_header() {
    return '
        <div class="header">' .
            render_menu("Home", "index.php") . 
            render_menu("About", "about.php") .
            render_menu("Projects", "projects.php", array(
                "taskd" => "",
                "barutils" => "",
                "compiler" => "",
                "kylux" => "",
                "server" => "",)) .
            render_menu("Resume", "resume.php") .
            render_menu("Websites", "websites.php", array(
                "koofers.com" => "http://koofers.com",
                "pinproject.com" => "http://www.pinproject.com",
                "github" => "http://github.com/morendi",
                "last.fm" => "http://last.fm/user/ilikemonkeys111",
                "facebook" => "https://facebook.com/kracette", 
                "identi.ca" => "https://identi.ca/morendi",
                "openid" => "http://morendi.myopenid.com",
            )) .
            render_menu("Links", "links.php") .'
       </div>';
}

function render_menu($name, $link, $items = array()) {
    $html = '
            <span class="button' . (count($items) ? ' dropdown' : '') . '">
                <a href="' . $link . '">' . $name . '</a>';
    if (count($items)) {
        $html .= '
                <div class="items">';
        foreach ($items as $name => $link) {
            $html .= '
                    <div class="item">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>';
        }
        $html .= '
                </div>';
    }
    $html .= '
            </span>';
    return $html;
}

function render_body_end() {
    return '
        </center>
    </body>';
}

function render_page_end() {
    return '
</html>';
}

?>
