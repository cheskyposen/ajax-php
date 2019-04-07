<?php require APPROOT . '/views/inc/header.php'; ?>
    <h1 class="text-center"><?php echo $data['title']; ?></h1>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register with us</p>
                <form id="ajaxAccount" action="" method="post">
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback" id="name_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Age: <sup>*</sup></label>
                        <input type="text" id="age" name="age" class="form-control form-control-lg" value="<?php echo $data['age']; ?>">
                        <span class="invalid-feedback" id="age_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback" id="email"></span>
                    </div>
                    <div class="form-group">
                        <label for="username">Username: <sup>*</sup></label>
                        <input type="text" id="username" name="username" class="form-control form-control-lg" value="<?php echo $data['username']; ?>">
                        <span class="invalid-feedback" id="username_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback" id="password_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback" id="confirm_password_err"></span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="login" class="btn btn-light btn-block">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('ajaxAccount').addEventListener('submit', postName);

        function postName(e){
            e.preventDefault();

            let name = document.getElementById('name').value;
            let age = document.getElementById('age').value;
            let email = document.getElementById('email').value;
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirm_password').value;
            let params = "name="+ name + "&age="+ age + "&email="+ email +"&username="+ username +"&password="+ password +"&confirm_password="+ confirmPassword;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/exam-april-7/Users/registerAjax', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                console.log(this.response);
                response = this.response;
                console.log(response);
                // if(response.name_err){
                //     document.getElementById('name').classList.add('is-invalid');
                //     document.getElementById('name_err').innerText = response.name_err;
                // }
                // if(response.age_err){
                //     document.getElementById('age').classList.add('is-invalid');
                //     document.getElementById('age_err').innerText = response.age_err;
                // }
                // if(response.username_err){
                //     document.getElementById('username').classList.add('is-invalid');
                //     document.getElementById('username_err').innerText = response.username_err;
                // }
                // if(response.password_err){
                //     document.getElementById('password').classList.add('is-invalid');
                //     document.getElementById('password_err').innerText = response.password_err;
                // }
                // if(response.confirm_password_err){
                //     document.getElementById('confirm_password').classList.add('is-invalid');
                //     document.getElementById('confirm_password_err').innerText = response.confirm_password_err;
                // }
            };

            xhr.send(params);
        }

    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>