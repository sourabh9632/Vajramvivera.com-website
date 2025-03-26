<?php
error_reporting(E_ERROR | E_PARSE);
include('../config.php');

if(!isset($_SESSION['user']) || empty($_SESSION['user'])):
	include 'login.php';
	exit;
else:
	$sql[0] = "SELECT * FROM "._TABLE_NAME_." ORDER BY date_time DESC";
	$lp_arr = [LP_NAME];
	foreach ($sql as $qry_key => $qry) {
		$result = mysqli_query($conn,$qry);
		while ($row = mysqli_fetch_array($result))
			$_rows[$lp_arr[$qry_key]]['lead_data'][] = $row;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex,nofollow">
	<title><?php echo LP_NAME ?> - Web Enquiry Details</title>
	<link rel="shortcut icon" href="images/fav-icon.png" type="image/x-icon">
	
	<!-- CSS Start-->

	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/semantic.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/dataTables.semanticui.min.css" type="text/css" media="all">

	<!-- CSS End-->

	<!-- jQuery Start-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>

	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
	
	<script type="text/javascript" src="js/dataTables.semanticui.min.js"></script>
	<!-- <script type="text/javascript" src="assets/js/main.js"></script> -->

	<script type="text/javascript">
		$(document).ready(function(){
		    console.log($)
			$('[data-toggle="tooltip"]').tooltip(); 
			
			if($('#leads_table').length){
				var table =$('#leads_table').DataTable( {

			    dom: 'Bfrtip',
			    buttons: [
			         { extend: 'copy', text: 'COPY TABLE' },
			          { extend: 'csv', text: 'EXPORT TABLE TO CSV' },
			           { extend: 'excel', text: 'EXPORT TABLE TO EXCEL' }
			    ],
			     initComplete: function () {
			            this.api().columns('5').every( function () {
			                var column = this;
			                var select = $('<select><option value="">All</option></select>')
			                    .appendTo( $(column.header()) )
			                    .on( 'change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex(
			                            $(this).val()
			                        );
			 
			                        column
			                            .search( val ? '^'+val+'$' : '', true, false )
			                            .draw();
			                    } );
			 
			                column.data().unique().sort().each( function ( d, j ) {
			                    select.append( '<option value="'+d+'">'+d+'</option>' )
			                } );
			            } );
			        }
			    });
			}
		})

	</script>

	<!-- jQuery End-->
	
	<style>
		@font-face {
			font-family: Icons;
			src: url("font/icons.woff2");
		}
		body{
		   overflow:visible;
		}
		tfoot input {
		    width: 100%;
		    padding: 3px;
		    box-sizing: border-box;
		}
		div.wrapper{
			padding: 20px;
		}
		.ui.pagination.menu .active.item,.ui.table thead th{
			background: #f5f5f5;
    		color: black !important;
		}
		table.dataTable.no-footer{
			border-bottom-color:rgba(34,36,38,.1);
		}
		.ui.link.menu .item:hover, .ui.menu .dropdown.item:hover, .ui.menu .link.item:hover, .ui.menu a.item:hover{
			background:#9E9E9E;
			color:white;
		}
		select{
			color:black;
			font-weight:normal;
		}
		select option{
			color:black !important;
		}
		.exportExcel{
		  padding: 5px;
		  border: 1px solid grey;
		  margin: 5px;
		  cursor: pointer;
		}
		.dt-buttons a {
		    background: #607D8B;
		    padding: 8px 20px;
		    color: white;
		    width: 100px;
		    margin-right: 10px;
		    border-radius: 3px;
		    outline: 0;
		}
		.dt-buttons {
		    display: inline-block;
		    margin: 20px auto;
		}
		.ui.pagination.menu{
			margin:10px 0px;
		}
		h3.title{
			float: left;
		}
		.logout{
			float: right;
		    margin-bottom: 30px;
		}
	</style>

</head>

<body>
	<div class="wrapper">	
	<h3 class="title"><?php echo LP_NAME ?> Enquiry Details</h3>
	<a href="logout.php" class="btn btn-default logout"><span class="glyphicon glyphicon-off"></span> Logout</a>
	<table id="leads_table" class="ui celled table" cellspacing="0" width="100%" >
		<thead>  
			<tr>  
				<th>S.No</th> 
				<th>Name</th> 
				<th>Email</th> 
				<th>Mobile</th>  
				<th>Page Name</th> 
				<th>Date</th>
				<th>Page URL</th>
				<th>UTM Source</th>
				<th>UTM Medium</th>
				<th>UTM Term</th>
				<th>UTM Content</th>
				<th>UTM Campaign</th>
				<th>IP Address</th>

			</tr>  

		</thead> 		

		<tbody>  

			<?php  

			$serialNo = 1;

			foreach ($_rows as $lp_name => $_row)
				foreach ($_row as $lead)
					foreach ($lead as $leads) {				
			?> 

	            <tr>  

	            	<td><?php echo $serialNo ?></td>

		            <td ><span title="<?php echo $leads["name"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads['name']; ?></span></td>

		            <td width="70px"><span title="<?php echo $leads["email"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["email"]; ?></span></td>

		            <td ><span title="<?php echo $leads["mobile"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["mobile"]; ?></span></td>



					<td style="white-space: nowrap;"><?php echo $lp_name; ?></td>

					 <td style="white-space: nowrap;"><span title="<?php echo $leads["date_time"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo date('d-m-Y', strtotime($leads["date_time"])); ?></span></td>  

					<td ><span title="<?php echo $leads["page_url"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["page_url"]; ?></span></td>

		            <td ><span title="<?php echo $leads["utm_source"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["utm_source"]; ?></span></td>

		            <td ><span title="<?php echo $leads["utm_medium"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["utm_medium"]; ?></span></td>

		            <td ><span title="<?php echo $leads["utm_term"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["utm_term"]; ?></span></td>

		            <td ><span title="<?php echo $leads["utm_content"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["utm_content"]; ?></span></td>

		            <td ><span title="<?php echo $leads["utm_campaign"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["utm_campaign"]; ?></span></td>           
		            <td ><span title="<?php echo $leads["ip_address"]; ?>" data-toggle="tooltip" data-placement="top"><?php echo $leads["ip_address"]; ?></span></td>           

	            </tr>  

			<?php  

			$serialNo++;

			};  

			?>  

		</tbody>  

	</table>
</div>

<script>	

</script>
<?php mysqli_close($conn); ?>


</body>
</html>
<?php 
endif;
?>