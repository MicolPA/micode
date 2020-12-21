console.log('hola');

jQuery('input[type=file]').change(function(){
 var filename = jQuery(this).val().split('\\').pop();
 var idname = jQuery(this).attr('id');
 console.log(jQuery(this));
 console.log(filename);
 console.log(idname);
 jQuery('span.'+idname).next().find('span').html(filename);
});

function displayNotification(title, message, icon, url='#'){
	var placementFrom = "bottom";
	var placementAlign = "right";
	var state = "success";
	var style = "withicon";
	var content = {};

	content.message = message
	content.title = title;
 	content.icon = icon;
	content.url = url;
	content.target = '_blank';

	$.notify(content,{
		type: state,
		placement: {
			from: placementFrom,
			align: placementAlign
		},
		time: 1000,
		delay: 0,
	});
}