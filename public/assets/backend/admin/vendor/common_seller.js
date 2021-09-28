// $(document).ready(function() {  
//
//     $('.regular').slick({
// 		  dots: false,
// 		  infinite: true,
// 		  speed: 1500,
// 		  centerMode: true,
// 		  accessibility: true,
//       	  autoplaySpeed: 6000,
//       	  centerPadding: '60px',
// 		  prevArrow: $('.prev'),
// 		  nextArrow: $('.next'),
// 		  slidesToShow: 7,
// 		  slidesToScroll: 1,
// 		  responsive: [
// 			{
// 			  breakpoint: 1024,
// 			  settings: {
// 				slidesToShow: 6,
// 				slidesToScroll: 1,
// 				infinite: true,
// 				dots: false
// 			  }
// 			},
// 			{
// 			  breakpoint: 600,
// 			  settings: {
// 				slidesToShow: 2,
// 				slidesToScroll: 2
// 			  }
// 			},
// 			{
// 			  breakpoint: 480,
// 			  settings: {
// 				slidesToShow: 1,
// 				slidesToScroll: 1
// 			  }
// 			},
// 			{
// 			  breakpoint: 320,
// 			  settings: {
// 				slidesToShow: 1,
// 				slidesToScroll: 1
// 			  }
// 			},
// 			{
// 			  breakpoint: 280,
// 			  settings: {
// 				slidesToShow: 1,
// 				slidesToScroll: 1
// 			  }
// 			}
// 		  ]
// 		});
// });


$(document).ready(function() {

	$('ul.tabsProduct li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabsProduct li').removeClass('active');
		$('.tab-content').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	});



	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('active');
		$('.tab-content1').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	});


	$('ul.tabs2 li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs2 li').removeClass('active');
		$('.tab-content2').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	});

});
// JavaScript Document
$(document).ready(function() {
$('#responsive-datatable').DataTable();
});

checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}


function permissions(tables,status){

	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();

	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;

		}

	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="permissions?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}






function permissionsProducts(tables,status){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();

	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;

		}

	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="permissions?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}



