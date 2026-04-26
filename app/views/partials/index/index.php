        <?php 
        $page_id = null;
        $comp_model = new SharedController;
        ?>
        <div  class=" py-5">
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
                            // Fetch dynamic content
                            $slides = $db->rawQuery("SELECT * FROM slider_images WHERE is_active=1 ORDER BY display_order");
                            $events = $db->rawQuery("SELECT event_title, event_description, event_date, start_time, location FROM events WHERE event_date >= CURDATE() ORDER BY event_date LIMIT 4");
                            $sermons = $db->rawQuery("SELECT title, speaker, sermon_date, audio_url, video_url FROM sermons WHERE is_published=1 ORDER BY sermon_date DESC LIMIT 3");
                            $teachings = $db->rawQuery("SELECT title, content, scripture, publish_date FROM daily_teachings WHERE is_active=1 ORDER BY publish_date DESC LIMIT 3");
                            $gallery = $db->rawQuery("SELECT image_url FROM gallery_images WHERE is_active=1 ORDER BY display_order LIMIT 6");
                            $dailyVerse = $db->rawQuery("SELECT verse, reference FROM bible_verses WHERE display_date >= CURDATE() OR is_active=1 ORDER BY display_date DESC LIMIT 1")[0] ?? null;
                            $settings = $db->rawQuery("SELECT setting_key, setting_value FROM church_settings");
                            $settingsMap = [];
                            foreach ($settings as $s) { $settingsMap[$s['setting_key']] = $s['setting_value']; }
                            ?>
                            <!DOCTYPE html>
                            <html lang="en">
                                <head>
                                    <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                            <title><?php echo htmlspecialchars($settingsMap['church_name'] ?? 'Kangemi Fellowship Church'); ?> – Home</title>
                                            <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                                    <!-- AOS Animation -->
                                                    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
                                                        <style>
                                                            * {
                                                            margin: 0;
                                                            padding: 0;
                                                            box-sizing: border-box;
                                                            }
                                                            body {
                                                            font-family: 'Inter', sans-serif;
                                                            background: #ffffff;
                                                            color: #1e293b;
                                                            }
                                                            /* Navbar with red, navy, white theme */
                                                            .navbar {
                                                            background: #ffffff;
                                                            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
                                                            padding: 1rem 5%;
                                                            display: flex;
                                                            justify-content: space-between;
                                                            align-items: center;
                                                            flex-wrap: wrap;
                                                            position: sticky;
                                                            top: 0;
                                                            z-index: 1000;
                                                            border-bottom: 3px solid #c41e3a;
                                                            }
                                                            .logo {
                                                            font-size: 1.6rem;
                                                            font-weight: 800;
                                                            color: #1e3a8a;
                                                            }
                                                            .logo i {
                                                            color: #c41e3a;
                                                            }
                                                            .nav-links {
                                                            display: flex;
                                                            gap: 1.5rem;
                                                            align-items: center;
                                                            flex-wrap: wrap;
                                                            }
                                                            .nav-links a {
                                                            text-decoration: none;
                                                            color: #1e3a8a;
                                                            font-weight: 500;
                                                            }
                                                            .nav-links a:hover {
                                                            color: #c41e3a;
                                                            }
                                                            .social-links {
                                                            display: flex;
                                                            gap: 1rem;
                                                            }
                                                            .social-links a {
                                                            color: #1e3a8a;
                                                            font-size: 1.2rem;
                                                            }
                                                            .social-links a:hover {
                                                            color: #c41e3a;
                                                            }
                                                            /* Swiper Slider with overlay */
                                                            .swiper {
                                                            width: 100%;
                                                            height: 550px;
                                                            }
                                                            .swiper-slide {
                                                            position: relative;
                                                            background-size: cover;
                                                            background-position: center;
                                                            }
                                                            .slide-overlay {
                                                            position: absolute;
                                                            bottom: 20%;
                                                            left: 10%;
                                                            background: rgba(0,0,0,0.6);
                                                            padding: 1.5rem;
                                                            border-radius: 1rem;
                                                            max-width: 450px;
                                                            color: white;
                                                            backdrop-filter: blur(4px);
                                                            }
                                                            .slide-overlay h2 {
                                                            font-size: 2rem;
                                                            margin-bottom: 0.5rem;
                                                            }
                                                            .btn-primary {
                                                            background: #c41e3a;
                                                            color: white;
                                                            padding: 0.5rem 1.2rem;
                                                            border-radius: 40px;
                                                            text-decoration: none;
                                                            display: inline-block;
                                                            margin-top: 0.5rem;
                                                            border: none;
                                                            cursor: pointer;
                                                            }
                                                            .btn-outline {
                                                            background: transparent;
                                                            border: 1px solid #c41e3a;
                                                            color: #c41e3a;
                                                            padding: 0.5rem 1.2rem;
                                                            border-radius: 40px;
                                                            text-decoration: none;
                                                            }
                                                            /* Bible Verse Banner */
                                                            .verse-banner {
                                                            background: linear-gradient(135deg, #1e3a8a, #c41e3a);
                                                            color: white;
                                                            text-align: center;
                                                            padding: 1rem;
                                                            font-style: italic;
                                                            }
                                                            /* Section titles */
                                                            .section {
                                                            padding: 4rem 5%;
                                                            }
                                                            .section-title {
                                                            font-size: 2rem;
                                                            font-weight: 700;
                                                            text-align: center;
                                                            margin-bottom: 2rem;
                                                            position: relative;
                                                            }
                                                            .section-title:after {
                                                            content: '';
                                                            display: block;
                                                            width: 80px;
                                                            height: 3px;
                                                            background: #c41e3a;
                                                            margin: 0.5rem auto 0;
                                                            }
                                                            /* Cards */
                                                            .cards {
                                                            display: grid;
                                                            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                                                            gap: 2rem;
                                                            }
                                                            .card {
                                                            background: white;
                                                            border-radius: 1rem;
                                                            padding: 1.2rem;
                                                            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
                                                            transition: all 0.3s;
                                                            border: 1px solid #eef2ff;
                                                            }
                                                            .card:hover {
                                                            transform: translateY(-8px);
                                                            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1);
                                                            border-color: #c41e3a30;
                                                            }
                                                            .event-date {
                                                            background: #c41e3a;
                                                            display: inline-block;
                                                            padding: 0.2rem 0.8rem;
                                                            border-radius: 30px;
                                                            color: white;
                                                            font-size: 0.7rem;
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
                                                            transition: transform 0.3s;
                                                            }
                                                            .gallery-grid img:hover {
                                                            transform: scale(1.02);
                                                            }
                                                            /* Modal for prayer */
                                                            .modal {
                                                            display: none;
                                                            position: fixed;
                                                            top: 0;
                                                            left: 0;
                                                            width: 100%;
                                                            height: 100%;
                                                            background: rgba(0,0,0,0.5);
                                                            z-index: 2000;
                                                            align-items: center;
                                                            justify-content: center;
                                                            }
                                                            .modal-content {
                                                            background: white;
                                                            border-radius: 1.5rem;
                                                            padding: 2rem;
                                                            max-width: 500px;
                                                            width: 90%;
                                                            }
                                                            .modal-content input, .modal-content textarea {
                                                            width: 100%;
                                                            padding: 0.7rem;
                                                            margin: 0.5rem 0;
                                                            border: 1px solid #ddd;
                                                            border-radius: 30px;
                                                            }
                                                            /* Counter section */
                                                            .counter-section {
                                                            background: #f8fafc;
                                                            text-align: center;
                                                            padding: 3rem;
                                                            border-radius: 2rem;
                                                            margin: 2rem 0;
                                                            }
                                                            .counter-number {
                                                            font-size: 2.5rem;
                                                            font-weight: 800;
                                                            color: #c41e3a;
                                                            }
                                                            footer {
                                                            background: #1e3a8a;
                                                            color: white;
                                                            text-align: center;
                                                            padding: 2rem;
                                                            margin-top: 2rem;
                                                            }
                                                            @media (max-width: 768px) {
                                                            .navbar { flex-direction: column; gap: 1rem; }
                                                            .swiper { height: 350px; }
                                                            .slide-overlay { bottom: 10%; left: 5%; }
                                                            }
                                                        </style>
                                                    </head>
                                                    <body>
                                                        <!-- Navigation -->
                                                        <div class="navbar">
                                                            <div class="logo"><i class="fas fa-dove"></i> Kangemi Fellowship</div>
                                                            <div class="nav-links">
                                                                <a href="#">Home</a>
                                                                <a href="#sermons">Sermons</a>
                                                                <a href="#events">Events</a>
                                                                <a href="#gallery">Gallery</a>
                                                                <a href="#" id="openPrayerModal">Prayer Request</a>
                                                                <div class="social-links">
                                                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Bible Verse Banner (dynamic) -->
                                                        <div class="verse-banner" data-aos="fade-down">
                                                            <i class="fas fa-bible"></i> <?php echo htmlspecialchars($dailyVerse['verse'] ?? 'Trust in the Lord with all your heart.'); ?> — <strong><?php echo htmlspecialchars($dailyVerse['reference'] ?? 'Proverbs 3:5'); ?></strong>
                                                        </div>
                                                        <!-- Dynamic Slider -->
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
                                                        <!-- Animated Counters (static demo, can be dynamic) -->
                                                        <div class="counter-section" data-aos="zoom-in">
                                                            <div style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap;">
                                                                <div><div class="counter-number" id="membersCount">0</div><div>Members</div></div>
                                                                <div><div class="counter-number" id="sermonsCount">0</div><div>Sermons</div></div>
                                                                <div><div class="counter-number" id="prayersCount">0</div><div>Prayers Answered</div></div>
                                                            </div>
                                                        </div>
                                                        <!-- Latest Sermons -->
                                                        <div class="section" id="sermons" data-aos="fade-up">
                                                            <div class="section-title">📖 Recent Sermons</div>
                                                            <div class="cards">
                                                                <?php foreach ($sermons as $sermon): ?>
                                                                <div class="card">
                                                                    <h3><?php echo htmlspecialchars($sermon['title']); ?></h3>
                                                                    <p><strong><?php echo htmlspecialchars($sermon['speaker']); ?></strong> | <?php echo date('M j, Y', strtotime($sermon['sermon_date'])); ?></p>
                                                                    <?php if ($sermon['audio_url']): ?>
                                                                    <audio controls src="<?php echo htmlspecialchars($sermon['audio_url']); ?>" style="width:100%; margin-top:8px;"></audio>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                        <!-- Events -->
                                                        <div class="section" style="background:#f8fafc;" id="events" data-aos="fade-up">
                                                            <div class="section-title">📅 Upcoming Events</div>
                                                            <div class="cards">
                                                                <?php foreach ($events as $event): ?>
                                                                <div class="card">
                                                                    <div class="event-date"><?php echo date('D, M j', strtotime($event['event_date'])); ?> • <?php echo $event['start_time']; ?></div>
                                                                    <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                                                                    <p><?php echo htmlspecialchars($event['event_description']); ?></p>
                                                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                        <!-- Gallery -->
                                                        <div class="section" id="gallery" data-aos="fade-up">
                                                            <div class="section-title">📸 Our Church Gallery</div>
                                                            <div class="gallery-grid">
                                                                <?php foreach ($gallery as $img): ?>
                                                                <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="Church Gallery">
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                            <!-- Daily Teachings -->
                                                            <div class="section" style="background:#f8fafc;" id="teachings" data-aos="fade-up">
                                                                <div class="section-title">🌿 Daily Teachings</div>
                                                                <div class="cards">
                                                                    <?php foreach ($teachings as $teaching): ?>
                                                                    <div class="card">
                                                                        <h3><?php echo htmlspecialchars($teaching['title']); ?></h3>
                                                                        <p><small><i class="fas fa-bible"></i> <?php echo htmlspecialchars($teaching['scripture']); ?></small></p>
                                                                        <p><?php echo nl2br(htmlspecialchars(substr($teaching['content'],0,100))); ?>...</p>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                            <!-- Prayer Request Modal -->
                                                            <div id="prayerModal" class="modal">
                                                                <div class="modal-content">
                                                                    <h3 style="color:#1e3a8a;"><i class="fas fa-hands-praying"></i> Submit Prayer Request</h3>
                                                                    <form id="prayerForm" action="<?php print_link('prayer_requests/add'); ?>" method="post">
                                                                        <input type="text" name="requester_name" placeholder="Your Name" required>
                                                                            <input type="email" name="requester_email" placeholder="Email">
                                                                                <input type="tel" name="requester_phone" placeholder="Phone Number">
                                                                                    <textarea name="prayer_request" rows="3" placeholder="Share your prayer request..." required></textarea>
                                                                                    <label><input type="checkbox" name="is_anonymous" value="1"> Submit anonymously</label>
                                                                                        <button type="submit" class="btn-primary" style="width:100%; margin-top:1rem;">Send Prayer Request</button>
                                                                                        <button type="button" id="closeModal" style="margin-top:0.5rem; background:#ccc; width:100%; border:none; border-radius:30px; padding:0.5rem;">Cancel</button>
                                                                                    </form>
                                                                                    <div id="prayerMessage" style="margin-top:1rem; text-align:center;"></div>
                                                                                </div>
                                                                            </div>
                                                                            <footer>
                                                                                <p><?php echo htmlspecialchars($settingsMap['church_name'] ?? 'Kangemi Fellowship Church'); ?> | <?php echo htmlspecialchars($settingsMap['church_address'] ?? 'Kangemi, Nairobi, Kenya'); ?></p>
                                                                                <p>📞 <?php echo htmlspecialchars($settingsMap['church_phone'] ?? '+254 700 000 000'); ?> | ✉️ <?php echo htmlspecialchars($settingsMap['church_email'] ?? 'info@kangemifellowship.org'); ?></p>
                                                                                <p>© <?php echo date('Y'); ?> – All Glory to God</p>
                                                                            </footer>
                                                                            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                                                                            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
                                                                            <script>
                                                                                AOS.init({ duration: 800, once: true });
                                                                                // Swiper slider
                                                                                new Swiper('.mySwiper', {
                                                                                loop: true,
                                                                                autoplay: { delay: 5000 },
                                                                                pagination: { el: '.swiper-pagination', clickable: true },
                                                                                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
                                                                                });
                                                                                // Animated counters (simulate counting)
                                                                                function animateCounter(id, target) {
                                                                                let current = 0;
                                                                                const el = document.getElementById(id);
                                                                                const step = Math.ceil(target / 50);
                                                                                const interval = setInterval(() => {
                                                                                current += step;
                                                                                if (current >= target) {
                                                                                el.innerText = target;
                                                                                clearInterval(interval);
                                                                                } else {
                                                                                el.innerText = current;
                                                                                }
                                                                                }, 30);
                                                                                }
                                                                                animateCounter('membersCount', 450);
                                                                                animateCounter('sermonsCount', 128);
                                                                                animateCounter('prayersCount', 342);
                                                                                // Modal logic
                                                                                const modal = document.getElementById('prayerModal');
                                                                                document.getElementById('openPrayerModal').onclick = function(e) {
                                                                                e.preventDefault();
                                                                                modal.style.display = 'flex';
                                                                                }
                                                                                document.getElementById('closeModal').onclick = function() {
                                                                                modal.style.display = 'none';
                                                                                }
                                                                                window.onclick = function(e) {
                                                                                if (e.target == modal) modal.style.display = 'none';
                                                                                }
                                                                                // AJAX prayer form
                                                                                const prayerForm = document.getElementById('prayerForm');
                                                                                prayerForm.addEventListener('submit', async (e) => {
                                                                                e.preventDefault();
                                                                                const formData = new FormData(prayerForm);
                                                                                document.getElementById('prayerMessage').innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Submitting...';
                                                                                const response = await fetch(prayerForm.action, {
                                                                                method: 'POST',
                                                                                body: formData
                                                                                });
                                                                                document.getElementById('prayerMessage').innerHTML = '<span style="color:#c41e3a;">✅ Prayer request sent! We will pray for you.</span>';
                                                                                prayerForm.reset();
                                                                                setTimeout(() => {
                                                                                document.getElementById('prayerMessage').innerHTML = '';
                                                                                modal.style.display = 'none';
                                                                                }, 3000);
                                                                                });
                                                                            </script>
                                                                        </body>
                                                                    </html></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    