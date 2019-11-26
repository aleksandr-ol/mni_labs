<!DOCTYPE html>
<html>
<head>
	<title>ВПІ</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style type="text/css">
		.mb-10 {
		  margin-bottom: 10px;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div class = "container">
	<div class="row justify-content-center">
		<h1>ЛР №2. Реалізація операцій над мультимножинами</h1>
	</div>
	<div class="row">
		<p><b>Завдання 1.</b> Перевірити чи є мультимножина В підмультимножиною мультимножини А</p>
	</div>

	<form id="z1" method="POST", action="">
		<div class="row"><label>Введіть через кому елементи мультимножини А: <input type="text" name="mn_A"></label></div>
		<div class="row"><label>Введіть через кому елементи мультимножини В: <input type="text" name="mn_B"></label></div>
		<div class="row"><input type="submit" name="subm" class="btn btn-outline-dark" value = "Перевірити"></div>
	</form>

	<div class="row" id="z1_cont">
	<!-- Модальное окно -->  
		<div class="modal fade" id="z1Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h4 class="modal-title" id="z1ModalLabel"></h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" id="z1ModalBody">
		      </div>
		    </div>
		  </div>
		</div>
		
	</div>

	<div class="row">
		<p><b>Завдання 2.</b> Створити програми для обчислення перерізу, суми та об'єднання мультимножин</p>
	</div>

	<form id="z2" method="POST", action="">
		<div class="row"><label>Введіть через кому елементи мультимножини А: <input type="text" name="mn_A"></label></div>
		<div class="row"><label>Введіть через кому елементи мультимножини В: <input type="text" name="mn_B"></label></div>
		<div class="row">
			<div class="col"><input type="submit" name="subm" class="btn btn-outline-dark" 
				value = "Переріз" id="inters"></div>
			<div class="col"><input type="submit" name="subm" class="btn btn-outline-dark" 
				value = "Об'єднання" id="merge"></div>
			<div class="col"><input type="submit" name="subm" class="btn btn-outline-dark" 
				value = "Сума" id="sum"></div>
		</div>
	</form>

	<div id="qwerty"></div>
</div>
<script type="text/javascript">
	$(function(){
	    $("#z1").on("submit", function(e){
	    	e.preventDefault();
	        $.ajax({
			  url: "/lab2z1.php",
			  type: "POST",
			  dataType: "html",
			  data: $("#z1").serialize(),
			  success: function( response ) {
			  	result = $.parseJSON(response);
			    $( "#z1_cont" ).html($("#z1_cont").html() + result.result +
			    	"<div class = \"col\"><button type=\"button\" " +
			    	"class=\"btn btn-outline-dark\" data-toggle=\"modal\"" +
			    	"data-target=\"#z1Modal\">Показати таблицю розв'язування</button></div>" +
			    	"<div class = \"col\"></div>");
			    $("#z1ModalBody").html(result.htmlTable);
			  },
			  error: function(response) { // Данные не отправлены
	            $('#z1_cont').html('Ошибка. Данные не отправлены.');
    		  }
			});
	    });


	    $("#inters").on("click", function(e){
	    	e.preventDefault();
	        $.ajax({
			  url: "/lab2z2intersection.php",
			  type: "POST",
			  dataType: "html",
			  data: $("#z2").serialize(),
			  success: function( response ) {
			  	result = $.parseJSON(response);
			    $("#qwerty").html(result.htmlTable);
			  }
			});
	    });

	    $("#merge").on("click", function(e){
	    	e.preventDefault();
	        $.ajax({
			  url: "/lab2z2merge.php",
			  type: "POST",
			  dataType: "html",
			  data: $("#z2").serialize(),
			  success: function( response ) {
			  	result = $.parseJSON(response);
			    $("#qwerty").html(result.htmlTable);
			  }
			});
	    });

	    $("#sum").on("click", function(e){
	    	e.preventDefault();
	        $.ajax({
			  url: "/lab2z2sum.php",
			  type: "POST",
			  dataType: "html",
			  data: $("#z2").serialize(),
			  success: function( response ) {
			  	result = $.parseJSON(response);
			    $("#qwerty").html(result.htmlTable);
			  }
			});
	    });
	});
</script>
</body>
</html>