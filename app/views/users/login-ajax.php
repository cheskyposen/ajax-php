<?php require APPROOT . '/views/inc/header.php'; ?>
    <h1 class="text-center"><?php echo $data['title']; ?></h1>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h3 id="msg" class="lead text-center text-primary"></h3>
                <h2>Login</h2>
                <p>Please fill in your credentials to log in</p>
                <form id="ajaxAccount">
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
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="registerAjax" class="btn btn-light btn-block">No account? Register</a>
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

            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            let params = "username="+ username +"&password="+ password;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/exam-april-7/Users/loginAjax', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                console.log(this.response);
                let data = this.response;
                if(data.success){
                    document.getElementById('msg').innerHTML = data.success;
                }
                if(data.username_err){
                    document.getElementById('username').classList.add('is-invalid');
                    document.getElementById('username_err').innerHTML = data.username_err;
                }else { document.getElementById('username').classList.remove('is-invalid'); }
                if(data.password_err){
                    document.getElementById('password').classList.add('is-invalid');
                    document.getElementById('password_err').innerHTML = data.password_err;
                }else { document.getElementById('password').classList.remove('is-invalid'); }
            };

            xhr.send(params);
        }
    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>