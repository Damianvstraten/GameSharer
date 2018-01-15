$(document).ready(function(){

    $('.active_state').change(function () {
        var state = $(this).prop('checked');

        $form = $(this).parent().parent();
        $form.submit();

        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     },
        //     type: "post",
        //     data: {"state": state},
        //     success: function (data) {
        //         console.log("test");
        //     },
        //     errors: function () {
        //       console.log('niet goed')  ;
        //     }
        // });
    });

    $('.reply-opener').on('click', function () {
        $(this).parent().parent().parent().find('.sub-comment').collapse().toggle();

    })
});