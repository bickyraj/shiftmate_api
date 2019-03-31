
<?php 

if($output ==1):

	// echo "<pre>";print_r($orgArray);die();
		if(isset($shiftDetails) && !empty($shiftDetails))
		{
			$shifts = json_encode($shiftDetails);

			// echo $shifts;
		}

		define('URL', $this->webroot);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Calendar</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>



<link href="<?php echo URL;?>theme/Default/css/../global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo URL;?>theme/Default/css/../global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo URL;?>theme/Default/css/../global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo URL;?>theme/Default/css/../global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>


<link href="<?php echo URL;?>theme/Default/css/../global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo URL;?>theme/Default/css/../global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo URL;?>theme/Default/css/../admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo URL;?>theme/Default/css/../admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">

<div class="page-container">

	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col1">
					<div class="col-md-4 col-sm-4">
						<!-- BEGIN PORTLET-->
						<div class="portlet light">
							<div class="portlet-title tabbable-line">
								<div class="caption">
									<i class="icon-globe font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">Organization</span>
								</div>
							</div>
							<div class="portlet-body">
								<!--BEGIN TABS-->
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1_1">
										<div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
											<ul class="feeds">
												<?php foreach($orgArray as $org):?>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																		<div style="width:30px;height:30px;background-color:<?php echo $org['color'];?>"></div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 <?php echo $org['name'];?>
																	</div>
																</div>
															</div>
														</div>
													</li>
												<?php endforeach;?>
											</ul>
										</div>
									</div>
								</div>
								<!--END TABS-->
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
				</div>
				<div class="col2">
					<div class="col-md-6 col-sm-6">
						<h2 class="page-title text-capitalize"><?php echo $name;?><small> Shift Calendar</small></h2>
						<?php foreach ($shiftDetails as $key=> $value):?>
							<div class="col-md-12">
								<div class="portlet box green-meadow calendar">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Calendar
										</div>
									</div>
									<div class="portlet-body">
										<div class="row">
											<div class="col-sm-12">
												<div id="Shiftcalendar_<?php echo $key;?>" class="has-toolbar">
												</div>
											</div>
										</div>
										<!-- END CALENDAR PORTLET-->
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->


<script src="<?php echo URL;?>theme/Default/css/../global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo URL;?>theme/Default/css/../global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo URL;?>theme/Default/css/../global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo URL;?>theme/Default/css/../global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL;?>theme/Default/css/../global/plugins/moment.min.js"></script>
<script src="<?php echo URL;?>theme/Default/css/../global/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo URL;?>theme/Default/css/../global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo URL;?>theme/Default/css/../admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo URL;?>theme/Default/css/../admin/pages/scripts/calendar.js"></script>

<script>
jQuery(document).ready(function() {
   Calendar.init();
});
</script>
<script type="text/javascript">

	$(function()
		{

			var output = parseInt('<?php echo $output;?>');

			// var date = new Date();
   //          var d = date.getDate();
   //          var m = date.getMonth();
   //          var y = date.getFullYear();

            var h = {};

			if(output == '1')
			{

				var shifts = JSON.parse('<?php echo($shifts);?>');

				console.log(shifts);
				$.each(shifts, function(i, v)
					{
						var shiftList = "";
						// console.log(v.shiftDetail);

						 shiftList = $.map(v.shiftDetail, function(index, value) {

												var setDate = (index.Date).split("-");
				                            return {
				                            	title:index.Shift,
				                            	start:index.Date,
				                            	backgroundColor:index.Color
				                            };
										});

							
							$("#Shiftcalendar_"+i).fullCalendar({
								header: {
									        left:'title',
									        right:'next'
									    },
				                defaultView: 'month',
				                events: shiftList,
				                eventRender: function(event, element) {
																        $(element).find(".fc-time").remove();
																    }
							});
							$('#Shiftcalendar_'+i).fullCalendar('gotoDate',v.date);
					});
				
			}
			else
			{
				$("#Shiftcalendar").fullCalendar(
					{
						defaultView:'month'
					});
			}
		});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>

<?php else:?>
	<div>No Shifts to Show.</div>
<?php endif;?>
