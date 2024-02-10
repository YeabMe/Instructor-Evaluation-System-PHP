<?php
require_once('db_php/process.php');
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUIES Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>AUIES</header>
            <form action="db_php/process.php" method="post">
                <input type="hidden" name="fname">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="uname" placeholder="User Name" id="uname">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="pass" placeholder="Password" id="id_password">
                    <span><i class="far fa-eye" id="togglePassword"></i></span>
                </div>


                <div class="re">
                    <div class="space">

                        <!-- <h6 style="color:white;">Login As</h6> -->
                        <label for="as">Login As</label>
                        <select name="as" class="se" id="as">
                            <option value="Admin">Admin</option>
                            <option value="Head">Head</option>
                            <option value="Student">Student</option>
                            
                            
                        </select>


                    </div>


                </div>
                <button class="btn btn-info  space" name="login" style="color:white;"><b>Login</b></button>

                <?php
                if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-<?= $_SESSION['msg_type'] ?>" style="background-color:white;">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </div>
                <?php endif ?>

                <div>
                    <!--<button class="btn btn-dark btn-sm space" name="login"><a href="create_head.php" style="text-decoration: none; color:white;">Create Head</a></button>
                    <button class="btn btn-dark btn-sm space" name="login"><a href="create_instructor.php" style="text-decoration: none; color:white;">Create Instructor</a></button>-->
                    <button class="btn btn-dark btn-sm space" name="login"><a href="create_student.php" style="text-decoration: none; color:white;">Create Student</a></button>
                </div>


            </form>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- for password show and hide -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>



</body>

</html>
