<style>
.form-group {margin-left:20px;}
label, input { display:block; }
input.text { margin-bottom:12px; width:95%;  }
input.checkbox { margin-bottom:12px; width:20px; height:20px;}
.row{margin-right:0px;}
#table_status tr td{color:#3071a9;}
#table_status tr th{color:#337ab7;font-weight: bold;}
#table_status tbody tr td{padding:3px; text-align:center;}
#table_status thead tr th {text-align:center;}

#table_status_filter label{float: right;}
#table_status tbody input{border-radius: 4px; border-color: }
#table_status .editable, #table_status .edit{cursor: pointer; }
 .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
 .toggle.ios .toggle-handle { border-radius: 20px; }
.panel-heading {font-weight:bold;}
 #table_status tbody td .function_buttons {
  line-height: 20px;
  margin: 0 auto 0 auto;
}

#table_status tbody td .function_buttons div
{
  float: left;
  width:80px;
  padding: 0 3px 0 0;
	text-align:right;
}
#table_status .checkbox-container
{
	text-align:center;
}

#table_status tbody td.functions .function_buttons a {
  width: 30px;
  height: 30px;
  display: inline-block;
  background-color: #1c84c6;
  font-family: 'FontAwesome', Arial, Helvetica, sans-serif;
  font-weight: normal;
  line-height: 29px;
  text-align: center;
  color: #fff;
  -webkit-border-radius: 6px;
  -moz-border-radius:    6px;
  border-radius:         6px;
}

/* Lightbox ------------------------------------------------------------------------------------- */
.lightbox_bg {
  display: none;
  width: 100%;
  height: 900px;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100;
  background-color: #333;
  background-color: rgba(0, 0, 0, 0.85);
  cursor: pointer;
}

.lightbox_container {
  display: none;
  width: 450px;
  height: auto;
  position: fixed;
  top: 23%;
  left: 40%;
  z-index: 200;
  background-color: #fff;
  color: #666;
  overflow-y: auto;
  overflow-x: auto;
  padding: 50px 0 0 0;
   -webkit-box-sizing: border-box;
  -moz-box-sizing:     border-box;
  box-sizing:          border-box;
  -webkit-border-radius: 6px;
  -moz-border-radius:    6px;
  border-radius:         6px;
}

.lightbox_close {
  width: 35px;
  height: 35px;
  position: absolute;
  top: 45px;
  right: 45px;
  font-family: 'FontAwesome', Arial, Helvetica, sans-serif;
  font-weight: normal;
  font-size: 20px;
  line-height: 35px;
  text-align: center;
  color: #1c84c6;
  cursor: pointer;
  border: 2px solid #1c84c6;
  -webkit-border-radius: 35px;
  -moz-border-radius:    35px;
  border-radius:         35px;
}
.lightbox_close:before {
  content: '\f00d';
}
.lightbox_close:hover {
  color: #333;
  border-color: #333;
}

.lightbox_content {
  width: 400px;
  padding: 0 50px 0 50px;
}
.lightbox_content h2 {
  font-weight: 700;
  font-size: 2rem;
  line-height: 2rem;
  color: #1c84c6;
  margin: 0 0 25px 0;
}

.lightbox_content .input_container {
  width: 350px;
  margin: 0 0 10px 0;
}
.lightbox_content .input_container:after {
  clear: both;
  height: 0;
  display: block;
  font-size: 0;
  line-height: 0;
  content: ' ';
}

.lightbox_content .input_container label {
  width: 150px;
  float: left;
  font-size: 1.4rem;
  color:#1c84c6;
  line-height: 32px;
}
.lightbox_content .input_container label span.required {
  font-weight: bold;
  color: red;
}

