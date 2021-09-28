$(document).ready(function() {
	$('#responsive-datatable').DataTable();
});

// $('#responsive-datatable').dataTable( {
//     "paging": true,
// } );

// $(document).ready(function() {
//     $('#responsive-datatable').DataTable( {
//         "order": [[ 3, "desc" ]]
//     } );
// } );

checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}

function permissionsBlog(tables,status){
	//alert(tables);
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
		alert("Please select one or more!");
		return false;
	}
	else{
			var hrefdata ="permissionsBlog?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}

function permissions(tables,status){
	//alert(tables);
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
		alert("Please select one or more!");
		return false;
	}
	else{
			var hrefdata ="permissions?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}



function sellerApproval(tables,status){

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
			var hrefdata ="sellerapproval?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}

function disapprovalSellerAccount(tables,status){

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
		alert("Please select one or more!");
		return false;
	}
	else{
		var hrefdata ="disapprovalSellerAccount?approve_val="+data+"&&tablename="+tables+"&&status="+status;
		window.location.href=hrefdata;
	}
}
function disapprovalAccount(tables,status){

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
		alert("Please select one or more!");
		return false;
	}
	else{
		var hrefdata ="disapprovalAccount?approve_val="+data+"&&tablename="+tables+"&&status="+status;
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
		alert("Please select one or more!");
		return false;
	}
	else{
			var hrefdata ="permissions?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}

function adminPermissions(e, t) {
    for (var a = document.getElementsByName("summe_code[]"), l = 0, o = new Array, s = 0; s < a.length; s++) a[s].checked && (o[l] = a[s].value, l++);
    if ("" == o) return alert("Please check one or more!"), !1;
    var n = "adminPermissions?approve_val=" + o + "&&tablename=" + e + "&&status=" + t;
    window.location.href = n
}

function changestatus(tables){
	var status=document.getElementById("changemtype").value;
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
		alert("Please select one or more!");
		return false;
	}
	else{
			var hrefdata ="changestatus?approve_val="+data+"&&tablename="+tables+"&&status="+status;
			window.location.href=hrefdata;
	}
}



function deletedata(patch,tables)
{
		var summeCode=document.getElementsByName("summe_code[]");
		var j=0;
		var data= new Array();
		var furl = patch;
		var imagedel = false;
		for(var i=0; i < summeCode.length; i++){
			if(summeCode[i].checked)
			{
				data[j]=summeCode[i].value;
				j++;
			}
		}
		if(data=="")
		{
			swal({
			  title: "Unchecked credential!",
			  text: "Please check one or more!",
			  icon: "warning",
			});
			return false;
		}
		else{

			swal({
			  title: 'Are you sure?',
			  //type: 'warning',
			  imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}",
			  confirmButtonText: 'Ok, Delete It',
			  showCloseButton: true,
  			  showCancelButton: true,
			  text: "Do you want to Delete Selected Data !",
			 // input: 'checkbox',
			  //inputPlaceholder: ' Delete all Images for Selected Submission'
			}).then((result) => {
			  if (result.value) {
				//swal({type: 'success', text: 'You have a bike!'});
				imagedel = true;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':data,'deletetype':'multiple','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected data are deleted",
						  type: "success",
						});
						 var len = html.length;
						for(i in html){
							 $("#tablerow" + html[i]).fadeOut('slow');
						}
					 }
				});

			  } else if (result.value === 0) {
				//swal({type: 'error', text: "You don't have a bike :("});
				imagedel = false;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':data,'deletetype':'multiple','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected Submission are deleted",
						  type: "success",
						});
						 var len = html.length;
						for(i in html){
							 $("#tablerow" + html[i]).fadeOut('slow');
						}
					 }
				});

			  } else {
				console.log('modal was dismissed by ${result.dismiss}')
			  }

		});
	}
}

function deleteSingle(id,patch,tables){
		var furl = patch;
		//alert(patch);
		var imagedel = false;
			swal({
			  imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}",
			  title: 'Are you sure?',
			  confirmButtonText: 'Ok, Delete It',
			  //type: 'warning',
			  showCloseButton: true,
  			  showCancelButton: true,
			  text: "Do you want to Delete Selected data !",
			  //input: 'checkbox',
			  //inputPlaceholder: ' Delete all Images for Selected data'
			}).then((result) => {
				
			  if (result.value) {
				//swal({type: 'success', text: 'You have a bike!'});
				imagedel = true;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':id,'deletetype':'single','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						
						swal({
						  title: "Successfully Deleted!",
						  text: "All selected data are deleted",
						  type: "success",
						});
						$("#tablerow" + id).fadeOut('slow');
					 }
				});

			  } else if (result.value === 0) {
				//swal({type: 'error', text: "You don't have a bike :("});
				imagedel = false;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':id,'deletetype':'single','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Deleted!",
						  text: "All selected Submission are deleted",
						  type: "success",
						});
						$("#tablerow" + id).fadeOut('slow');
					 }
				});

			  } else {
				console.log('modal was dismissed by ${result.dismiss}')
			  }

		});
	}
