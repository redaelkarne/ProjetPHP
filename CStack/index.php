<?php

require('dbconfig.php');
require('controllers/indexController.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/ico" href="assets/img/BDE.ico">
    <title>BEEDE ESGI</title>

    <!--swiper css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!--css file-->
    <link rel="stylesheet" href="assets/css/index.css" />
</head>

<body>
    <!-- header section starts  -->
    <header class="header">
        <a href="https://www.esgi.fr/?utm_source=google&gclid=EAIaIQobChMIpbmE39O-hAMVcktBAh0QIgNpEAAYASAAEgKtPvD_BwE&CampaignId=19138589207&AdGroupId=143773678923&feeditemid&targetid=dsa-1927164171016&loc_interest_ms&loc_physical_ms=9056011&matchtype&network=g&device=c&devicemodel&creative=639267132668&keyword&placement&target&adposition&utm_medium=search&gad_source=1" class="logo"><span>B</span>DE <span>E</span>SGI</a>

        <nav class="navbar">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="submit" name="submit_connexion" value="Log in">
                <input type="submit" name="submit_inscription" value="Sign in">
            </form>
        </nav>

        <div id="menu-bars" class="fas fa-bars"></div>
    </header>

    <!-- home section starts  -->
    <section class="home" id="home">
        <div class="content">
            <h3>
                Découvrez Nos Événements, La Vie Étudiante à Son Meilleur !
        </div>

        <div class="swiper-container home-slider">
        <div class="swiper-wrapper">
            <?php
            require('views/indexEvents.php');
            ?>
        </div>
        </div>
    </section>

    <!-- service section starts  -->
    <section class="service" id="service">
        <h1 class="heading">Nos <span>services</span></h1>

        <div class="box-container">
            <div class="box">
                <i class="fas fa-music"></i>
                <h3>Événements Sociaux et Culturels</h3>
                <p>
                    Organisation de soirées à thème, de sorties culturelles,
                    de rencontres inter-associatives, de festivals étudiants
                    et d'autres événements pour favoriser la convivialité et les échanges entre les étudiants.
                </p>
            </div>

            <div class="box">
                <i class="fa-solid fa-school"></i>
                <h3>Soutien Académique</h3>
                <p>
                    Mise en place de tutorats entre étudiants, séances de révision en groupe,
                    partage de ressources pédagogiques, et organisation de conférences ou de
                    workshops pour aider les étudiants dans leur parcours académique.
                </p>
            </div>

            <div class="box">
                <i class="fa-solid fa-heart"></i>
                <h3>Activités Sportives</h3>
                <p>
                    Organisation de tournois sportifs intra-écoles ou inter-écoles,
                    propositions d'activités sportives régulières, accès à des installations
                    sportives, et promotion d'un mode de vie sain et actif.
                </p>
            </div>

            <div class="box">
                <i class="fa-solid fa-user-tie"></i>
                <h3>Orientation Professionnelle</h3>
                <p>
                    Organisation de rencontres avec des professionnels du secteur,
                    ateliers sur la rédaction de CV et de lettres de motivation,
                    simulations d'entretiens d'embauche, et accompagnement dans la recherche
                    de stages ou d'emplois.
                </p>
            </div>

            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Engagement Communautaire</h3>
                <p>
                    Proposition de projets solidaires et humanitaires,
                    participation à des actions de volontariat, sensibilisation
                    à des causes sociales ou environnementales, et implication
                    dans la vie associative locale.
                </p>
            </div>

            <div class="box">
                <i class="fa-solid fa-percent"></i>
                <h3>Avantages et Réductions</h3>
                <p>
                    Négociation de partenariats avec des commerçants locaux
                    pour offrir des réductions exclusives aux membres du BDE,
                    organisation de ventes groupées ou de promotions spéciales,
                    et proposition d'avantages sur des services étudiants (transports, logement, etc.).
                </p>
            </div>
        </div>
    </section>

    <!-- about section starts  -->
    <section class="about" id="about">
        <h1 class="heading"><span>A propos</span> de nous</h1>

        <div class="row">
            <div class="image">
                <img src="assets/img/LOGO-BDE.png" alt="" />
            </div>

            <div class="content">
                <h3>Rejoignez la Communauté Vibrante du BDE ESGI Lyon</h3>
                <p>
                    Le Bureau des Élèves de l'ESGI Lyon est bien plus qu'une simple organisation étudiante.
                    Nous sommes une communauté dynamique et diversifiée, dédiée à enrichir
                    l'expérience étudiante à travers des événements passionnants, des activités stimulantes
                    et un soutien mutuel. Notre mission est de créer un environnement inclusif où chaque
                    membre peut s'épanouir, se développer et créer des liens durables.
                    Rejoignez-nous et découvrez tout ce que le BDE de l'ESGI Lyon a à offrir !
                </p>
            </div>
        </div>
    </section>

    <!-- gallery section starts  -->
    <section class="gallery" id="gallery">
        <h1 class="heading">Notre <span>gallerie</span></h1>

        <div class="box-container">
            <div class="box">
                <img src="assets/img/gallery20.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery21.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery60.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery40.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery24.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery30.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery26.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery8.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>

            <div class="box">
                <img src="assets/img/gallery70.jpg" alt="" />
                <h3 class="title">best events</h3>
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- review section starts  -->
    <section class="reivew" id="review">
        <h1 class="heading"><span>Avis </span>des étudiants</h1>

        <div class="review-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="assets/img/img1.jpg" alt="" />
                        <div class="user-info">
                            <h3>nayana</h3>
                            <span>happy customer</span>
                        </div>
                    </div>
                    <p>
                        Les événements du BDE sont toujours incroyables !
                        J'ai récemment assisté à leur soirée à thème sur les années 80,
                        et c'était vraiment génial. L'ambiance était électrique, la musique
                        était parfaite et j'ai rencontré tellement de nouvelles personnes.
                        Merci au BDE pour ces moments inoubliables ! 🎉🎶😊
                    </p>
                </div>

                <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="assets/img/img2.jpg" alt="" />
                        <div class="user-info">
                            <h3>lisa</h3>
                            <span>happy customer</span>
                        </div>
                    </div>
                    <p>
                        Je suis impressionné par la diversité des événements proposés par le BDE. Des soirées festives aux séances de cinéma en passant par les tournois sportifs, il y en a vraiment pour tous les goûts. C'est super de voir à quel point le BDE travaille dur pour offrir une expérience étudiante aussi riche et variée. 👏🎬⚽
                    </p>
                </div>

                <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="assets/img/img3.jpg" alt="" />
                        <div class="user-info">
                            <h3>mary</h3>
                            <span>happy customer</span>
                        </div>
                    </div>
                    <p>
                        Je suis membre du BDE depuis deux ans maintenant, et je suis toujours aussi impressionnée par leur dévouement et leur créativité. Les événements qu'ils organisent sont non seulement amusants, mais aussi bien pensés. C'est grâce au BDE que je me sens vraiment intégrée à la vie étudiante de l'ESGI Lyon. 🌟🎨👩‍🎓
                    </p>
                </div>

                <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                        <img src="assets/img/img4.jpg" alt="" />
                        <div class="user-info">
                            <h3>rose</h3>
                            <span>happy customer</span>
                        </div>
                    </div>
                    <p>
                        Les événements du BDE sont définitivement le point fort de ma vie étudiante pour décompresser après une semaine chargée de cours, je sais que je peux toujours compter sur le BDE pour organiser quelque chose d'amusant et d'excitant. Leur engagement envers la communauté étudiante est vraiment admirable. 🚀🤩👍
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section starts  -->
    <section class="contact" id="contact">
        <h1 class="heading"><span>contactez</span> nous</h1>

        <form action="">
            <div class="inputBox">
                <input type="text" placeholder="name" />
                <input type="email" placeholder="email" />
            </div>
            <div class="inputBox">
                <input type="tel" placeholder="number" />
                <input type="text" placeholder="subject" />
            </div>
            <textarea name="" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn" />
        </form>
    </section>

    <!-- footer section starts  -->
    <section class="footer">
        <div class="box-container">

            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
                <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
                <a href="#"> <i class="fas fa-envelope"></i> bde.esgi.lyon@gmail.com </a>
                <a href="https://www.google.com/maps/place/Esgi+Lyon/@45.747715,4.8630703,17z/data=!3m2!4b1!5s0x47f4ea7417fcad57:0x98f8c96bd46b1fa5!4m6!3m5!1s0x47f4eb1c2122df87:0x54ca4bb005f16197!8m2!3d45.7477113!4d4.8656452!16s%2Fg%2F11fqv15bkv?entry=ttu">
                    <i class="fas fa-map-marker-alt"></i> Esgi Lyon, 53 Cr Albert Thomas, Lyon

                </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="https://www.facebook.com/bdeinfo.lyon/"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="https://www.instagram.com/beede.lyon/"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-linkedin-in"></i> linkedin </a>
            </div>
        </div>

        <div class="credit">
            created by <span>Us</span> | all rights reserved
        </div>
    </section>

    <!-- theme toggler  -->
    <div class="theme-toggler">
        <div class="toggle-btn">
            <i class="fas fa-cog"></i>
        </div>

        <h3>choose color</h3>

        <div class="buttons">
            <div class="theme-btn" style="background: #ccff33"></div>
            <div class="theme-btn" style="background: #d35400"></div>
            <div class="theme-btn" style="background: #f39c12"></div>
            <div class="theme-btn" style="background: #1abc9c"></div>
            <div class="theme-btn" style="background: #3498db"></div>
            <div class="theme-btn" style="background: #9b59b6"></div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!--JS file-->
    <script src="assets/js/app.js"></script>
</body>

</html>