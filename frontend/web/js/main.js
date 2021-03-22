/* Preload*/
$(window).on('load', function () { // makes sure the whole site is loaded
	$('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({
		'overflow': 'visible'
	});
    $('#ajax-loader').hide();
})

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

	setTimeout(function(){
		$('.alert-success button').click();
	}, 4000)
}


function addImporte(cliente=null, view){
	swal("¿Qué tipo de importe desea registrar?",{
	  buttons: {
	  	'ingresos': {
	  		text: 'Ingresos',
	  		value: 1,
	  		color:'red',
	  	},

	  	'gastos': {
	  		text: 'Gastos',
	  		value: 2,
	  		dangerMode: true
	  	},
	  },
	}).then((value) => {
		if (value) {
			if (cliente) {
				window.location = '/frontend/web/transacciones/registrar?cliente='+cliente+'&tipo='+value+'&view='+view;
			}
		}
	});
}

$(".cuenta").bind('keyup', function(){
	suma = 0;
	$('.cuenta').each(function(){
		n = $(this).val();
		console.log(n);
		if (! n > 0) {
			n = 0;
		}
		console.log(n);
        suma += parseFloat(n);
        console.log(suma);
        // if (Number.isNaN(suma)) {
        // 	suma = 0;
        // }
		$("#total").val(suma);
	});
})

$( ".submit" ).click(function() {
  $( "#form" ).submit();
});


function addInvoiceField(n){

	n++;
	my_function = "javascript:addInvoiceField("+n+")";
    $('.addInvoice').append($('.invoice').html());
    $(".addInvoice .descripcion input:last-child").attr('name', 'factura_descripcion['+n+']');
    $(".addInvoice .precio input:last-child").attr('name', 'factura_precio['+n+']');
    $(".addInvoice .btn_delete a:last-child").removeClass('disabled');
    $("#addInvoiceBtn").attr('href', my_function);
}