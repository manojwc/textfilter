
<script type="text/javascript">
	$(".nav_link").removeClass('active');
	$("#nav_"+<?php echo json_encode($active_nav) ?>).addClass('active');
</script>

</body>

</html>