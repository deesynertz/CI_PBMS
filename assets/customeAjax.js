
$(function () {

    updateProjectStatus();


    function updateProjectStatus() {
       $.ajax({
           type: 'post',
           url: 'notification',
           data:{userID: 2},
           success: function(data){
            console.log(data);
           },
           error: function(){

           }
       })
    };


    $('.delete_project').click(function () {
        const id = $(this).attr("id");
    });



    setInterval(function(){ 
        // var receiver_id = $('#ReciverId_txt').val();
        // if(receiver_id!=''){GetChatHistory(receiver_id);}
    }, 3000);

});
