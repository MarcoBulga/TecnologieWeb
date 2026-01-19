const tag = document.getElementById("tag-button");
const tagList = document.querySelector("div.filters");

tag.addEventListener('click', function(){
    if(tagList.classList.contains("show")) {
        tagList.classList.remove("show");
    } else {
        tagList.classList.add("show");
    }
} );
