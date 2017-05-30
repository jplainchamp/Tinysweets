
$('#dateLivraison').datetimepicker();
$('button.somebutton').on('click', function () {
    $('#dateLivraison').datetimepicker('show', {
        formatDate: 'Y/m/d',
        formatTime: 'H:i',
        lang:'fr',
        weeks: true,
        defaultDate: '+2016/10/10'
    });
});
