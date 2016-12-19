$.ajaxSetup({
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

$('.site-menu a.animsition-link').click(function(e){
	e.preventDefault();
	//console.log($(this).attr('href'));
	var str = document.location.href;
	if(str!= $(this).attr('href')){
		ajaxLoad($(this).attr('href'));
	}
});



function ajaxLoad(filename, content) {
	NProgress.start();
	content = typeof content !== 'undefined' ? content : 'content';
	
	//$('.loading').show();
	$.post({
		type: "GET",
		url: filename,
		async: true,
		contentType: false
	})
	.done(function(data){
		$("#" + content).html(data);
		$('.loading').hide();
		window.history.pushState(data, filename, filename);
		NProgress.done();
	})
}