$(document).ready(function() {
    $('#addSubject').submit(function(e) {
        e.preventDefault();
        var formdata=$(this).serialize();
        alert(formdata);
        // $.ajax({
        //     url:"{{route('addSuject')}}",
        //     type:"POST",
        //     data:formdata,
        //     success:function(data){
        //      console.log(data);   
        //     }
        // });
    });
});