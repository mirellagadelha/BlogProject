(function ($) {
    $(function () {

    	function showMessage(messageAlert, messageText){
    		$(".admin-feed").find(".messages").html('<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert-dismissable" aria-hidden="true">&times;</button>' + messageText + "</div>");
    	}

		$("#addFormNews").submit(function(e) {
			var urlAction = $("#insertNewsModal").find("form").attr("action");
			$.ajaxSetup({
            	headers: {
                	'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });     
    		$.ajax({
      			type: 'POST',
      			url: urlAction,
      			dataType: 'json',
      			data: $("#insertNewsModal form").serialize(),
	      		success: function(data){
	      			location.reload();
	      		}, 
	      		error: function(data){
	      			location.reload();
	      		}
    		});
    		
    		return false;
  		});


  		$('.edit-form').on('click', function(e) {
  			$('#editFormNews input[name=id]').val($(this).data('id'));
  			$('#editFormNews input[name=title]').val($(this).data('title'));
  			$('#editFormNews textarea[name=body]').val($(this).data('body'));
  			$('#editFormNews input[name=category]').val($(this).data('category'));
  			$('#editFormNews input[name=author]').val($(this).data('author'));
  			$('#editFormNews input[name=keywords]').val($(this).data('keywords'));
		});

		$('.remove-news').on('click', function(e){
			$('.title').html($(this).data('title'));
			$('.idNews').text($(this).data('id'));
		});

		$("#editFormNews").submit(function(e) {
			e.preventDefault();
			var id = $("#editFormNews input[name=id]").val();
			var dataForm = $("#editModal form").serialize();
			var url = 'id='+id+'&'+dataForm;

			var urlAction = $("#editModal").find("form").attr("action");
			$.ajaxSetup({
            	headers: {
                	'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });     
    		$.ajax({
      			type: 'PUT',
      			url: urlAction+'/'+id,
      			dataType: 'json',
      			data: url,
	      		success: function(data){
	       			location.reload();
	      		},
    		});
  		});

  		$(".modal-footer #delete").click(function(e){
			$.ajaxSetup({
            	headers: {
                	'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            }); 
            $.ajax({
    			type:'delete',
    			url: 'news/'+$('.idNews').text(),
			    success: function(data){
			       location.reload();
			    }
  			});
  		});

    });
})(jQuery);