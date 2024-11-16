
window.addEventListener('scroll', function() {
  var header = document.querySelector('.tp-navigation');


  if (window.scrollY > 2) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});


  $(".submitForm").on("click", function () {
    var _this = $(this);
    var targetForm = _this.closest('form');
    var errroTarget = targetForm.find('.response');
    var check = checkRequire(targetForm, errroTarget);
  
    if (check == 0) {
      var formDetail = new FormData(targetForm[0]);
      formDetail.append('form_type', _this.attr('form-type'));
      $.ajax({
        method: 'post',
        url: 'ajaxmail.php',
        data: formDetail,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (resp) {
        console.log(resp);
        if (resp == 1) {
          targetForm.find('input').val('');
          targetForm.find('textarea').val('');
          errroTarget.html('<p style="color:white;">Mail has been sent successfully.</p>');
        } else {
          errroTarget.html('<p style="color:white;">Something went wrong please try again latter.</p>');
        }
      });
    }
  });

  function toggleMenu() {
    var menu = document.getElementById('navMenu');
    menu.classList.toggle('show'); 
    }
    
    function toggleMenu() {
      var drawer = document.getElementById('drawer');
      
      var mainLogo = document.getElementById('mainLogo');
      var logoName = document.getElementById('logoName');
      var slogan = document.getElementById('slogan');
  
      // Toggle drawer and overlay visibility
      drawer.classList.toggle('show');
      mainLogo.classList.toggle('small');
      logoName.classList.toggle('small');
      
      if (slogan.style.display === 'none' || slogan.style.display === '') {
        slogan.style.display = 'block';
    } else {
        slogan.style.display = 'none';
    }
}
  
  
    




