<?php
require_once('db_php/create_account.php');
require_once('db_php/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUIES Create Student Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>AUIES</header>
            <h6 style="color:white;">Create Student Account</h6>
            <br>
            <form action="db_php/create_account.php" method="post">
                <!-- <input type="hidden" name="fname">         -->
                <div class="field">
                    <span class="fa fa-id-card"></span>
                    <input type="text" name="id" placeholder="Id" id="id" required>
                </div>
                <div class="field space">
                    <span class="fa fa-user"></span>
                    <input type="text" name="uname" placeholder="User Name" id="uname" required>
                </div>

                <div class=" space">
                    <span class="fa fa-code-branch"></span>
                   
                    <select name="sec" required>
                        <?php
                        
                        $value = "select * from section";
                        $result = mysqli_query($con, $value);
                        while ($row1 = mysqli_fetch_array($result)) :;
                        ?>

                            <option value="<?php echo $row1[1]; ?>"><?php echo $row1[1]; ?></option>
                        <?php endwhile; ?>
                    </select>
                    
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="pass1" placeholder="Password" id="pass" required>
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="pass2" placeholder="Confirm Password" id="pass2" required>
                </div>
                <div class="space">

                    <h6 style="color:white;">Department</h6>

                    <select name="dep" class="se">
                        <?php
                        $value = "select * from department";
                        $result = mysqli_query($con, $value);
                        while ($row1 = mysqli_fetch_array($result)) :;
                        ?>

                            <option value="<?php echo $row1[1]; ?>"><?php echo $row1[1]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>



                <?php
                if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-<?= $_SESSION['msg_type'] ?>" style="background-color:white; margin:10px; color:red;">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </div>
                <?php endif ?>
                <div>
                    <button class="btn btn-dark  space" name="create_student">Create Account</button>
                    <button class="btn btn-dark  space" name="login"><a href="index.php" style="text-decoration: none; color:white;">Login</a></button>
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
