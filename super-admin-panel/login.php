<?php require_once 'header.php'; ?>
<div class="container">
    <div class="center verticle_center full_height">
        <div class="login_section">
            <div class="logo_login">
                <div class="center">
                    <img width="300" src="https://www.printviu.in/logofinal.png" alt="#" />
                </div>
            </div>
            <div class="login_form text-center">
                <form method="POST" id="logform" enctype="multipart/form-data">
                    <span class="text-danger mb-2 mx-auto" id="status"></span>
                    <fieldset>
                        <div class="field">
                            <label class="label_field" for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" />
                            <span id="username_error" class="field_error text-danger d-block"></span>
                        </div>
                        <div class="field">
                            <label class="label_field" for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" />
                            <span id="password_error" class="field_error text-danger d-block"></span>
                        </div>
                        <div class="field margin_0">
                            <label class="label_field hidden">hidden label</label>
                            <input type="hidden" name="userlogin" value="starlogin">
                            <button class="main_bt" type="submit">Log In</button>
                        </div>
                    </fieldset>
                    <span id="result" class="text-danger mt-4 d-block text-center"></span>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#logform').on('submit', function(event) {
            event.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "backend/login_queries.php",
                type: "POST",
                //data:  new FormData(this),
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#status").html("Processing...");
                    $(".main_bt").html("Please wait...");
                    $(".main_bt").attr('disabled', 'true');
                },
                success: function(data) {
                    // alert(data);
                    $("#status").html(data);
                    $('.main_bt').removeAttr('disabled');
                    $(".main_bt").html("submit");
                }
            });
        });
    });
</script>
<?php require_once 'footer.php' ?>