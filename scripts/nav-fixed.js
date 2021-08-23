
var html;
$.get("../views/nav.modal.view.php", function(html_get){
    html = html_get;
    $("#nav-fixed").prepend(html);
});





var checkExist = setInterval(function() {
if ($('#homepage-btn-nav').length) {
    document.getElementById("homepage-btn-nav").onclick = function(){
                location.href = '/views/homepage.view.php';
            }

            document.getElementById("music-btn-nav").onclick = function(){
                location.href = '/views/music.view.php';
            }

            document.getElementById("gallery-btn-nav").onclick = function(){
                location.href = '/views/gallery.view.php';
            }

            document.getElementById("blog-btn-nav").onclick = function(){
                location.href = '/views/blog.view.php';
            }

            document.getElementById("about-btn-nav").onclick = function(){
                location.href = '/views/about.view.php';
            }
    clearInterval(checkExist);
}
}, 100);

      