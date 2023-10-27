 <!-- Back to Top -->
 <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


 <!-- JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 <script src="<?= base_url('assets/lib/easing/easing.min.js') ?>"></script>
 <script src="<?= base_url('assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Template Javascript -->
 <script src="<?= base_url('assets/js/main.js') ?>"></script>


 <script>
     $(function() {
         $('[data-toggle="tooltip"]').tooltip();
         $('.backlogin').on('click',function(){
            $('#forgetmodal').modal('hide');
            // $('#loginmodal').modal('show');
         });
         $('.forpass').on('click',function(){
            $('#loginmodal').modal('hide');
            // $('#forgetmodal').modal('show');
         })
     })
     $('.headcart').load("<?= base_url('countcarts'); ?>");
     $('#userform').on('submit', function(event) {
         event.preventDefault();
         $.ajax({
             type: "POST",
             url: "<?= base_url('logins') ?>",
             dataType: "json",
             data: $(this).serialize(),
             beforeSend: function() {
                 $(".status").html("Please wait...");
             },
             success: function(data) {
                 if ($.isEmptyObject(data.error)) {
                     $(".print-error-msg").css('display', 'none');
                     $("#userform")[0].reset();
                     location.reload();
                     // $('#login-modal').modal('hide');
                 } else {
                     $(".print-error-msg").css('display', 'block');
                     $(".print-error-msg").html(data.error);
                 }
             }
         });
     });
     // Subscribe Form
     $('#subscribesform').on('submit', function(event) {
         event.preventDefault();
         $.ajax({
             type: "POST",
             url: "<?= base_url('logins') ?>",
             dataType: "json",
             data: $(this).serialize(),
             beforeSend: function() {
                 $(".sbstatus").html("Please wait...");
             },
             success: function(data) {
                 if ($.isEmptyObject(data.error)) {
                     $("#subscribesform")[0].reset();
                     $(".sbstatus").removeClass('text-warning');
                     $(".sbstatus").addClass('text-success');
                     $(".sbstatus").html(data.message);

                 } else {
                     $(".sbstatus").removeClass('text-success');
                     $(".sbstatus").addClass('text-warning');
                     $(".sbstatus").html(data.error);
                 }
             }
         });

     });
     $('#forgetform').on('submit', function(event) {
         event.preventDefault();
         $.ajax({
             type: "POST",
             url: "<?= base_url('logins') ?>",
             dataType: "json",
             data: $(this).serialize(),
             beforeSend: function() {
                 $(".fgstatus").html("Please wait...");
             },
             success: function(data) {
                 if ($.isEmptyObject(data.error)) {
                     $("#forgetform")[0].reset();
                     $(".fgstatus").removeClass('text-danger');
                     $(".fgstatus").addClass('text-success');
                     $(".fgstatus").html(data.success);
                     $('#forgetmodal').modal('hide');
                     $('#loginmodal').modal('show');

                 } else {
                     $(".fgstatus").removeClass('text-success');
                     $(".fgstatus").addClass('text-danger');
                     $(".fgstatus").html(data.error);
                 }
             }
         });

     });
 </script>