$(document).ready(function () {
	$(document).on('click', '#btn-submit', function() {
		var name = $('#role-name').val();
		var permissions = [];
		$('input:checkbox.form-control-styled:checked').each(function () {
				var action = $(this).attr('data-action');
				var group = $(this).attr('data-group');
				permissions.push({
					'action':action,
					'group':group
				})
		  });
		$.ajax({
		    type: "POST",
		    url: url_post,
		    data: JSON.stringify({
		    	'name':name,
		    	'permissions':permissions
		    }),
		    contentType: "application/json; charset=utf-8",
		    dataType: "json",
		    success: function(data){
		    	alert(data.message);
		  	},
		    failure: function(errMsg) {alert('errMsg');},
		});
	});
});