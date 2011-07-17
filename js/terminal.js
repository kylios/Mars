
// The terminal's cursor
cursor = null;
cursor_blink_interval = null;
cursor_row = 0;
cursor_col = 0;

// The terminal
terminal = null;

// Text goes in this element
terminal_text = null;
text_entry = null;

// Terminal info
contents = [
    "Welcome to the homepage of Kyle Racette!",
    "Type 'help' for a list of commands"
];
prompt = "guest@kyleracette.com > ";

// Input state variables
current_command = "";
shift = false;

$(document).ready(function(){

    cursor = $('div.terminal > div.inner > div.cursor');
    cursor.css('background', 'black');
    terminal = $('div.terminal');
    terminal_text = $('div.terminal > div.inner > div#text');
    text_entry = $('div.terminal > div.inner > label > input#text_entry');

    cursor.toggle = function(){
        if ($(this).css('background-color') == 'rgb(0, 0, 0)'){
            $(this).css('background-color', 'rgb(255, 255, 255)');
        }   else {
            $(this).css('background-color', 'rgb(0, 0, 0)');
        }
    }

    cursor_blink_interval = setInterval("cursor.toggle()", 500);

    do_prompt();
});

function get_character_width(){
    return 0;
    var len = current_command.length;
    var px = document.getElementById('text').clientWidth;//terminal_text[0].clientWidth;

    if (len == 0)   return 0;
    return px / (1 + len);
}

function do_prompt(){
    current_command = "";
    contents.push(prompt);
    while (contents.length > 10){
        contents.shift();
    }
    display_terminal();
}

function display_terminal(){
//    cursor.css('left', "" + (-1 * get_character_width()));
    terminal_text.html(contents.join("<br />") + current_command);
}

function process_command() {
    contents[contents.length - 1] += current_command;
    var line = current_command.split(" ");
    var command = line[0];
    var args = line.slice(1);

    if (command == 'help') {
        contents.push('ls - list files and directories');
        contents.push('cd - change directories');
        contents.push('less - view a text file');
        contents.push('xpdf - view a pdf file');
        contents.push('exit - exit the terminal interface');
    } else if (command == 'ls') {
        ls();
    } else if (command == 'cd') {
        cd(args);
    }
}


/*
 * Build a fake filesystem that we can navigate through in javascript 
 * */
root_node = null;
root = null;
currentnode = root_node;

/**
 * Enum to define the different types of nodes: file or directory
 * */
nodetypes = {
    FILE: { value: 0, name: "FILE", code: 'F' },
    DIR: { value: 1, name: "DIR", code: 'D' },
    LINX: { value: 2, name: "LINK", code: 'L' }
};

/**
 * Enum to define the different types of files.
 * */
filetypes = {
    TEXT: { value: 0, name: "TEXT", code: 'T' },
    PDF: { value: 1, name: "PDF", code: 'P' }
};

/**
 * Maps filetypes to "programs" that can open them.
 * */
//opencommands = {
//    filetypes.TEXT: "vi",
//    filetypes.PDF: "xpdf"
//};

filenode = function(name, nodetype, file) {

    // string
    this.name = name;
    // nodetype
    this.nodetype = nodetype;
    // pointer to the file
    this.file = file;
};

file = function(data, filetype) {

    // filetype, if a file
    this.filetype = filetype;

    /*
     * This should be dependent on the type of file this node is.
     *  text: the text of the file.
     *  pdf: a link to the pdf document.
     *  dir: a list of files in this directory.
     *  link (dir): the url of the page.
     * */
    this.data = data;
};


function cd(args) {
    var name = args[0];
    var files = currentnode.file.data;
    for (var i = 0; i < files.length; i++) {
        if (files[i].name == name) {
            currentnode = files[i];
        }
    }
}

function ls() {
    var files = currentnode.file.data;
    var ret = [];
    for (var i = 0; i < files.length; i++) {
        contents.push(files[i].name);
    }
}


$(document).ready(function(){

    /*
     *  /
     *      /projects
     *          koofers.txt
     *          pinproject.txt
     *      /links
     *      /about.txt
     *      /resume.pdf
     *      /README.txt
     * */
    var readme_file = new file(
'This is a simple terminal interface to navigate through <br />' +
'Kyle Racette\'s homepage.  Please feel free to provide feedback, <br />' +
'criticism, or file bugs with <a href="mailto:kracette@gmail.com">kracette@gmail.com</a>.  The source code<br />' +
'is downloadable <a>here</a> as well and is licensed under the GPLv3 <br />',
        filetypes.TEXT);
    var readme_node = new filenode("README.txt", nodetypes.FILE, readme_file);

    var resume_file = new file('/resume.pdf', filetypes.PDF);
    var resume_node = new filenode("resume.pdf", nodetypes.FILE, resume_file);

    var about_file = new file(
'This is about.txt',
        filetypes.TEXT);
    var about_node = new filenode("about.txt", nodetypes.FILE, about_file);

    root = new file();
    root_node = new filenode("/", nodetypes.DIR, root);

    var projects_file = new file();
    var projects_node = new filenode("projects", nodetypes.DIR, projects_file);

    var links_file = new file();
    var links_node = new filenode("links", nodetypes.DIR, links_file);

    root.data = [
        new filenode(".", nodetypes.DIR, root),
        new filenode("..", nodetypes.DIR, root),
        projects_node,
        links_node,
        readme_node,
        resume_node,
        about_node
    ];

    projects_file.data = [
        new filenode(".", nodetypes.DIR, projects_file),
        new filenode("..", nodetypes.DIR, root)
    ];

    links_file.data = [
        new filenode(".", nodetypes.DIR, links_file),
        new filenode("..", nodetypes.DIR, root)
    ];

    currentnode = root_node;
});

$(document).keydown(function(e){
    var code = e.which;

    switch (code){
    case 16: // shift
        shift = true;
        break;
    }
    if (code >= 65 && code <= 90){
        shift = true;
    }
});
$(document).keyup(function(e){
    var code = e.which;

    switch (code){
    case 16: // shift
        shift = false;
        break;
    }
    if (code >= 65 && code <= 90){
        shift = true;
    }
});
$(document).keypress(function(e){
    var code = e.which;
    var update = false;

    switch (code){
    case 13: // enter
        process_command();
        do_prompt();
        update = true;
        break;
    case 8: // backspace
        if (current_command != ""){
            current_command = current_command.substring(0, current_command.length - 1);
            update = true;
        }
        break;
    case 32: // space
        current_command += " ";
        update = true;
        break;
    case 46: // .
        current_command += ".";
        update = true;
        break;
    }
    if (code >= 97 && code <= 122){
        var character = String.fromCharCode(code);// - 32 + (shift ? 0 : 32));
        current_command += character;
        update = true;
    }

    if (update){
        display_terminal();
    }
});


