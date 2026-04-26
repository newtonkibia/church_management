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
            <div class="container">
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
                            $settings = $db->rawQuery("SELECT setting_key, setting_value FROM church_settings");
                            $settingsMap = [];
                            foreach ($settings as $s) {
                            $settingsMap[$s['setting_key']] = $s['setting_value'];
                            }
                            $galleryImages = $db->rawQuery("SELECT image_url FROM gallery_images ORDER BY display_order LIMIT 6"); // if you create gallery table; fallback placeholder
                            ?>
                            <!DOCTYPE html>
                            <html lang="en">
                                <head>
                                    <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
                                            <title><?php echo htmlspecialchars($settingsMap['church_name'] ?? 'Our Church'); ?> – Home</title>
                                            <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                                    <style>
                                                        * {
                                                        margin: 0;
                                                        padding: 0;
                                                        box-sizing: border-box;
                                                        }
                                                        body {
                                                        font-family: 'Inter', sans-serif;
                                                        background: #fef9f0;
                                                        color: #2d1f12;
                                                        }
                                                        /* Navbar */
                                                        .navbar {
                                                        background: #fff8f0;
                                                        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
                                                        padding: 1rem 5%;
                                                        display: flex;
                                                        justify-content: space-between;
                                                        align-items: center;
                                                        flex-wrap: wrap;
                                                        position: sticky;
                                                        top:0;
                                                        z-index: 100;
                                                        }
                                                        .logo {
                                                        font-size: 1.6rem;
                                                        font-weight: 800;
                                                        background: linear-gradient(135deg, #b87333, #d4a373);
                                                        -webkit-background-clip: text;
                                                        background-clip: text;
                                                        color: transparent;
                                                        }
                                                        .nav-links {
                                                        display: flex;
                                                        gap: 1.5rem;
                                                        align-items: center;
                                                        flex-wrap: wrap;
                                                        }
                                                        .nav-links a {
                                                        text-decoration: none;
                                                        color: #5c3a21;
                                                        font-weight: 500;
                                                        }
                                                        .social-links {
                                                        display: flex;
                                                        gap: 1rem;
                                                        }
                                                        .social-links a {
                                                        color: #b87333;
                                                        font-size: 1.2rem;
                                                        }
                                                        /* Swiper slider */
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
                                                        background: rgba(0,0,0,0.5);
                                                        padding: 1.5rem;
                                                        border-radius: 1rem;
                                                        max-width: 500px;
                                                        color: white;
                                                        }
                                                        .slide-overlay h2 {
                                                        font-size: 2rem;
                                                        margin-bottom: 0.5rem;
                                                        }
                                                        .slide-overlay .btn {
                                                        background: #b87333;
                                                        color: white;
                                                        padding: 0.5rem 1.2rem;
                                                        border-radius: 40px;
                                                        text-decoration: none;
                                                        display: inline-block;
                                                        margin-top: 0.5rem;
                                                        }
                                                        /* Sections */
                                                        .section {
                                                        padding: 4rem 5%;
                                                        }
                                                        .section-title {
                                                        font-size: 2rem;
                                                        color: #b87333;
                                                        margin-bottom: 2rem;
                                                        text-align: center;
                                                        }
                                                        .cards {
                                                        display: grid;
                                                        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                                                        gap: 2rem;
                                                        }
                                                        .card {
                                                        background: white;
                                                        border-radius: 1rem;
                                                        padding: 1.2rem;
                                                        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
                                                        transition: transform 0.2s;
                                                        }
                                                        .card:hover {
                                                        transform: translateY(-5px);
                                                        }
                                                        .event-date {
                                                        background: #b87333;
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
                                                        }
                                                        .prayer-form {
                                                        background: #fff4ec;
                                                        border-radius: 2rem;
                                                        padding: 2rem;
                                                        max-width: 600px;
                                                        margin: 0 auto;
                                                        }
                                                        .prayer-form input, .prayer-form textarea {
                                                        width: 100%;
                                                        padding: 0.7rem;
                                                        margin: 0.5rem 0;
                                                        border: 1px solid #e2c6aa;
                                                        border-radius: 30px;
                                                        background: white;
                                                        }
                                                        footer {
                                                        background: #2d1f12;
                                                        color: #d4c0a8;
                                                        padding: 2rem;
                                                        text-align: center;
                                                        }
                                                        @media (max-width: 768px) {
                                                        .navbar { flex-direction: column; gap: 1rem; }
                                                        .swiper { height: 350px; }
                                                        }
                                                    </style>
                                                </head>
                                                <body>
                                                    <!-- Navbar -->
                                                    <div class="navbar">
                                                        <div class="logo"><i class="fas fa-church"></i> <?php echo htmlspecialchars($settingsMap['church_name'] ?? 'Gospel Light Church'); ?></div>
                                                        <div class="nav-links">
                                                            <a href="#">Home</a>
                                                            <a href="#sermons">Sermons</a>
                                                            <a href="#events">Events</a>
                                                            <a href="#gallery">Gallery</a>
                                                            <a href="#prayer">Prayer</a>
                                                            <div class="social-links">
                                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                                <a href="#"><i class="fab fa-youtube"></i></a>
                                                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Dynamic Slider -->
                                                    <div class="swiper mySwiper">
                                                        <div class="swiper-wrapper">
                                                            <?php foreach ($slides as $slide): ?>
                                                            <div class="swiper-slide" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('<?php echo htmlspecialchars($slide['image_url']); ?>'); background-size: cover;">
                                                                <div class="slide-overlay">
                                                                    <h2><?php echo htmlspecialchars($slide['title']); ?></h2>
                                                                    <p><?php echo htmlspecialchars($slide['subtitle']); ?></p>
                                                                    <?php if ($slide['button_text']): ?>
                                                                    <a href="<?php echo htmlspecialchars($slide['button_link']); ?>" class="btn"><?php echo htmlspecialchars($slide['button_text']); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div class="swiper-pagination"></div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                                    <!-- Latest Sermons -->
                                                    <div class="section" id="sermons">
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
                                                    <div class="section" style="background:#fff4ec;" id="events">
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
                                                    <!-- Gallery (placeholder – create gallery_images table) -->
                                                    <div class="section" id="gallery">
                                                        <div class="section-title">📸 Photo Gallery</div>
                                                        <div class="gallery-grid">
                                                            <?php if (!empty($galleryImages)): ?>
                                                            <?php foreach ($galleryImages as $img): ?>
                                                            <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="Gallery">
                                                                <?php endforeach; ?>
                                                                <?php else: ?>
                                                                <img src="https://placehold.co/400x300/e2c6aa/5c3a21?text=Church+Event" alt="Gallery placeholder">
                                                                    <img src="https://placehold.co/400x300/e2c6aa/5c3a21?text=Worship" alt="Gallery placeholder">
                                                                        <img src="https://placehold.co/400x300/e2c6aa/5c3a21?text=Fellowship" alt="Gallery placeholder">
                                                                            <img src="https://placehold.co/400x300/e2c6aa/5c3a21?text=Community" alt="Gallery placeholder">
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Daily Teachings -->
                                                                        <div class="section" style="background:#fff4ec;" id="teachings">
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
                                                                        <!-- Prayer Request Form -->
                                                                        <div class="section" id="prayer">
                                                                            <div class="section-title">🙏 Prayer Request</div>
                                                                            <div class="prayer-form">
                                                                                <form id="prayerForm" action="<?php print_link('prayer_requests/add'); ?>" method="post">
                                                                                    <input type="text" name="requester_name" placeholder="Your Name" required>
                                                                                        <input type="email" name="requester_email" placeholder="Email">
                                                                                            <input type="tel" name="requester_phone" placeholder="Phone Number">
                                                                                                <textarea name="prayer_request" rows="3" placeholder="Share your prayer request..." required></textarea>
                                                                                                <label><input type="checkbox" name="is_anonymous" value="1"> Submit anonymously</label>
                                                                                                    <button type="submit" class="btn" style="background:#b87333; border:none; width:100%; margin-top:1rem;">Send Prayer Request</button>
                                                                                                </form>
                                                                                                <div id="prayerMessage" style="margin-top:1rem; text-align:center;"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <footer>
                                                                                            <p><?php echo htmlspecialchars($settingsMap['church_name'] ?? 'Gospel Light Church'); ?> | <?php echo htmlspecialchars($settingsMap['church_address'] ?? 'Nairobi, Kenya'); ?></p>
                                                                                            <p>📞 <?php echo htmlspecialchars($settingsMap['church_phone'] ?? '+254 700 000 000'); ?> | ✉️ <?php echo htmlspecialchars($settingsMap['church_email'] ?? 'info@church.org'); ?></p>
                                                                                            <p>© <?php echo date('Y'); ?> – All Rights Reserved</p>
                                                                                        </footer>
                                                                                        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                                                                                        <script>
                                                                                            var swiper = new Swiper('.mySwiper', {
                                                                                            loop: true,
                                                                                            autoplay: { delay: 5000 },
                                                                                            pagination: { el: '.swiper-pagination', clickable: true },
                                                                                            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
                                                                                            });
                                                                                            // AJAX prayer request submission
                                                                                            const prayerForm = document.getElementById('prayerForm');
                                                                                            prayerForm.addEventListener('submit', async (e) => {
                                                                                            e.preventDefault();
                                                                                            const formData = new FormData(prayerForm);
                                                                                            document.getElementById('prayerMessage').innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Submitting...';
                                                                                            const response = await fetch(prayerForm.action, {
                                                                                            method: 'POST',
                                                                                            body: formData
                                                                                            });
                                                                                            const result = await response.text();
                                                                                            document.getElementById('prayerMessage').innerHTML = '<span style="color:#b87333;">✅ Prayer request sent! We will pray for you.</span>';
                                                                                            prayerForm.reset();
                                                                                            setTimeout(() => document.getElementById('prayerMessage').innerHTML = '', 5000);
                                                                                            });
                                                                                        </script>
                                                                                    </body>
                                                                                </html>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            