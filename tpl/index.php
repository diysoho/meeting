<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=7">
<title>会议室预定</title>


<script language="javascript" type="text/javascript" src="./datePicker/WdatePicker.js"></script>
<link href="./style/css/skin_0.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="./style/js/jquery.js"></script>

<style type="text/css">
body{
	font-family: '微软雅黑',Arial;
	font-weight: normal;
	color: #2e434c;
}
a {
    color: #2e434c;
    text-decoration: none;

}
a.btn-search { color: #555; line-height:28px; background: transparent url(./style/img/bg_position.gif) no-repeat scroll -130px -450px; vertical-align:middle; display: inline-block; width: 28px; height: 28px; cursor: pointer;}
a.btn-search:hover { background-position: -160px -450px;}
a.btn-search:active { background-position: -190px -450px;}
a.nav_day{color:#2e434c;font-size: 14px;height: 38px;cursor: pointer;}


a.btn{
	display: inline-block;
	background: #7dbc18;
	border-radius: 5px;
	padding: 0 20px;
	line-height: 40px;
	color: #fff;
	text-align: center;

}
#idContainer{
	padding-top:30px;
	padding-left:30px;
	position:relative;
	width:1000px;
	margin: 0 auto;
}
#idDaySelect{
	float:right;
}
#idDaySelect a, #idNav a{
	margin-left:10px;
	text-decoration:underline;
}
#idNav{
	float:left;
}
#idTableList{
	float:left;
	margin-top:20px;;
}
#idTableList td{
	width:130px;
	text-align:center;
	vertical-align:middle;
	color: #2e434c;
	font-size: 14px;
	padding: 10px 0;
}
#idTableList td.even{
	background: #f7fbff;
	
}
#idTableList td.bg_color{
	background: #e3f6c4;
	font-weight: bold;
	color: #5a8712;
}
#idTableList td.room{
	cursor:pointer;
}
#idAddRoom, #idMeetingDesc{
	position:absolute;
	background-color:#fff;
	border-radius:5px;
	display:none;
}
#idAddRoom{
	border:2px solid #8397bb;
	top:200px;
	left:250px;
	width:400px;
	height:220px;
	padding:30px;
}
#idMeetingDesc{
	border:1px solid #8397bb;
	width:180px;
	height:50px;
	padding:8px;
}
.tb-type2{
	margin-left: 40px;
}
.tb-type2 td{
	font-size: 14px;
	padding: 10px 0;
}
.tb-type2 select,.tb-type2 input{
	font-size: 14px;
}
#idNotice{
	float:left;
	margin-top:20px;
}
.navf span{
	display: inline-block;
	background: #7dbc18;
	border-radius: 5px;
	padding: 0 20px;
	line-height: 40px;
	color: #fff;
}
#idDaySelect span{
	display: inline-block;
	background: #e3eef9;
	border-radius: 3px;
	padding: 0 13px;
	line-height: 30px;
	font-size: 12px;
}
h4{
	font-size:14px;
	height:25px;
}
</style>

</head>

