$('document').ready(function(){
    //menu actions

    //mark main menu options as selected
    //this will take no effect after adding the other pages,
    // since this actions will be done by redirect with a page refresh
    $('.navbar-nav>li.option').on('click', function (e) {
        $('.navbar-nav>li').removeClass('selected');
        $(e.currentTarget).addClass('selected');
    });

    //toggle user account menu when user icon is clicked
    $('.dropdown-toggle').on('click', function (e) {

        if($(e.target).data('aria-expanded')==true){
            $(e.target).data('aria-expanded', false);
            $('.dropdown-menu').removeClass('open');
        }else{
            $(e.target).data('aria-expanded', true);
            $('.dropdown-menu').addClass('open');
        }
    })

    // toggle main menu on mobile rezolution, when clicking on menu icon
    $('.navbar-toggle').on('click', function (e) {
        if($(e.currentTarget).data('aria-expanded')==true){
            $(e.currentTarget).data('aria-expanded', false);
            $($(e.currentTarget).data('target')).find('li.option').hide();
        }else{
            $(e.currentTarget).data('aria-expanded', true);
            $($(e.currentTarget).data('target')).find('li.option').show();
        }
    });

    //when sliding from mobile rezolution, make sure the main menu is displayed
    $(window).resize(function(){
        if($(window).width() >= 982 && $('.navbar-toggle').css('display') == 'none'){
            $('.nav.navbar-nav li.option').show();
        }
    });
    //end menu actions
	
	//form validation
	$('form').on('submit', function(e){
		event.preventDefault();
		$.each($(e.target).find('.fieldset.required'), function(index, el){
			if($(el).find('input').length && !$(el).find('input').val()){
				$(el).append("<p class='error'>* This is a required field</p>");
			}
		})
	})
});