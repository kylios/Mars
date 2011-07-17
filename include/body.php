<?php

function render_page_body_start() {
    return '
        <div class="body">';
}

function render_page_body_end() {
    return '
        </div>';
}

function render_terminal() {
    /* Terminal header area */
    $html = '
        <div class="terminal">
            <div class="inner">
<!--                 <label for="text_entry"><input name="text_entry" type="text" id="text_entry" class="entry" /><br /> 
                </label>-->
                <div id="text" class="text">
                </div>
                <div class="cursor">
                    &nbsp;
                </div>
            </div>
        </div>';

    return $html;
}

function render_home() {
    /* Mars header area */
    $html = '
<!--        <div class="mars_image">
            <div class="mars_text">
                Mars
            </div>             
            <div class="courtesy_nasa">
                Image courtesy of NASA
            </div>
        </div> -->';

    /* Start of content area */
    $html .= '
        <div class="content">
            <h1>Kyle Racette</h1>
            <p>This is my homepage.  TODO: insert more text here  </p>
            <p>This page is powered by my home desktop computer/server.  Here are some general specifications in case you are interested: </p>
            <table border=0 cellpadding=0 cellspacing=0>
            <tbody>
                <tr><td class="bold">Operating System</td><td>Arch Linux x86_64</td></tr>
                <tr><td class="bold">Processor</td><td>AMD Phenom II x4 955 Black Edition Deneb 3.2GHz</td></tr>
                <tr><td class="bold">RAM</td><td>4 GiB</td></tr>
                <tr><td class="bold">Hard Disk</td><td>
                    <ul>
                        <li>160 GiB for OS and applications</li>
                        <li>4x500 GiB in a RAID 5 configuration</li>
                    </ul></td></tr>
            </tbody>
            </table>

            <h3>Additional Information:</h3>
            <p>I use xmonad, tiling window manager, as I have found tiling to greatly increase productivity and decrease frustration when having to move and find windows.  Using xmonad for nearly a year now has prompted me to explore haskell and the functional programming paradigm.  In addition to tiling, I use a typematrix non-staggered keyboard with the dvorak layout.  My prefferred editor is VIM (please don\'t let this fact hinder any chances of employment, networking, or otherwise interest in me or this website).  I run a dual-monitor setup, and have found that 19 inch monitors are near-perfect.  As a consequence of my tiling wm usage, applications requiring a mouse are no longer desirable, therefore I\'ve switched to using irssi for aim/irc, ncmpcpp for mpd control, and pentadactyl and uzbl for web browsing.  </p>

            <h2>History</h2>
            <p>The Mars theme comes from my computer\'s hostname, which happens to be mars.  Alas, it is no coincidence!  All the computers I own are named after celestial bodies, and since my server is named mars, so is this webpage. </p>
        </div>';
    
    return $html;
}

function render_about() {
    $html = '
        <div class="content">
            <h1>About Kyle Racette</h1>
            <p>By profession, I am a software engineer, systems administrator, systems architect, and free software advocate.  I currently live in Arlington, Va and commute to Reston every day for my job with the web startup <a href="koofers.com">Koofers</a>.  
            </p>
            <h2>Hobbies</h2>
            <ul>
            <li>Hiking</li>
            <li>Solving problems</li>
            <li>Guitar and banjo</li>
            <li>Biking</li>
            <li>Reading</li>
            <li>Exploring and discovering new things</li>
            <li>Meeting cool people</li>
            <li>Reddit</li>
            <li>Linux</li>
            </ul>
            <h2>Other Interests</h2>
            <ul>
            <li>Mathematics and science</li>
            <li>Buddhism</li>
            <li>Free Culture</li>
            <li>Marijuana uses and legalization</li>
            <li>Thinking about how we can make the world a better place</li>
            </ul>
        </div>
        ';

    return $html;
}

function render_projects() {
    $html = '
        <div class="content">

        </div>
        ';
}

?>
