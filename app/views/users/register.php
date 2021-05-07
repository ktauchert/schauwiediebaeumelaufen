<?php require APPROOT . '/views/inc/header.php'; ?>
<?php redirect('posts'); ?>
<div class="row d-flex justify-content-center mt-3">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    Ein Konto erstellen
                </h2>
            </div>
            <div class="card-body">
                <p>
                    Bitte füllen Sie die Felder aus, um ein Konto erstellen zu können.
                </p>
                <!-- <form  autocomplete="off" action="<?php echo URLROOT; ?>/users/register" method="post">
                    <div class="form-group">
                        <label for="name">Benutzername</label>
                        <input  autocomplete="off" type="text" name="name" id="name" class="form-control <?php echo (!empty($data['name_error']) ? 'is-invalid' : '') ?>" value="<?php echo $data["name"]; ?>">
                        <span class="invalid-feedback"><?php echo $data["name_error"]; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email-Adresse</label>
                        <input  autocomplete="off" type="email" name="email" id="email" class="form-control <?php echo (!empty($data['email_error']) ? 'is-invalid' : '') ?>" value="<?php echo $data["email"]; ?>">
                        <span class="invalid-feedback"><?php echo $data["email_error"]; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Passwort</label>
                        <input  autocomplete="off" type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_error']) ? 'is-invalid' : '') ?>" value="<?php echo $data["password"]; ?>">
                        <span class="invalid-feedback"><?php echo $data["password_error"]; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Passwort wiederholen</label>
                        <input  autocomplete="off" type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_error']) ? 'is-invalid' : '') ?>" value="<?php echo $data["confirm_password"]; ?>">
                        <span class="invalid-feedback"><?php echo $data["confirm_password_error"]; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Registrieren" class="btn btn-outline-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-link">Schon ein Konto?</a>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>