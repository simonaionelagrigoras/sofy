$('document').ready(function(){
    //menu actions
    $('.navbar-nav>li.option').on('click', function (e) {
        $('.navbar-nav>li').removeClass('selected');
        $(e.currentTarget).addClass('selected');
    })
    $('.dropdown-toggle').on('click', function (e) {

        if($(e.target).data('aria-expanded')==true){
            $(e.target).data('aria-expanded', false);
            $('.dropdown-menu').removeClass('open');
        }else{
            $(e.target).data('aria-expanded', true);
            $('.dropdown-menu').addClass('open');
        }
    })

    $('.navbar-toggle').on('click', function (e) {

        if($(e.currentTarget).data('aria-expanded')==true){
            $(e.currentTarget).data('aria-expanded', false);
            $($(e.currentTarget).data('target')).find('li.option').hide();
        }else{
            $(e.currentTarget).data('aria-expanded', true);
            $($(e.currentTarget).data('target')).find('li.option').show();
        }
    })

    //end menu actions
});