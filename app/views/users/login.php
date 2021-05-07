<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row d-flex justify-content-center mt-3">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    Melde Dich an
                </h2>
            </div>
            <div class="card-body">
                <?php flash('register_success'); ?>
                <?php flash('login_error'); ?>
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                    <div class="form-group">
                        <label for="email">Email-Adresse</label>
                        <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['email_error']) ? 'is-invalid' : '') ?>" value="<?php echo $data["email"]; ?>">
                        <span class="invalid-feedback"><?php echo $data["email_error"]; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Passwort</label>
                        <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_error']) ? 'is-invalid' : '') ?>" value="<?php echo $data["password"]; ?>">
                        <span class="invalid-feedback"><?php echo $data["password_error"]; ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Anmelden" class="btn btn-outline-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-link">Noch kein Konto?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>