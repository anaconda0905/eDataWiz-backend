$('.faq-wrapper .faq-title').on('click', function (e) {
  
    var element = $(this).parent('.faq-item');
    if (element.hasClass('open')) {
      element.removeClass('open');
      element.find('.faq-content').removeClass('open');
      element.find('.faq-content').slideUp(300, "swing");
    } else {
      element.addClass('open');
      element.children('.faq-content').slideDown(300, "swing");
      element.siblings('.faq-item').children('.faq-content').slideUp(300, "swing");
      element.siblings('.faq-item').removeClass('open');
      element.siblings('.faq-item').find('.faq-title').removeClass('open');
      element.siblings('.taq-item').find('.faq-content').slideUp(300, "swing");
    }
  });

  $('.faq-wrapper--style .faq-title').on('click', function (e) {
    var element = $(this).parent('.faq-item--style');
    if (element.hasClass('open')) {
      element.removeClass('open');
      element.find('.faq-content--style').removeClass('open');
      element.find('.faq-content--style').slideUp(300, "swing");
    } else {
      element.addClass('open');
      element.children('.faq-content--style').slideDown(300, "swing");
      element.siblings('.faq-item--style').children('.faq-content--style').slideUp(300, "swing");
      element.siblings('.faq-item--style').removeClass('open');
      element.siblings('.faq-item--style').find('.faq-title').removeClass('open');
      element.siblings('.taq-item--style').find('.faq-content--style').slideUp(300, "swing");
    }
  });