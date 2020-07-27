const seeMore = document.querySelectorAll('.toggle-photos');



function togglePhotos(x, y) {
    var photos = document.querySelector('.' + y);
    photos.classList.toggle('absolute');
    
    if (x.textContent == 'See More') {
        x.textContent = 'See Less';
    } else if (x.textContent == 'See Less') {
        x.textContent = 'See More';
    }

}

var x;

for (const see of seeMore) {
    see.addEventListener('click', function(){
        var x = see;        
        var y = see.getAttribute('id');    
        togglePhotos(x, y)
    });
};


