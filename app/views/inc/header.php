<!doctype html>
<html lang="de">

<head>
    <title><?php echo SITENAME; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo URLROOT; ?>/images/img/favicon-32x32-1.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    <!-- Custom css -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>

<body>

    <header class="page-header">
        <img src="<?php echo URLROOT; ?>/images/img/landing-page-header-top-1980-1.jpg" alt="Hintergrund top" width="100%">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
            <a class="navbar-brand" href="<?php echo URLROOT; ?>">
                <?php echo SITENAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <!-- Use  URL instead or route -->
                        <a class="nav-link" href="<?php echo URLROOT; ?>/posts">Blog</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php if(isset($_SESSION["user_id"])): ?>
                        <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo $_SESSION["user_name"] ; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo URLROOT ?>/users/logout" onclick="">
                                Abmelden
                            </a>
                        </div>
                    </li>
                    <?php else : ?> 
                        <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Anmeldung</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Registrierung</a>
                    </li> -->
                    <?php endif ; ?>
                    
                </ul>
            </div>
            </div>
        </nav>
        <img src="<?php echo URLROOT; ?>/images/img/header-bottom-1980.jpg" alt="Hintergrund top" class="fluid" width="100%">
    </header>
    <main class="container">