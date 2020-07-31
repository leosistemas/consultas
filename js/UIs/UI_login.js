
$ (document).ready(function (){

  $('#open').click(function(){
		$('#popup').fadeIn('slow');
		$('.popup-overlay').fadeIn('slow');
		$('.popup-overlay').height($(window).height());
		return false;
	});

	$('#close').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});

		$('#column-right').animate({
			'width':'100%',
			'height':'335',

		},1000);
		$('#central').animate({
			'width':'100%',
			'height':'340'
		},1000);

		$('#delegaciones').animate({
			'width':'100%',

		},2000);

		$('#user').animate({
			'width':'100%',

		},2000);
		$('#pass').animate({
			'width':'100%',

		},2000);
		$('#login').animate({
			'width':'100%',

		},2000);
		$('#login').click(function () {
		$('#pass').hide();
		$('#pass').attr('type', 'text');
		var us=$('#user').val();
		var p=$('#pass').val();
		var i=$('#int').val();
		document.getElementById("formvalid").submit()


		})


});
