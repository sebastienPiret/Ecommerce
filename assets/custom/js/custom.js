

$(function () {
    $(document).ready(function() {
        $('.delitem').click(function () {
            var id = $(this).data('id');
            var text = $(this).data('text');
            $.ajax({
                type : 'POST',
                url: surl+'admin/deleteItem',
                data: {
                    id:id,
                    text:text
                },
                success:function (data) {
                    var ndata=JSON.parse(data);
                    if (ndata.return == true)
                    {
                        $('.erreur').text(ndata.message);
                        $('.cItem'+id).fadeOut();

                    }else if (ndata == false)
                    {
                        $('.erreur').text(ndata.message);
                    }else {
                        $('.erreur').text(ndata.message);
                    }
                    // location = location
                }
                ,
                error: function () {

                }
            })
        })
    });
})