<body scroll="no">
<div id="idContainer">
    
	<div id="idDaySelect">
		<a href="./index.php?act=show&day=<?php echo $output['today']; ?>" class="nav_day"><span>今天</span></a>
		<?php
			while( $output['future_days'] ){
				$output['timestamp'] = $output['timestamp'] + 3600*24;
				$curr_full_day = date("Y-m-d", $output['timestamp']);
				$curr_day = date("m月d日", $output['timestamp']);
				echo '<a href="./index.php?act=show&day=' . $curr_full_day . '" class="nav_day"><span>' . $curr_day . '</span></a>';
				$output['future_days'] -- ;
			}
		?>
	</div>

	<div id="idNav">
		<a href="JavaScript:void(0);" nctype="show_add_room" class="nav_day navf"><span>预定会议室</span></a>
		<a href="./list.php" class="nav_day"><span>会议室预定列表</span></a>
	</div>
	
	<div id="idTableList">
       <table data-sort="sortDisabled" border="1px" bordercolor="#aac4dc" cellspacing="0px" >
			<tbody>
				<tr class="strong">
					<td rowspan="1" colspan="9" style="word-break: break-all;" align="center">
						会议室预约【<span id="yuyue"><?php echo $output['current_day'] ?></span>】
					</td>
				</tr>
				<tr class="strong">
					<td rowspan="2" style="word-break: break-all;" align="center">
						预约时间<br>
					</td>
					<td rowspan="1" colspan="<?php echo $output['rooms_type_a_num'] ?>"style="word-break: break-all;"  align="center">
						A区
					</td>
					<td rowspan="1" colspan="<?php echo $output['rooms_type_b_num'] ?>" style="word-break: break-all;" align="center">
						B区<br>
					</td>
				</tr>
				<tr class="strong room_title">
					<?php
						foreach( $output['rooms_arr'] as $room_id=>$room ){
							echo '<td style="word-break: break-all;" align="center" room_id="' . $room_id . '">';
							echo '<span>' . $room['name'] . "</span><br /><span style='font-size:12px; font-weight:normal;'>(" . $room['position'] . ")<span>";
							echo '</td>';
						}
					?>
				</tr>
				<?php
					$time_pre = $output['time_pre'];
					foreach( $output['time_arr'] as $part_time){
						$part_full_start = $output['current_day'] . ' ' . $part_time['start'] . ':00';
						$part_full_end	= $output['current_day'] . ' ' . $part_time['end'] . ':00';
						echo '<tr>';
							echo '<td class="strong" style="word-break: break-all; width:170px;" align="center" start="' . $part_time['start'] . '" end="' . $part_time['end'] . '">';
								echo $time_pre[$part_time['type']] . $part_time['start'] . '-' . ($part_time['end'] ? $part_time['end'] : '?');
							echo '</td>';
								foreach( $output['rooms_arr'] as $room_no=>$room ){
									$flag_name = '';
									$flag_bg_color = '';
									$period_time = '';
									if ( $lists[$room_no] ) {
										foreach( $lists[$room_no] as $room_lists ){
											$db_start = $room_lists['start_time'];
											$db_end = $room_lists['end_time'];

											if ( 
													($db_start >= $part_full_start && $db_end <= $part_full_end) || 
													($db_start < $part_full_start && $db_end > $part_full_end) || 
													($db_start>=$part_full_start && $db_start <$part_full_end) || 
													($db_end>$part_full_start && $db_end <=$part_full_end)
												) {
												$flag_name = $room_lists['name'];
												$flag_bg_color = 'bg_color';
												$period_time = substr($db_start, 11, 5) . '至' . substr($db_end, 11, 5);
												continue;
											}
										}
									}
									echo '<td width="143" valign="top" nctype="room" class="room ' . $flag_bg_color . '" time="'.$period_time.'">' . $flag_name . '</td>';
								}
						echo '</tr>';
					}
				?>
			</tbody>
       </table>
    </div>

	<div id="idNotice">
		<p>
			注：会议室预定存在冲突请联系当事人或前台协调调整。<br>
		</p>
	</div>

	<div id="idAddRoom">
		<div style="position:absolute;right:6px; top:6px;"><a href="JavaScript:void(0);" nctype="close_add_room"><span style="font-weight:40px; color:black;">关闭<span></a></div>

		<form id="idAddForm" enctype="multipart/form-data" method="post">
			<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
			<table class="table tb-type2">
			  <tbody>
				<tr height="30">
				  <td class="required" width="100"><label class="validation" for="type_name">预订人：</label></td>
				  <td class="vatop rowform"><input type="text" value="" name="name" id="idName" maxlength="20" class="txt"></td>
				</tr>
				<tr height="30">
				  <td class="required"><label for="parent_id">会议室列表：</label></td>
				  <td class="vatop rowform">
					<select name="room" id="idRoom">
					  <option value="0">请选择会议室</option>
					  <?php
						foreach( $output['rooms_arr'] as $k=>$room ){
							echo '<option value="' . $k . '">[' . $room['type'] . '] ' . $room['name'] . '</option>';
						}
					  ?>
					</select>
				  </td>
				</tr>
				<tr height="30">
				  <td class="required"><label>开始时间：</label></td>
				  <td class="vatop rowform">
					<input type="text" value="<?php echo substr($output['current_day'], 0, 10); ?>" name="start" id="idStart" class="txt" style="width:90px" onFocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd'})" />
					<select name="start_hour" id="idStartHour">
					<?php
						if ( $output['hour_arr'] ) {
							foreach ( $output['hour_arr'] as $hour ) echo '<option value="' . $hour . '">' . $hour . '</option>';
						}
					?>
					</select>
					<select name="start_minute" id="idStartMinute">
					<?php
						if ( $output['minute_arr'] ) {
							foreach ( $output['minute_arr'] as $minute ) echo '<option value="' . $minute . '">' . $minute . '</option>';
						}
					?>
					</select>
				  </td>
				</tr>
				<tr height="30">
				  <td class="required"><label>结束时间：</label></td>
				  <td class="vatop rowform">
					<input type="text" value="<?php echo substr($output['current_day'], 0, 10); ?>" name="end" id="idEnd" class="txt" style="width:90px" onFocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd'})" />
					<select name="end_hour" id="idEndHour">
					<?php
						if ( $output['hour_arr'] ) {
							foreach ( $output['hour_arr'] as $hour ) echo '<option value="' . $hour . '">' . $hour . '</option>';
						}
					?>
					</select>
					<select name="end_minute" id="idEndMinute">
					<?php
						if ( $output['minute_arr'] ) {
							foreach ( $output['minute_arr'] as $minute ) echo '<option value="' . $minute . '">' . $minute . '</option>';
						}
					?>
					</select>
				  </td>
				</tr>
			  </tbody>
			  <tfoot>
				<tr height="50">
				  <td colspan="2"><a href="JavaScript:void(0);" nctype="add_room" class="btn" id="submitBtn" style="margin-left:100px;"><span>提交</span></a></td>
				</tr>
				<tr height="50">
				  <td colspan="2" id="idAddNotice" style="color:red; text-align:center;"></td>
				</tr>
			  </tfoot>
			</table>
		</form>
	</div>
