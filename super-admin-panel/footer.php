<!-- footer -->
<div class="container-fluid">
    <div class="footer">
        <p>Copyright © <?= date('Y') ?> Printviu. All rights reserved.</p>
    </div>
</div>
<!-- end dashboard inner -->
</div>
</div>
<!-- jQuery -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/animate.js"></script>
<script src="assets/js/bootstrap-select.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/perfect-scrollbar.min.js"></script>
<script src="assets/js/custom.js"></script>

<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.4.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>


<script>
    $('#dataTable').DataTable();

    $(document).ready(function() {
        $(".remove_btn").click(function(e) {
            $(this).closest(".copydiv").remove();
            e.preventDefault();
        });

        $(".clone_btn").click(function() {
            $(".copydiv:last").clone(true).insertBefore(this);
        });
    });
</script>
</body>

</html>