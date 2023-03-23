/*
function redirectTo(url) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onload = function () {
        if (this.status == 200) {
            // Update URL without page reload
            history.pushState(null, null, url);
            // Update content using Ajax
            document.body.innerHTML = this.responseText;
        }
    };
    xhr.send();
}*/