</div>

<div id="idMeetingDesc">
	<h4></h4>
	<p></p>
</div>
<script type="text/javascript">
$(function(){
	$('td[nctype="room"]').mouseenter(function(e){
		if ( !$(this).html() ) return;
		var my_index	= $(this).index();
		var room_name	= $(this).parent().siblings(".room_title").children().eq(my_index - 1).children().eq(0).html();
		var period_time	= $(this).attr("time");
		var period_time	= "<strong>会议时间：</strong>" + period_time;
		display_desc = setTimeout(function() {
			e = e || window.event; 
			var mousePos = mouseCoords(e);
			$("#idMeetingDesc").children("h4").html(room_name);
			$("#idMeetingDesc").children("p").html(period_time);
			$("#idMeetingDesc").css("top", mousePos.y - 8);
			$("#idMeetingDesc").css("left", mousePos.x + 8);
			$("#idMeetingDesc").css("display", "block");
		}, 100);
	}).mouseleave(function(){
		$("#idMeetingDesc").css("display", "none");
		clearTimeout( display_desc );
	});
	$('td[nctype="room"]').dblclick(function(){
		if ( $(this).html() ) return;
		var my_index = $(this).index();
		var room_id = $(this).parent().siblings(".room_title").children().eq(my_index - 1).attr("room_id");

		var time_start	= $(this).parent().children("td:first-child").attr("start");
		var time_end	= $(this).parent().children("td:first-child").attr("end");
		var time_starts = time_start.split(":");
		var time_ends	= time_end.split(":");
		var time_start_h= time_starts[0];
		var time_start_m= time_starts[1];
		var time_end_h	= time_ends[0];
		var time_end_m	= time_ends[1];
		if ( !time_end ) time_end_h = parseInt(time_start_h) + 1;

		$("#idRoom").val(room_id);
		$("#idStartHour").val(time_start_h);
		$("#idStartMinute").val(time_start_m);
		$("#idEndHour").val(time_end_h);
		$("#idEndMinute").val(time_end_m);

		$("#idAddRoom").css("display", "block");
	});
	$('a[nctype="show_add_room"]').click(function(){
		$("#idAddRoom").css("display", "block");
	});
	$('a[nctype="close_add_room"]').click(function(){
		$("#idAddRoom").css("display", "none");
		$("#idAddNotice").text('');
	});
	$('a[nctype="add_room"]').click(function(){
		var name = $('#idName').val();
		var room = $('#idRoom').val();
		var start = $('#idStart').val() + ' ' + $('#idStartHour').val() + ':' + $('#idStartMinute').val();
		var end	= $('#idEnd').val() + ' ' + $('#idEndHour').val() + ':' + $('#idEndMinute').val();
		if ( !name ) {
			$('#idAddNotice').text('预订人不能为空');
			return;
		} else if ( room == 0 ) {
			$('#idAddNotice').text('请先选择会议室');
			return;
		} else if ( start == end ) {
			$('#idAddNotice').text('会议的开始时间跟结束时间不能相同');
		}

        $.post("./index.php?act=add", { name: name, room: room, start: start, end: end },
		   function(data){
			 var msg = '';
			 switch( data ) {
				case 'param_err':
					msg = "提交信息不完整";
					break;
				case 'same_err':
					msg = "会议的开始时间跟结束时间不能相同";
					break;
				case 'conflict_err':
					msg = "会议室预定冲突，请重新选择！";
					break;
				case 'succ':
					msg = "预定成功";
					break;
				case 'fail':
					msg = "预定失败";
					break;
				default:
					msg = data;
					break;
			 }
			 $("#idAddNotice").text(msg);
			 if ( data == 'succ' ) window.location.href = "./index.php";
		});

	
	});

$('#idTableList tr:even').find('td').addClass('even')
$('#idTableList tr:eq(2)').find('td').css({'background':'#66a3d5','color':'#fff','font-weight':'bold'})
});
function mouseCoords(ev) { 
	if(ev.pageX || ev.pageY){ 
		return {x:ev.pageX, y:ev.pageY}; 
	}
	return{
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft, 
		y:ev.clientY + document.body.scrollTop - document.body.clientTop 
	}; 
} 
</script>
</body>
</html>