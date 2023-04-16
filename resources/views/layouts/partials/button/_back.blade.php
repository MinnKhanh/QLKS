<button onclick="goBack()" class="btn btn-default" type="button">
	<i class="fa fa-arrow-left"></i>
	Trở lại
</button>
<script>
	function goBack() {
    	var url = '{{isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '#' }}';
		window.location.replace(url);

}

</script>