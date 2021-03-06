$(document).ready(function(){
	var containerEl = document.querySelector('.mixitup-container');
	if(containerEl)
	{
		var config = {
			selectors:{
				target: '[data-ref="mixitup-target"]'
			},
			animation:{
				effects: 'fade scale stagger(50ms)' // Set a 'stagger' effect for the loading animation
			},
			load:{
				filter: 'none' // Ensure all targets start from hidden (i.e. display: none;)
			},
			animation:{
				duration: 350
			},
			controls:{
				scope: 'local'
			},
			callbacks: {
				onMixStart:function(state) {
				},
				onMixEnd:function() {
					if(BX.browser.IsIE9() && BX.browser.IsIE())
					{
						if($('.table-elements .item.slice-item').length)
						{
							setTimeout(function(){
								$('.item.slice-item:visible .title').sliceHeight();
								$('.table-elements .item.slice-item:visible').sliceHeight();
							}, 100);
						}
					}
				}
			}
		};
		var mixer = mixitup(containerEl, config);

		// Add a class to the container to remove 'visibility: hidden;' from targets. This
	    // prevents any flickr of content before the page's JavaScript has loaded.

	    if(BX.browser.IsIE9() && BX.browser.IsIE())
		{
			containerEl.className += ' mixitup-ready';
		}
		else
		{
	    	containerEl.classList.add('mixitup-ready');
	    }

	    // Show all targets in the container

	    mixer.show()
		.then(function(){
			// Remove the stagger effect for any subsequent operations
			mixer.configure({
				animation: {
					effects: 'fade scale'
				}
			});
		});
	}
	else
	{
		if(BX.browser.IsIE9() && BX.browser.IsIE())
		{
			$('.item-views.news-project .item').sliceHeight();
		}
	}
})