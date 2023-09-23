$(document).ready(function() {

  const engFields = $('.eng-fields');
  const azFields = $('.az-fields');

  $('.eng-button').click(function() { 
    $(this).toggleClass('clicked');
    $('.az-button').removeClass('clicked');
    engFields.show();
    azFields.hide();
  });

  $('.az-button').click(function() { 
    $(this).toggleClass('clicked');
    $('.eng-button').removeClass('clicked');
    azFields.show();
    engFields.hide();
  });

  });


$(document).ready(function(){
  // Get current page URL
  var url = window.location.href;

  // Remove trailing slash if present
  if(url.substr(-1) === '/') {
    url = url.substr(0, url.length - 1);
  }

  // Get last segment of URL (after last '/')
  var activePage = url.substr(url.lastIndexOf('/') + 1);

  // Add active class to corresponding menu item
  $('.nav-link').each(function(){
    var linkPage = this.href.substr(this.href.lastIndexOf('/') + 1);

    if (activePage == linkPage) {
      $(this).addClass('active');
    }
  });

  // Click event for menu items
  $('.nav-link').click(function(){
    // Remove active class from all menu items
    $('.nav-link').removeClass('active');

    // Add active class to clicked menu item
    $(this).addClass('active');
  });
});


// $(document).ready(function() {

    
//     // set default language
//     var language = "english";
    
//     // set input pattern based on language
//     function setInputPattern(language) {
    
//       var pattern;
//       if (language === "azerbaijani") {
//         $('label[for="firstName"]').text('Ad');
//         $('label[for="lastName"]').text('Soyad');
//         $('label[for="aboutMe"]').text('Haqqımda');
//         pattern = "[a-zA-ZəƏöÖüÜğĞçÇşŞıİ]+";
//       } else {
//         $('label[for="firstName"]').text('First Name');
//         $('label[for="lastName"]').text('Last Name');
//         $('label[for="aboutMe"]').text('About Me');
//         pattern = "[a-zA-Z\s]+";
//       }
//       $("#firstName, #lastName").attr("pattern", pattern);
//       $("#aboutMe").attr("pattern", pattern.replace(/\s/g, ""));
//     }
    
//     // set input pattern on page load
//     setInputPattern(language);
    
//     // change language on button click
//     $(".az-button").click(function() {
    
//       $(this).toggleClass('clicked');
//       $('.eng-button').removeClass('clicked');
//       language = "azerbaijani";
//       setInputPattern(language);
//     });
    
//     $(".eng-button").click(function() {
//       $(this).toggleClass('clicked');
//       $('.az-button').removeClass('clicked');
//       language = "english";
//       setInputPattern(language);
//     });
    
//     // validate input on form submit
//     $("form").submit(function() {
//       var firstName = $("#firstName").val();
//       var lastName = $("#lastName").val();
//       var aboutMe = $("#aboutMe").val();
//       var pattern;
//       if (language === "azerbaijani") {
//         pattern = /^[a-zA-ZəƏöÖüÜğĞçÇşŞıİ]+$/;
//       } else {
//         pattern = /^[a-zA-Z\s]+$/;
//       }
//       if (!pattern.test(firstName)) {
//         $("#firstNameError").show();
//         return false;
//       }
//       if (!pattern.test(lastName)) {
//         $("#lastNameError").show();
//         return false;
//       }
//       if (!pattern.test(aboutMe)) {
//         $("#aboutMeError").show();
//         return false;
//       }
//     });
//     });