$( document ).ready(function() {

    $('.voteAdded').click(function() {
    $('#confirmVote').show();
    setTimeout(function() {
        $('#confirmVote').fadeOut();
    }, 5000);
    });


    $('#hideshowvote').on('click', function(event) {
             jQuery('#content-vote').toggle('show');
        });

    $('#hideshowone').on('click', function(event) {
             jQuery('#content-one').toggle('show');
        });

    $('#hideshowtwo').on('click', function(event) {
             jQuery('#content-two').toggle('show');
        });

    $('#hideshowthree').on('click', function(event) {
             jQuery('#content-three').toggle('show');
        });
});
