/**
 * jTinder initialization
 */
$("#tinderslide").jTinder({
	// dislike callback
    onDislike: function (item) {
	    // set the status text
        $('#status').html('Dislike image ' + (item.index()+1));
    },
	// like callback
    onLike: function (item) {
	    // set the status text
        $('#status').html('Like image ' + (item.index()+1));
    },
	animationRevertSpeed: 200,
	animationSpeed: 400,
	threshold: 1,
	likeSelector: '.like',
	dislikeSelector: '.dislike'
});

/**
 * Set button action to trigger jTinder like & dislike.
 */
$('.actions .like, .actions .dislike').click(function(e){
	e.preventDefault();
	$("#tinderslide").jTinder($(this).attr('class'));
});






const mediaIcons = document.querySelectorAll('.media-icon');

function switchMedia(y) {
    
    const mediaType = document.querySelectorAll('.media-type')
    
    for (const type of mediaType) {
            type.classList.remove('show')
    };
    
    var show = document.querySelector('#' + `${y}`)
    
    show.classList.add('show')
    
};


for (const icon of mediaIcons) {
    
    icon.addEventListener('click', function() {
        var y = icon.getAttribute('data'); 
        switchMedia(y)
    });
};
