        <?php 
        $page_id = null;
        $comp_model = new SharedController;
        ?>
        <div  class=" py-0">
            <div class="d-none">
                <div class="row ">
                    <div class="col-md-8 comp-grid">
                        <div class="">
                            <div class="fadeIn animated mb-4">
                                <div class="text-capitalize">
                                    <h2 class="text-capitalize">Welcome To <?php echo SITE_NAME ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        
                        <div  class="bg-light p-3 animated fadeIn page-content">
                            <div>
                                <h4><i class="fa fa-key"></i> User Login</h4>
                                <hr />
                                <?php 
                                $this :: display_page_errors(); 
                                ?>
                                <form name="loginForm" action="<?php print_link('index/login/?csrf_token=' . Csrf::$token); ?>" class="needs-validation form page-form" method="post">
                                    <div class="input-group form-group">
                                        <input placeholder="Username Or Email" name="username"  required="required" class="form-control" type="text"  />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="form-control-feedback fa fa-user"></i></span>
                                        </div>
                                    </div>
                                    <div class="input-group form-group">
                                        <input  placeholder="Password" required="required" v-model="user.password" name="password" class="form-control " type="password" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="form-control-feedback fa fa-key"></i></span>
                                        </div>
                                    </div>
                                    <div class="row clearfix mt-3 mb-3">
                                        <div class="col-6">
                                            <label class="">
                                                <input value="true" type="checkbox" name="rememberme" />
                                                Remember Me
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <a href="<?php print_link('passwordmanager') ?>" class="text-danger"> Reset Password?</a>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary btn-block btn-md" type="submit"> 
                                            <i class="load-indicator">
                                                <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                                            </i>
                                            Login <i class="fa fa-key"></i>
                                        </button>
                                    </div>
                                    <hr />
                                    <div class="text-center">
                                        Don't Have an Account? <a href="<?php print_link("index/register") ?>" class="btn btn-success">Register
                                        <i class="fa fa-user"></i></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="">
            <div class="">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <div class=""><?php
                            $comp_model = new SharedController;
                            $db = $comp_model->GetModel();
                            // Fetch all same dynamic data (no changes)
                            $slides = $db->rawQuery("SELECT * FROM slider_images WHERE is_active=1 ORDER BY display_order");
                            $events = $db->rawQuery("SELECT event_title, event_description, event_date, start_time, location FROM events WHERE event_date >= CURDATE() ORDER BY event_date LIMIT 4");
                            $sermons = $db->rawQuery("SELECT title, speaker, sermon_date, audio_url, video_url FROM sermons WHERE is_published=1 ORDER BY sermon_date DESC LIMIT 3");
                            $teachings = $db->rawQuery("SELECT title, content, scripture, publish_date FROM daily_teachings WHERE is_active=1 ORDER BY publish_date DESC LIMIT 3");
                            $gallery = $db->rawQuery("SELECT image_url FROM gallery_images WHERE is_active=1 ORDER BY display_order LIMIT 6");
                            $dailyVerse = $db->rawQuery("SELECT verse, reference FROM bible_verses WHERE display_date >= CURDATE() OR is_active=1 ORDER BY display_date DESC LIMIT 1")[0] ?? null;
                            $settings = $db->rawQuery("SELECT setting_key, setting_value FROM church_settings");
                            $settingsMap = [];
                            foreach ($settings as $s) { $settingsMap[$s['setting_key']] = $s['setting_value']; }
                            $now = new DateTime();
                            $nextSunday = new DateTime('next Sunday 10:00:00');
                            $interval = $now->diff($nextSunday);
                            ?>
                            <!DOCTYPE html>
                            <html lang="en">
                                <head>
                                    <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title>THE GRACE TABERNACLE – Home</title>
                                            <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                                    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
                                                        <style>
                                                            * {
                                                            margin: 0;
                                                            padding: 0;
                                                            box-sizing: border-box;
                                                            }
                                                            body {
                                                            font-family: 'Inter', sans-serif;
                                                            background: #0f1123;
                                                            color: #1e1e2f;
                                                            overflow-x: hidden;
                                                            }
                                                            /* Animated gradient blobs background */
                                                            .animated-bg {
                                                            position: fixed;
                                                            top: 0;
                                                            left: 0;
                                                            width: 100%;
                                                            height: 100%;
                                                            z-index: -2;
                                                            overflow: hidden;
                                                            }
                                                            .blob {
                                                            position: absolute;
                                                            width: 70vmax;
                                                            height: 70vmax;
                                                            border-radius: 50%;
                                                            filter: blur(90px);
                                                            opacity: 0.5;
                                                            animation: floatBlob 20s infinite alternate ease-in-out;
                                                            }
                                                            .blob1 {
                                                            background: radial-gradient(circle, #28368E, #1a2368);
                                                            top: -20%;
                                                            left: -30%;
                                                            animation-duration: 25s;
                                                            }
                                                            .blob2 {
                                                            background: radial-gradient(circle, #B0303E, #7a202a);
                                                            bottom: -20%;
                                                            right: -30%;
                                                            animation-duration: 30s;
                                                            animation-delay: -5s;
                                                            }
                                                            .blob3 {
                                                            background: radial-gradient(circle, #28368E, #B0303E);
                                                            top: 50%;
                                                            left: 50%;
                                                            width: 50vmax;
                                                            height: 50vmax;
                                                            animation-duration: 22s;
                                                            animation-delay: -10s;
                                                            opacity: 0.3;
                                                            }
                                                            @keyframes floatBlob {
                                                            0% { transform: translate(0, 0) scale(1); }
                                                            100% { transform: translate(5%, 8%) scale(1.1); }
                                                            }
                                                            /* Glass navbar */
                                                            .navbar {
                                                            background: rgba(255,255,255,0.12);
                                                            backdrop-filter: blur(15px);
                                                            border-bottom: 1px solid rgba(255,255,255,0.2);
                                                            padding: 0.8rem 5%;
                                                            display: flex;
                                                            justify-content: space-between;
                                                            align-items: center;
                                                            flex-wrap: wrap;
                                                            position: sticky;
                                                            top: 0;
                                                            z-index: 1000;
                                                            }
                                                            .logo {
                                                            font-size: 1.5rem;
                                                            font-weight: 800;
                                                            color: white;
                                                            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
                                                            }
                                                            .logo i { color: #B0303E; margin-right: 5px; }
                                                            .nav-links a {
                                                            color: white;
                                                            text-decoration: none;
                                                            font-weight: 500;
                                                            margin-left: 1.5rem;
                                                            transition: 0.2s;
                                                            }
                                                            .nav-links a:hover { color: #B0303E; }
                                                            .social-links a {
                                                            color: white;
                                                            margin-left: 1rem;
                                                            font-size: 1.2rem;
                                                            }
                                                            /* Swiper slider */
                                                            .swiper {
                                                            width: 100%;
                                                            height: 560px;
                                                            margin-top: 1rem;
                                                            }
                                                            .swiper-slide {
                                                            position: relative;
                                                            background-size: cover;
                                                            background-position: center;
                                                            border-radius: 2rem;
                                                            overflow: hidden;
                                                            }
                                                            .slide-overlay {
                                                            position: absolute;
                                                            bottom: 15%;
                                                            left: 8%;
                                                            background: rgba(0,0,0,0.4);
                                                            backdrop-filter: blur(12px);
                                                            padding: 1.5rem;
                                                            border-radius: 1.5rem;
                                                            max-width: 450px;
                                                            color: white;
                                                            border-left: 4px solid #B0303E;
                                                            }
                                                            .btn-primary {
                                                            background: #B0303E;
                                                            color: white;
                                                            padding: 0.5rem 1.5rem;
                                                            border-radius: 40px;
                                                            text-decoration: none;
                                                            display: inline-block;
                                                            margin-top: 0.5rem;
                                                            transition: 0.2s;
                                                            }
                                                            .btn-primary:hover {
                                                            background: #28368E;
                                                            transform: translateY(-2px);
                                                            }
                                                            /* Bible verse banner (glass) */
                                                            .verse-banner {
                                                            background: rgba(40,54,142,0.65);
                                                            backdrop-filter: blur(12px);
                                                            color: white;
                                                            text-align: center;
                                                            padding: 1rem;
                                                            font-style: italic;
                                                            font-size: 1rem;
                                                            margin: 1rem 5%;
                                                            border-radius: 60px;
                                                            border: 1px solid rgba(255,255,255,0.2);
                                                            }
                                                            /* Glass cards */
                                                            .glass-card {
                                                            background: rgba(255,255,255,0.1);
                                                            backdrop-filter: blur(12px);
                                                            border-radius: 1.5rem;
                                                            padding: 1.5rem;
                                                            box-shadow: 0 20px 35px -12px rgba(0,0,0,0.2);
                                                            transition: all 0.3s;
                                                            border: 1px solid rgba(255,255,255,0.2);
                                                            color: white;
                                                            }
                                                            .glass-card:hover {
                                                            transform: translateY(-8px);
                                                            border-color: #B0303E;
                                                            box-shadow: 0 25px 40px -12px rgba(176,48,62,0.3);
                                                            }
                                                            .glass-card h3, .glass-card p { color: white; }
                                                            .glass-card audio { width: 100%; margin-top: 10px; border-radius: 30px; }
                                                            .section {
                                                            padding: 4rem 5%;
                                                            }
                                                            .section-title {
                                                            font-size: 2rem;
                                                            font-weight: 700;
                                                            text-align: center;
                                                            margin-bottom: 2rem;
                                                            color: white;
                                                            position: relative;
                                                            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
                                                            }
                                                            .section-title:after {
                                                            content: '';
                                                            display: block;
                                                            width: 80px;
                                                            height: 3px;
                                                            background: #B0303E;
                                                            margin: 0.5rem auto 0;
                                                            }
                                                            .cards {
                                                            display: grid;
                                                            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                                                            gap: 2rem;
                                                            }
                                                            .event-date {
                                                            background: #B0303E;
                                                            display: inline-block;
                                                            padding: 0.2rem 0.8rem;
                                                            border-radius: 30px;
                                                            font-size: 0.7rem;
                                                            margin-bottom: 0.5rem;
                                                            }
                                                            .gallery-grid {
                                                            display: grid;
                                                            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                                                            gap: 1rem;
                                                            }
                                                            .gallery-grid img {
                                                            width: 100%;
                                                            height: 180px;
                                                            object-fit: cover;
                                                            border-radius: 1rem;
                                                            transition: transform 0.3s, filter 0.3s;
                                                            filter: brightness(0.8);
                                                            }
                                                            .gallery-grid img:hover {
                                                            transform: scale(1.02);
                                                            filter: brightness(1);
                                                            }
                                                            .countdown-section {
                                                            background: rgba(0,0,0,0.3);
                                                            backdrop-filter: blur(12px);
                                                            border-radius: 2rem;
                                                            padding: 2rem;
                                                            text-align: center;
                                                            margin: 2rem 5%;
                                                            border: 1px solid rgba(255,255,255,0.2);
                                                            }
                                                            .countdown-numbers {
                                                            display: flex;
                                                            justify-content: center;
                                                            gap: 1.5rem;
                                                            flex-wrap: wrap;
                                                            margin-top: 1rem;
                                                            }
                                                            .countdown-box {
                                                            background: rgba(0,0,0,0.4);
                                                            backdrop-filter: blur(4px);
                                                            border-radius: 1rem;
                                                            padding: 0.8rem;
                                                            min-width: 80px;
                                                            color: white;
                                                            }
                                                            .modal {
                                                            display: none;
                                                            position: fixed;
                                                            top: 0;
                                                            left: 0;
                                                            width: 100%;
                                                            height: 100%;
                                                            background: rgba(0,0,0,0.7);
                                                            backdrop-filter: blur(8px);
                                                            z-index: 2000;
                                                            align-items: center;
                                                            justify-content: center;
                                                            }
                                                            .modal-content {
                                                            background: rgba(255,255,255,0.95);
                                                            backdrop-filter: blur(16px);
                                                            border-radius: 1.5rem;
                                                            padding: 2rem;
                                                            max-width: 500px;
                                                            width: 90%;
                                                            color: #1e1e2f;
                                                            }
                                                            footer {
                                                            background: rgba(40,54,142,0.8);
                                                            backdrop-filter: blur(8px);
                                                            color: white;
                                                            text-align: center;
                                                            padding: 2rem;
                                                            margin-top: 2rem;
                                                            }
                                                            @media (max-width: 768px) {
                                                            .navbar { flex-direction: column; gap: 0.5rem; }
                                                            .swiper { height: 380px; }
                                                            .slide-overlay { bottom: 10%; left: 5%; right: 5%; max-width: 90%; }
                                                            }
                                                        </style>
                                                    </head>
                                                    <body>
                                                        <div class="animated-bg">
                                                            <div class="blob blob1"></div>
                                                            <div class="blob blob2"></div>
                                                            <div class="blob blob3"></div>
                                                        </div>
                                                        <div class="navbar">
                                                            <div class="logo"><i class="fas fa-church"></i> THE GRACE TABERNACLE</div>
                                                            <div class="nav-links">
                                                                <a href="#">Home</a>
                                                                <a href="#sermons">Sermons</a>
                                                                <a href="#events">Events</a>
                                                                <a href="#gallery">Gallery</a>
                                                                <a href="#" id="openPrayerModal">Prayer</a>
                                                                <div class="social-links">
                                                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="verse-banner" id="verseBanner">
                                                            <i class="fas fa-bible"></i> <span id="verseText"><?php echo htmlspecialchars($dailyVerse['verse'] ?? 'Trust in the Lord with all your heart.'); ?></span> — <strong id="verseRef"><?php echo htmlspecialchars($dailyVerse['reference'] ?? 'Proverbs 3:5'); ?></strong>
                                                        </div>
                                                        <div class="swiper mySwiper" data-aos="fade-up">
                                                            <div class="swiper-wrapper">
                                                                <?php foreach ($slides as $slide): ?>
                                                                <div class="swiper-slide" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('<?php echo htmlspecialchars($slide['image_url']); ?>'); background-size: cover;">
                                                                    <div class="slide-overlay">
                                                                        <h2><?php echo htmlspecialchars($slide['title']); ?></h2>
                                                                        <p><?php echo htmlspecialchars($slide['subtitle']); ?></p>
                                                                        <?php if ($slide['button_text']): ?>
                                                                        <a href="<?php echo htmlspecialchars($slide['button_link']); ?>" class="btn-primary"><?php echo htmlspecialchars($slide['button_text']); ?></a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <div class="swiper-pagination"></div>
                                                            <div class="swiper-button-next"></div>
                                                            <div class="swiper-button-prev"></div>
                                                        </div>
                                                        <div class="countdown-section" data-aos="zoom-in">
                                                            <h3 style="color:white;">⏰ Next Service in</h3>
                                                            <div class="countdown-numbers">
                                                                <div class="countdown-box"><span id="days">0</span><br>Days</div>
                                                                    <div class="countdown-box"><span id="hours">0</span><br>Hours</div>
                                                                        <div class="countdown-box"><span id="minutes">0</span><br>Minutes</div>
                                                                            <div class="countdown-box"><span id="seconds">0</span><br>Seconds</div>
                                                                            </div>
                                                                            <div class="mt-3"><small>Sunday Worship 10:00 AM</small></div>
                                                                        </div>
                                                                        <div class="section" id="sermons" data-aos="fade-up">
                                                                            <div class="section-title">📖 Recent Sermons</div>
                                                                            <div class="cards">
                                                                                <?php foreach ($sermons as $sermon): ?>
                                                                                <div class="glass-card">
                                                                                    <h3><?php echo htmlspecialchars($sermon['title']); ?></h3>
                                                                                    <p><strong><?php echo htmlspecialchars($sermon['speaker']); ?></strong> | <?php echo date('M j, Y', strtotime($sermon['sermon_date'])); ?></p>
                                                                                    <?php if ($sermon['audio_url']): ?>
                                                                                    <audio controls src="<?php echo htmlspecialchars($sermon['audio_url']); ?>"></audio>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="section" id="events" data-aos="fade-up">
                                                                            <div class="section-title">📅 Upcoming Events</div>
                                                                            <div class="cards">
                                                                                <?php foreach ($events as $event): ?>
                                                                                <div class="glass-card">
                                                                                    <div class="event-date"><?php echo date('D, M j', strtotime($event['event_date'])); ?> • <?php echo $event['start_time']; ?></div>
                                                                                    <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                                                                                    <p><?php echo htmlspecialchars($event['event_description']); ?></p>
                                                                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                                                                                </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="section" id="gallery" data-aos="fade-up">
                                                                            <div class="section-title">📸 Our Gallery</div>
                                                                            <div class="gallery-grid">
                                                                                <?php foreach ($gallery as $img): ?>
                                                                                <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="Gallery">
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="section" data-aos="fade-up">
                                                                                <div class="section-title">🌿 Daily Teachings</div>
                                                                                <div class="cards">
                                                                                    <?php foreach ($teachings as $teaching): ?>
                                                                                    <div class="glass-card">
                                                                                        <h3><?php echo htmlspecialchars($teaching['title']); ?></h3>
                                                                                        <p><small><i class="fas fa-bible"></i> <?php echo htmlspecialchars($teaching['scripture']); ?></small></p>
                                                                                        <p><?php echo nl2br(htmlspecialchars(substr($teaching['content'],0,100))); ?>...</p>
                                                                                    </div>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            </div>
                                                                            <div id="prayerModal" class="modal">
                                                                                <div class="modal-content">
                                                                                    <h3 style="color:#28368E;"><i class="fas fa-hands-praying"></i> Submit Prayer Request</h3>
                                                                                    <form id="prayerForm" action="<?php print_link('prayer_requests/add'); ?>" method="post">
                                                                                        <input type="text" name="requester_name" placeholder="Your Name" required>
                                                                                            <input type="email" name="requester_email" placeholder="Email">
                                                                                                <input type="tel" name="requester_phone" placeholder="Phone">
                                                                                                    <textarea name="prayer_request" rows="3" placeholder="Share your prayer request..." required></textarea>
                                                                                                    <label><input type="checkbox" name="is_anonymous" value="1"> Submit anonymously</label>
                                                                                                        <button type="submit" class="btn-primary">Send Prayer Request</button>
                                                                                                        <button type="button" id="closeModal">Cancel</button>
                                                                                                    </form>
                                                                                                    <div id="prayerMessage" style="margin-top:1rem;"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <footer>
                                                                                                <p><strong>THE GRACE TABERNACLE</strong> – <?php echo htmlspecialchars($settingsMap['church_address'] ?? 'Kangemi, Nairobi, Kenya'); ?></p>
                                                                                                <p>📞 <?php echo htmlspecialchars($settingsMap['church_phone'] ?? '+254 712 345 678'); ?> | ✉️ <?php echo htmlspecialchars($settingsMap['church_email'] ?? 'info@grace-tabernacle.org'); ?></p>
                                                                                                <p><small><?php echo htmlspecialchars($settingsMap['service_times'] ?? 'Sunday 10:00 AM | Wednesday 6:00 PM | Friday 5:00 PM'); ?></small></p>
                                                                                                <p>© <?php echo date('Y'); ?> – All Glory to God</p>
                                                                                            </footer>
                                                                                            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                                                                                            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
                                                                                            <script>
                                                                                                AOS.init({ duration: 800, once: true });
                                                                                                new Swiper('.mySwiper', {
                                                                                                loop: true,
                                                                                                autoplay: { delay: 5000 },
                                                                                                pagination: { el: '.swiper-pagination', clickable: true },
                                                                                                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
                                                                                                });
                                                                                                function updateCountdown() {
                                                                                                const now = new Date();
                                                                                                const nextSunday = new Date();
                                                                                                nextSunday.setDate(now.getDate() + ((7 - now.getDay()) % 7));
                                                                                                nextSunday.setHours(10, 0, 0, 0);
                                                                                                if (now > nextSunday) nextSunday.setDate(nextSunday.getDate() + 7);
                                                                                                const diff = nextSunday - now;
                                                                                                document.getElementById('days').innerText = Math.floor(diff / (1000 * 60 * 60 * 24));
                                                                                                document.getElementById('hours').innerText = Math.floor((diff % 86400000) / 3600000);
                                                                                                document.getElementById('minutes').innerText = Math.floor((diff % 3600000) / 60000);
                                                                                                document.getElementById('seconds').innerText = Math.floor((diff % 60000) / 1000);
                                                                                                }
                                                                                                setInterval(updateCountdown, 1000);
                                                                                                updateCountdown();
                                                                                                const verses = [
                                                                                                { text: "For God so loved the world that he gave his one and only Son", ref: "John 3:16" },
                                                                                                { text: "I can do all things through Christ who strengthens me", ref: "Philippians 4:13" },
                                                                                                { text: "The Lord is my shepherd; I shall not want", ref: "Psalm 23:1" }
                                                                                                ];
                                                                                                let idx = 0;
                                                                                                setInterval(() => {
                                                                                                idx = (idx + 1) % verses.length;
                                                                                                document.getElementById('verseText').innerText = verses[idx].text;
                                                                                                document.getElementById('verseRef').innerText = verses[idx].ref;
                                                                                                }, 7000);
                                                                                                const modal = document.getElementById('prayerModal');
                                                                                                document.getElementById('openPrayerModal').onclick = (e) => { e.preventDefault(); modal.style.display = 'flex'; };
                                                                                                document.getElementById('closeModal').onclick = () => modal.style.display = 'none';
                                                                                                window.onclick = (e) => { if (e.target == modal) modal.style.display = 'none'; };
                                                                                                const prayerForm = document.getElementById('prayerForm');
                                                                                                prayerForm.addEventListener('submit', async (e) => {
                                                                                                e.preventDefault();
                                                                                                const formData = new FormData(prayerForm);
                                                                                                document.getElementById('prayerMessage').innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Submitting...';
                                                                                                await fetch(prayerForm.action, { method: 'POST', body: formData });
                                                                                                document.getElementById('prayerMessage').innerHTML = '<span style="color:#28368E;">✅ Prayer request sent! We will pray for you.</span>';
                                                                                                prayerForm.reset();
                                                                                                setTimeout(() => { document.getElementById('prayerMessage').innerHTML = ''; modal.style.display = 'none'; }, 3000);
                                                                                                });
                                                                                            </script>
                                                                                        </body>
                                                                                    </html></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    