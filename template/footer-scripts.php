
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
	$(document).ready(function() {
	
		var url = window.location;
		// Will only work if string in href matches with location
		$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
		$('div#header div.b-content td.header a[href="'+ url +'"]').parent().addClass('active');

		// Will also work for relative and absolute hrefs
		$('ul.nav a').filter(function() {
			return this.href == url;
		}).parent().addClass('active');
		$('div#header div.b-content td.header a').filter(function() {
			return this.href == url;
		}).parent().addClass('active');

		$('input[name=qty]').change(function() {
			var serial = $(this).attr('serial');
			var total_item_tmp = $('#total_item').text();
			var total_item = parseInt(total_item_tmp);
			var tmp_price = $('#price'+serial).text();
			var price = tmp_price.replace(',','');
			var qty = $(this).val();
			//console.log(parseInt(total_item));

			var total_price = parseInt(price) * parseInt(qty);

			$('#single_result'+serial).text(total_price+'.00 ৳');

			var total_result = 0;
			for(var i=1; i<=total_item; i++){
				var single_tmp = $('#single_result'+i).text();
				var single = parseInt(single_tmp.replace(',',''));
				total_result = single + total_result;
			}

			$('#result').text(total_result+'.00 ৳');

		});

		
		
	});
	</script>