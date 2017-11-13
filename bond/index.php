<style>
.form-group {margin-left:20px;}
.row{margin-right:0px;}
#table_logging tr td{color:#337ab7;}
#table_logging tr th{color:#337ab7;font-weight: bold;}
.panel-heading {font-weight:bold;}
</style>
<div id="errordiv">
</div>
<!-- start page -->
<div id="page" >
	<!-- start content -->
	<div id="container-fluid">
		<div class="panel panel-default">
            <div class="panel-heading"> Location:<?php echo $_GET['location']?>
                <!--a href="?b_m=bond&file=index" class="<?php echo $first_selected;?>" >Logging</a> | <a href="?b_m=bond&file=second" 
                class="<?php echo $second_selected;?>">State Management</a!-->
            </div>
            <!-- /.panel-heading -->
	        <div class="panel-body">
	        	<div style='line-height: 30px; margin-bottom: 10px;'><button class="btn btn-default function-delete"><i class="fa fa-times" aria-hidden="true"></i>delete</button>
				<button class="btn btn-info"><a href="javascript:history.back();"><i class="fa fa-history" aria-hidden="true"></i>back</a></button></div>
	            <div class="table-responsive">
	                <table class="table" id='table_logging'>
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>devId</th>
	                            <th>actionType</th>
	                            <th>message</th>
	                            <th>logTime</th>
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
    <!-- /.panel -->
    </div>
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
	var devId ="<?php echo $_GET['devId']?>";
	var table_companies =$('#table_logging').DataTable
	({
		"columns": [
			{"data": "id",sortable:false},
			{"data": "devId"},
		    {"data": "actionType"},
			{"data": "message"},
			{ "data": "logTime"}
		],
		"processing": true,
		"serverSide": true,
		"responsive": true,
		//"sPaginationType": "full_numbers",
		"ajax":
		{
			url: './bond/process/bond.php?devId='+devId,
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
		}//,
		//"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		
	});

	$(document).on('click', '.function-delete', function(e)
	{
		e.preventDefault();
		var someObj=[];
		if($("#table_logging tbody tr td input:checked").length >0)
		{
			$("input:checkbox").each(function()
			{
			    var $this = $(this);

			    if($this.is(":checked"))
			    {
			        someObj.push($this.attr("data-id"));
			    }

			});
			var request = $.ajax
			({
				url:          './bond/process/bond.php?cmd=del',
				cache:        false,
				type:         'get',
				data: {info:someObj},
				success:function(data)
				{
					//alert(data);
        		},
      			error: function (jqXHR, textStatus, errorThrown)
      			{
      		    }
		  	});
		  	request.done(function(output)
		  	{
				//alert(output);
				table_companies.ajax.reload(function()
				{}, true);
			});	


		}
		else
		{
			alert('please select row!');
		}
	});

	/*setInterval(function()
	{
		$('#jqGrid').trigger("reloadGrid");
	}, 
	2000);
	});*/
	

	/*setInterval( function () 
	{
    	table_companies.ajax.reload( null,false);
	}, 10000);*/
</script>
