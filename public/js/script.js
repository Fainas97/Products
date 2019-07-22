$(document).ready(function () {
    $('.ratings_stars').hover(
        function () {
            $(this).prevAll().addBack().addClass('ratings_over');
            $(this).nextAll().removeClass('ratings_vote');
        },
        function () {
            $(this).prevAll().addBack().removeClass('ratings_over');
            set_votes($(this).parent());
        }
    );
})

function set_votes(widget) {
    var avg = $(widget).data('fsr').avg;
    var votes = $(widget).data('fsr').votes;

    $(widget).find('.star_' + avg).prevAll().addBack().addClass('ratings_vote');
    $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
    $(widget).find('.total_votes').text(votes + ' rating(s)');
}

$(document).ready(function () {
    $('.rate_widget').each(function (i) {
        var widget = this;
        $.ajax({
            method: 'GET',
            url: '/product/rating/' + $(widget).attr('id'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $(widget).data('fsr', data);
                set_votes(widget);
            },
            error: function (data) {
            }
        });
    });
});

$(document).ready(function () {
    $('.ratings_stars').bind('click', function () {
        var star = this;
        var widget = $(this).parent();
        var data = {
            clicked_on: $(star).attr('class').slice(5, 6),
            widget_id: widget.attr('id'),
        };
        $.ajax({
            method: 'POST',
            url: '/product/rating',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data,
            success: function (data) {
                widget.data('fsr', data);
                set_votes(widget);
            },
            error: function (data) {
            }
        });
    });
});