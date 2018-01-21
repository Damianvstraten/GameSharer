$(document).ready(function(){

    $('.active_state').change(function () {
        $form = $(this).parent().parent();
        $form.submit();
    });

    $('.reply-opener').on('click', function () {
        console.log($(this).parent().parent().parent().find('.sub-comment').collapse().toggle());
    })
});