function changestatus(tables){
		//alert(tables);
	var status=document.getElementsById("changemtype").value;
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var data= new Array();

	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			data[j]=summeCode[i].value;
			j++;

		}

	}
	if(data=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			var hrefdata ="changestatus?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}

function deleteMultipleData()
{
		var summeCode=document.getElementsByName("summe_code[]");
		var j=0;
		var productids= new Array();
		var imagedel = false;
		for(var i=0; i < summeCode.length; i++){
			if(summeCode[i].checked)
			{
				productids[j]=summeCode[i].value;
				j++;
			}
		}
		if(productids=="")
		{
			swal({
			  title: "Product Unchecked credential!",
			  text: "Please check one or more!",
			  icon: "warning",
			});
			return false;
		}
		else{

			var surl = 'prodcutsdelete';
			swal({
				  title: 'Are you sure?',
				  text: "Do you want to delete selected items ? Make sure after deleting you completely lost all related data of selected items form aleshamart system.",
				  confirmButtonText: 'Ok, Delete It',
				  type: 'warning',
				  showCloseButton: true,
				  showCancelButton: true,
				}).then((result) => {
				  if (result.value) {
						$.ajax({
							type: "GET",
							url: surl,
							data: {'id':productids,'deletetype':'multiple'},
							cache: false,
							beforeSend: function(){
								$('#LoadingImageE').show();
							},
							complete: function(){
								$('#LoadingImageE').hide();
							},
							success: function(html) {
								$('#LoadingImageE').hide();
								//alert(html);
								 	var len = html.length;
									//alert(len);
									for(i in html){
										//	alert(html[i]);
										 $("#tablerow" + html[i]).fadeOut('slow');
									}
								swal({
								  title: "Successfully Delete!",
								  text: "All selected data are deleted",
								  type: "success",
								});

							},
							error: function (xhr, status) {
								$('#LoadingImageE').hide();
							}
						});
				  }
				  else {
					//swal("Safe, Your Prodcut is still here!");
					swal({
					  title: "Congratulation!",
					  text: "Your Prodcut is still here",
					  type: "success",
					});
				  }
			});
		}
}


function deleteSingleProducts(id){

		var surl = 'prodcutsdelete';
		swal({
			  //imageUrl: "{{ asset('assets/images/fabicon/android-icon-96x96.png') }}",
			  title: 'Are you sure?',
			  text: "Do you want to delete this item ? Make sure after deleting you completely lost all related data of this item form aleshamart system.",
			  confirmButtonText: 'Ok, Delete It',
			  type: 'warning',
			  showCloseButton: true,
  			  showCancelButton: true,
			}).then((result) => {
			  if (result.value) {
					$.ajax({
						type: "GET",
						url: surl,
						data: {'id':id,'deletetype':'single'},
						cache: false,
						beforeSend: function(){
							$('#LoadingImageE').show();
						},
						complete: function(){
							$('#LoadingImageE').hide();
						},
						success: function(response) {
							$('#LoadingImageE').hide();
							swal({
							  title: "Successfully Delete!",
							  text: "All selected data are deleted",
							  type: "success",
							});
							$("#tablerow" + id).fadeOut('slow');
						},
						error: function (xhr, status) {
							$('#LoadingImageE').hide();
						}
					});
			  }
			  else {
			  	//swal("Safe, Your Prodcut is still here!");
				swal({
				  title: "Congratulation!",
				  text: "Your Prodcut is still here",
				  type: "success",
				});
			  }
		});

	}
	
	
	
function deleteSingleVariation(id){

		var surl = 'variationdelete';
		swal({
			  //imageUrl: "{{ asset('assets/images/fabicon/android-icon-96x96.png') }}",
			  title: 'Are you sure?',
			  text: "Do you want to delete this item ? Make sure after deleting you completely lost all related data of this item form aleshamart system.",
			  confirmButtonText: 'Ok, Delete It',
			  type: 'warning',
			  showCloseButton: true,
  			  showCancelButton: true,
			}).then((result) => {
			  if (result.value) {
					$.ajax({
						type: "GET",
						url: surl,
						data: {'id':id,'deletetype':'single'},
						cache: false,
						beforeSend: function(){
							$('#LoadingImageE').show();
						},
						complete: function(){
							$('#LoadingImageE').hide();
						},
						success: function(response) {
							$('#LoadingImageE').hide();
							swal({
							  title: "Successfully Delete!",
							  text: "All selected data are deleted",
							  type: "success",
							});
							$("#tablerow" + id).fadeOut('slow');
						},
						error: function (xhr, status) {
							$('#LoadingImageE').hide();
						}
					});
			  }
			  else {
			  	//swal("Safe, Your Prodcut is still here!");
				swal({
				  title: "Congratulation!",
				  text: "Your Prodcut is still here",
				  type: "success",
				});
			  }
		});

	}




function deleteImages(id){

		var surl = 'editimagedelete';
		swal({
			  //imageUrl: "{{ asset('assets/images/fabicon/android-icon-96x96.png') }}",
			  title: 'Are you sure?',
			  text: "Do you want to delete this item ? Make sure after deleting you completely lost all related data of this item form aleshamart system.",
			  confirmButtonText: 'Ok, Delete It',
			  type: 'warning',
			  showCloseButton: true,
  			  showCancelButton: true,
			}).then((result) => {
			  if (result.value) {
					$.ajax({
						type: "GET",
						url: surl,
						data: {'id':id,'deletetype':'single'},
						cache: false,
						beforeSend: function(){
							$('#LoadingImageE').show();
						},
						complete: function(){
							$('#LoadingImageE').hide();
						},
						success: function(response) {
							$('#LoadingImageE').hide();
							swal({
							  title: "Successfully Delete!",
							  text: "All selected data are deleted",
							  type: "success",
							});
							$("#tablerow" + id).fadeOut('slow');
						},
						error: function (xhr, status) {
							$('#LoadingImageE').hide();
						}
					});
			  }
			  else {
			  	//swal("Safe, Your Prodcut is still here!");
				swal({
				  title: "Congratulation!",
				  text: "Your Prodcut is still here",
				  type: "success",
				});
			  }
		});

	}

