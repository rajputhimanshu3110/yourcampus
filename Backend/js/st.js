$('#courseSelect').on("change",function(){
  var select_input = $(this).val();
  console.log(select_input);
  $("#semSelect").html(select_input);
   $.ajax({
        url: "includes/sembycourse.php",
        type : "POST",
        data: {course:select_input},
        success : function(data) {
          $("#semSelect").html(data);
        }
      });
  
 });