.lightbox_content .input_container .field_container {
  width: 200px;
  float: right;
  position: relative;
}
.lightbox_content .input_container .field_container label.error {
  width: 200px;
  display: block;
  background-color: #fff1e6;
  line-height: 1.4rem;
  color: #333;
  padding: 5px 0 6px 10px;
  border: 1px solid #f70;
  -webkit-box-sizing: border-box;
  -moz-box-sizing:    border-box;
  box-sizing:         border-box;
  -webkit-border-radius: 6px;
  -moz-border-radius:    6px;
  border-radius:         6px;
  margin: 0 0 5px 0;
}
.lightbox_content .input_container .field_container label.error.valid {
  display: none !important;
}
.lightbox_content .input_container .field_container input {
  width: 180px;
  height: 32px;
  background-color: #f9f9f9;
  line-height: 30px;
  color: #666;
  padding: 0 0 0 10px;
  border: 1px solid #ccc;
  -webkit-box-sizing: border-box;
  -moz-box-sizing:    border-box;
  box-sizing:         border-box;
  -webkit-border-radius: 6px;
  -moz-border-radius:    6px;
  border-radius:         6px;
}
.lightbox_content .input_container .field_container input:focus {
  background-color: #ffd;
  color: #000;
}

.lightbox_content .input_container .field_container.error:after,
.lightbox_content .input_container .field_container.valid:after {
  width: 32px;
  height: 32px;
  position: absolute;
  bottom: 0;
  right: -42px;
  font-family: 'FontAwesome', Arial, Helvetica, sans-serif;
  font-weight: normal;
  font-size: 20px;
  line-height: 32px;
  text-align: center;
}
.lightbox_content .input_container .field_container.error:after {
  content: '\f00d';
  color: #c00;
}
.lightbox_content .input_container .field_container.valid:after {
  content: '\f00c';
  color: #090;
}

.lightbox_content .button_container {
  width: 600px;
  height: 35px;
  text-align: right;
  padding: 15px 0 50px 0;
}
.lightbox_content .button_container button {
  height: 35px;
  display: inline-block;
  background-color: #999;
  font-weight: 700;
  text-transform: uppercase;
  color: #fff;
  padding: 0 15px 0 15px;
  -webkit-border-radius: 6px;
  -moz-border-radius:    6px;
  border-radius:         6px;
}
.lightbox_content .button_container button:hover {
  background-color: #333;
  color: #fff;
}

/* Message / noscript --------------------------------------------------------------------------- */
#message_container,
#noscript_container {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #333;
  text-align: center;
  color: #fff;
}
#message_container {
  display: none;
}
#message,
#noscript {
  width: 980px;
  line-height: 20px;
  padding: 10px 5px 10px 6px;
  margin: 0 auto 0 auto;
}
#message  p,
#noscript p {
  display: inline-block;
  position: relative;
  padding: 0 0 0 28px;
}
#message  p:before,
#noscript p:before {
  width: 20px;
  height: 20px;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #f70;
  font-family: 'FontAwesome', Arial, Helvetica, sans-serif;
  font-weight: normal;
  font-size: 12px;
  line-height: 20px;
  text-align: center;
  color: #fff;
  -webkit-border-radius: 20px;
  -moz-border-radius:    20px;
  border-radius:         20px;
}
#message.success  p:before,
#noscript.success p:before {
  content: '\f00c';
}
#message.error  p:before,
#noscript.error p:before {
  content: '\f00d';
}

/* Loading message ------------------------------------------------------------------------------ */
#loading_container {
  width: 100%;
  height: 100%;
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #333;
  background-color: rgba(0, 0, 0, 0.85);
  text-align: center;
}
#loading_container2 {
  width: 100%;
  height: 100%;
  display: table;
}
#loading_container3 {
  display: table-cell;
  vertical-align: middle;
}
#loading_container4 {
  width: 350px;
  height: 250px;
  position: relative;
  background-color: #fff;
  font-size: 1.4rem;
  line-height: 1.4rem;
  color: #666;
  padding: 165px 0 0 0;
   -webkit-box-sizing: border-box;
  -moz-box-sizing:     border-box;
  box-sizing:          border-box;
  -webkit-border-radius: 6px;
  -moz-border-radius:    6px;
  border-radius:         6px;
  margin: 0 auto 0 auto;
}
#loading_container4:before {
  width: 100%;
  position: absolute;
  top: 80px;
  left: 0;
  font-family: 'FontAwesome', Arial, Helvetica, sans-serif;
  font-weight: normal;
  font-size: 4rem;
  line-height: 4rem;
  text-align: center;
  color: #f70;
  content: '\f013';
  -webkit-animation: spin 2s infinite linear;
  animation:         spin 2s infinite linear;
}

