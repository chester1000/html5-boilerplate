/* Author: zjednoczeni

*/

// optional file-uploader init
function createUploader(){
    var uploader = new qq.FileUploader({
        element: document.getElementById('file-uploader'), // remember to crate node with #file-uploader
        action: 'jx/file_uploader.php',
        debug: true // change to false once everything is set
    });
}

$(function(){
    console.log('init');
    $.post('jx/do.php',{action: "log", msg: "penis", type: "admin"}, function(data) {
        console.log(data.cause);
    },'json');
});




