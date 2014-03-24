$(document).ready(function() {
    $('.form-group .btn').bind('click', function() {
//        var v = CKEDITOR.instances['article-text'].getData();
//        console.log(v);
//        $('textarea#article-text').text(v);
        $('textarea#article-text').text(CKEDITOR.instances['article-text'].getData());
    })
});