@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform:         rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform:         rotate(359deg);
  }
}

@keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform:         rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform:         rotate(359deg);
  }
}

.navbar-right .user-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-left: 10px;
    margin-top: -2px;
	vertical-align:middle;
}
.hide_column
{
	display:none;
}
</style>

<div id="errordiv">
</div>
<!-- start page -->
<div id="page" >
	<!-- start content -->
	<div id="container">

		<div class="panel panel-default">
            <div class="panel-heading">State Management
                <!--a href="?b_m=bond&file=index" class="<?php echo $first_selected;?>">Logging</a> | <a href="?b_m=bond&file=second" class="<?php echo $second_selected;?>">State Management</a!-->
            </div>
            <!-- /.panel-heading -->
			
	        <div class="panel-body">
	            <div class="table-responsive">
	                <table class="table" id='table_status'>
	                    <thead>
	                        <tr>
	                            <th style=''>#</th>
	                            <th width='12%'>location</th>
	                            <th>devId</th>
	                            <th>status</th>
	                            <th width='23%'>Action</th>
	                            <th width='8%'>serverIP</th>
	                            <th width='8%'>localIP</th>
	                            <th>wdten</th>
								<th>ver</th>
								<th>logging</th>
	                            
	                        </tr>
	                    </thead>
	                    <tbody>
	                    </tbody>
	                </table>
	            </div>
	            <!-- /.table-responsive -->
	        </div>
        <!-- /.panel-body -->
        </div>

        <div class="lightbox_bg"></div>

			<div class="lightbox_container">
				<div class="lightbox_close"></div>
				 <div class="lightbox_content">
						
					<h2>Add AppUser</h2>
					<form class="form add" id="form_company" data-id="" novalidate >
					    <div class="input_container">
							<label for="Role">User: <span class="required">*</span></label>
							<div class="field_container">
						      <input type="text" class="text" name="username" id="username" value="" required>
							</div>
						</div>
					    <div class="input_container">
							<label for="First Name">Password: <span class="required">*</span></label>
							<div class="field_container">
						  		<input type="password" class="text" name="password" id="password" value="" required>
							</div>
						</div>
						<div class="input_container">
							<label for="headquarters"></label>
							<button class='btn btn-primary btn-info' id="add" >Reboot</button>
						</div>
					</form>
				</div>
			</div>

			<noscript id="noscript_container">
			  <div id="noscript" class="error">
				<p>JavaScript support is needed to use this page.</p>
			  </div>
			</noscript>

			<div id="message_container">
			  <div id="message" class="success">
				<p>This is a success message.</p>
			  </div>
			</div>

			<div id="loading_container">
          		<div id="loading_container2">
					<div id="loading_container3">
					    <div id="loading_container4">
							Loading, please wait...
					    </div>
					</div>
				 </div>
			</div>
			<div id='error_div'></div>
					
    </div>
<div>	
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar" style="margin-top:50px;">
	</div>
	
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>

<!-- end page -->
<script> 
		

    $(document).ready(function () 
    {
    	function show_message(message_text, message_type)
    	{
			$('#message').html('<p>' + message_text + '</p>').attr('class', message_type);
			$('#message_container').show();
			if (typeof timeout_message !== 'undefined'){
			  window.clearTimeout(timeout_message);
			}
			timeout_message = setTimeout(function(){
			  hide_message();
			}, 8000);
	  	}
		  // Hide message
		  function hide_message()
		  {
			$('#message').html('').attr('class', '');
			$('#message_container').hide();
		  }

		  // Show loading message
		  function show_loading_message()
		  {
			$('#loading_container').show();
		  }
		  // Hide loading message
		  function hide_loading_message()
		  {
			$('#loading_container').hide();
		  }
			// Show lightbox
		  function show_lightbox()
		  {
			$('.lightbox_bg').show();
			$('.lightbox_container').show();
		  }
		  // Hide lightbox
		  function hide_lightbox()
		  {
			$('.lightbox_bg').hide();
			$('.lightbox_container').hide();
		  }
		  // Lightbox background
		  $(document).on('click', '.lightbox_bg', function(){
			hide_lightbox();
		  });
		  // Lightbox close button
		  $(document).on('click', '.lightbox_close', function(){
			hide_lightbox();
		  });

		  	/*new DG.OnOffSwitch
			({
		        el: '.on-off-switch',
		        textOn: 'On',
		        textOff: 'Off',
		        listener:function(name, checked)
		        {
		            alert("Listener called for " + name + ", checked: " + checked);
		        }
			});*/
	        var table_companies =$('#table_status').DataTable
			({
				"columns": [
					{"data": "id",className:'hide_column'},
					{"data": "alias",className: 'editable'},
					{"data": "devId"},
					{"data": "status"},
					{"data": "action"},
				    {"data": "serverIP",className: 'edit'},
					{"data": "localIP"},
					{"data": "wdten",sortable:false},
					{"data": "firmver"},
					{"data": "logging"}	
				],
				"processing": true,
				"serverSide": true,
				"responsive": true,
        'lengthChange': false,
				"ajax":
				{
					url: './bond/process/sec.php',
					type: 'POST'/*,
					dataFilter: function(data)
					{
						$("#error_div").html(data);
						var json = jQuery.parseJSON( data );
						json.recordsTotal = json.total;
						json.recordsFiltered = json.total;
						json.data = json.list;
						return JSON.stringify( json ); // return JSON string
					}*/
				},
				"lengthMenu":[[-1],["All"]],
				"columnDefs": [
	                       { "visible": false, "targets": [1] }
	            ]
				
				
			});

		


		 $('#table_status').on( 'click', 'tbody td.editable', function (e) 
		 {
		 	
			e.preventDefault();
			var value = $(this).text();
			var id = $(this).prev().text();
			
			var html ='<h2>Edit Location</h2>';
				html +='<form class="form add" id="form_company" data-id="" novalidate >';
				html +='<div class="input_container"><label for="Location">Location: <span class="required">*</span></label>';
				html +='<div class="field_container"><input type="text" class="text" name="alias" id="alias" required></div></div>';
				
				html +='<div class="input_container"><label for="Location">devId:</label>';
				html +='<div class="field_container">'+$(this).next().text()+'</div></div>';
				html +='<div class="input_container"><label for="Location">serverIP:</label>';
				html +='<div class="field_container">'+$(this).next().next().next().next().text()+'</div></div>';
				html +='<div class="input_container"><label for="Location">localIP:</label>';
				html +='<div class="field_container">'+$(this).next().next().next().next().next().text()+'</div></div>';


				html +='</div><div class="input_container"><label for="headquarters"></label>';
				html +='<button class="btn btn-primary btn-info" id="add" >Edit Location</button></div></form>';
			$('.lightbox_content').html(html);	
			$('.lightbox_content h2').text('Edit Location');
			$('#form_company button #add').text('Edit Location');
			$('#form_company').attr('class', 'form edit');
			$('#form_company').attr('data-id', id);
			
			$('#form_company #alias').val(value);
			show_lightbox();	

	     });

     $('#table_status').on( 'click', 'tbody td.edit', function (e) 
     {
      var value = $(this).text();
      if($(this).find('input').length <1)
            $(this).html('<input type="text" class="form-control input-sm" style="width:120px" id="serverip" name="serverip" value="'+value+'">');
       });
    $(document).on('mouseout', '#serverip', function(e)
    {
      e.preventDefault();
      var localip = $(this).parent().next().text();
      $.ajax(
      { 
        url:'http://'+localip+'/setting?serverip='+$(this).val()+'&wdttime=60',
        type: 'GET',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data)
        {
          table_companies.ajax.reload();  
          
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           table_companies.ajax.reload();  
           alert(jqXHR.responseText);  
        }
      });
      
    });   
		$(document).on('submit', '#form_company.edit', function(e)
		{
			e.preventDefault();
			
			var form_data = '&alias='+$("#alias").val();
			// Validate form
			var request   = $.ajax
			({
				url:          './bond/process/sec.php?cmd=update&id=' + $('#form_company').attr('data-id'),
				cache:        false,
				data:         form_data,
				dataType:     'json',
				contentType:  'application/json; charset=utf-8',
				type:         'get'
			});
			request.done(function(output)
			{
				 hide_lightbox();
				 table_companies.ajax.reload(function()
				  {
					
				  }, true);
				
			});
			request.fail(function(jqXHR, textStatus)
			{
				$("#error_div").html(jqXHR.responseText);
				hide_loading_message();
				show_message('Edit request failed: ' + textStatus, 'error');
			}
			);
	    });		     
		
		$(document).on('click', '.function_reboot a', function(e)
		{

			e.preventDefault();
			// Get company information from database
			var localip      = $(this).data('name');
			
			e.preventDefault();
			var username = "<?php echo isset($_SESSION['username'])? $_SESSION['username']:""?>";
			var password = "<?php echo isset($_SESSION['password'])? $_SESSION['password']:""?>";
			var html ='<h2>User</h2>';
				html +='<form class="form add" id="form_company" data-id="" novalidate >';
				html +='<div class="input_container"><label for="Role">User: <span class="required">*</span></label>';
				html +='<div class="field_container"><input type="text" class="text" name="username" id="username" value="" required></div></div>';
				html +='<div class="input_container"><label for="First Name">Password: <span class="required">*</span></label>';
				html +='<div class="field_container"><input type="password" class="text" name="password" id="password" value="" required></div></div>';
				
				html +='<div class="input_container"><label for="Location">Location:</label>';
				html +='<div class="field_container">'+$(this).parent().parent().parent().prev().prev().prev().text()+'</div></div>';
				html +='<div class="input_container"><label for="Location">DevId:</label>';
				html +='<div class="field_container">'+$(this).data('id')+'</div></div>';
				html +='<div class="input_container"><label for="Location">serverIP:</label>';
				html +='<div class="field_container">'+localip+'</div></div>';


				html +='</div><div class="input_container"><label for="headquarters"><input type="checkbox" id="remember_me" name="remember_me" style="float:left;margin-top:8px;">Save Password</label></div>';
				html +='</div><div class="input_container"><label for="headquarters"></label>';
				html +='<button class="btn btn-primary btn-info" id="add" >Reboot</button></div></form>';
			$('.lightbox_content').html(html);	
			$('.lightbox_content h2').text('Reboot');
			$('#form_company button #add').text('Reboot');
			$('#form_company').attr('class', 'form add');
			
			$('#form_company').attr('data-id', localip);
			$('#form_company').attr('data-name', $(this).data('id'));

			$('#form_company .field_container label.error').hide();
			$('#form_company .field_container').removeClass('valid').removeClass('error');
			
			$('#form_company #password').val(password);
			$('#form_company #username').val(username);
			show_lightbox();		
		});

		$(document).on('click', '.function_flash a', function(e)
		{

			e.preventDefault();
			// Get company information from database
			var serverip      = $(this).data('name');
			var devId = $(this).data('id');
			$('#form_company').attr('data-id', serverip);

			
			var html ='<h2>Upload</h2>';
			html += '<form id="uploadFile" enctype="multipart/form-data">';
			html +='<div class="input_container"><label for="headquarters"></label><input type="file" name="update" id="update"></div>';
			html +='<div class="input_container"><button type="submit" id="submit" value="Upload" name="submit" class="btn btn-primary">Update</button></div></form>';
			html += '<div id="upload_message" style="color:blue;"></div>';
		
			$('.lightbox_content').html(html);
			$('#uploadFile').attr('data-id', serverip);
			$('#uploadFile').attr('data-name', devId);
			show_lightbox();

			
		});
		
		$(document).on('submit', '#uploadFile', function(e)
		{
		  var ip = $('#uploadFile').attr('data-id');
		  var devId = $('#uploadFile').attr('data-name');
		  e.preventDefault();
		  $.ajax(
		  { 
		    url:'http://'+ip+'/update' ,
		    type: 'POST',
		    data: new FormData(this),
		    contentType: false,
		    processData: false,
		    success: function(data)
		    {
		    	$("#upload_message").text("successfully uploaded");
		    	
				var request   = $.ajax({
				 url:          './bond/process/sec.php?cmd=flash&devId='+devId,
				 cache:        false,
				 contentType:  false,
				 type:         'get'
			   });
				//hide_lightbox();
		    	
		    },
		    error: function (jqXHR, textStatus, errorThrown)
  			{
  			//	alert(jqXHR.responseText);	
            }
		  });

		});

		$(document).on('click', '.function_power a', function(e)
		{

			e.preventDefault();
			// Get company information from database
			var localip      = $(this).data('name');
			var request   = $.ajax
			({
				url:          'http://'+localip+'/manual',
				cache:        false,
				dataType:     'text',
				contentType:  false,
				type:         'get',
				success:function(data)
				{
        		},
      			error: function (jqXHR, textStatus, errorThrown)
      			{
      		    }
			});
					
		});
		$(document).on('click', '.wdten', function(e)
		{

			e.preventDefault();
			// Get company information from database
			jQuery.support.cors = true;
      var localip      = $(this).data('name');
			var value =$(this).text();
			var wdt = 'enable=';
			if(value =='enable')
				flag ='false';
			else
				flag ='true';

			var request   = $.ajax
			({
				url:          'http://'+localip+'/wdt?'+wdt+flag,
				cache:        false,
				dataType:     'text',
				contentType:  false,
				type:         'get',
        context: this,
				success:function(data)
				{
          if(flag =='true')
					{ 
            $(this).text('enable');
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-warning');
          }
          else
          {
            $(this).text('disable');
            $(this).removeClass('btn-warning');
            $(this).addClass('btn-secondary');
          }
        },
      	error: function (jqXHR, textStatus, errorThrown)
      	{
      	}
			});
					
		});


		$(document).on('submit', '#form_company.add', function(e)
		{

			e.preventDefault();
			// Validate form
			
			
			  // Send company information to database
			  //hide_lightbox();
			  //show_loading_message();
			  var form_data = $('#form_company').serialize();
			  var localip        = $('#form_company').attr('data-id');
			  var devId = $('#form_company').attr('data-name');
			  var request   = $.ajax({
				url:          './bond/process/sec.php?cmd=reboot&localip='+localip+'&devId='+devId,
				cache:        false,
				data:         form_data,
				contentType:  false,
				type:         'get'
			  });
			  request.done(function(output)
			  {
	            
				alert(output);
				hide_lightbox();
				location.reload();	
			  });
			  request.fail(function(jqXHR, textStatus)
			  {
	            $("#error_div").html(jqXHR.responseText);
				hide_loading_message();
				show_message('Add request failed: ' + textStatus, 'error');
			  });
				
		});

		

		/*setInterval(function()
		{
			table_companies.ajax.reload();	
		}, 
		10000);*/

    });

	
</script>
