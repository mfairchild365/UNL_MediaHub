<?php 
/**
 * @var $context UNL_MediaHub_DefaultHomepage
 */

$baseUrl = UNL_MediaHub_Controller::getURL();
?>
<div class="wdn-band">
    <div class="mh-search-container">
        <div class="mh-search-image">
            <div id="video-container">
                <video id="video-player" preload="metadata" autoplay="autoplay" loop="" class="fillWidth">
                    <source src="http://admissions.unl.edu/includes/videos/why-unl/why-unl.mp4" type="video/mp4">
                    <source src="http://admissions.unl.edu/includes/videos/why-unl/why-unl.webm" type="video/webm">
                    <source src="http://admissions.unl.edu/includes/videos/why-unl/why-unl.ogg" type="video/ogg">
                    Your browser does not support the video tag. I suggest you upgrade your browser.
                </video>
            </div>
        </div>
        <div class="mh-search">
            <div id="wdn_app_search">
                <div class="wdn-inner-wrapper wdn-inner-padding-sm ">
                    <form method="get" action="<?php echo $baseUrl ?>search/">
                        <label for="q_app">Search MediaHub</label>
                        <div class="wdn-input-group">
                            <input id="q_app" name="q" type="text" required />
                            <span class="wdn-input-group-btn ">
                                <input type="submit" class="search_submit_button" value="Go" />
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wdn-band">
    <div class="wdn-inner-wrapper">
        <div class="bp2-wdn-grid-set-thirds wdn-center">
            <div class="wdn-col mh-featured">
                <a href="<?php echo $baseUrl ?>manager/">
                    <div class="mh-featured-icon centered mh-red">
                        <object type="image/svg+xml" data="<?php echo $baseUrl; ?>/templates/html/css/images/gear-icon.svg"><img src="<?php echo $baseUrl; ?>/templates/html/css/images/gear-icon-white.png" alt=""></object>
                    </div>
                    <h2 class="wdn-brand">Manage Media</h2>
                </a>
                <p>
                    MediaHub is a reliable host for all your audio and video needs. Look professional with the University of Nebraska brand and go places YouTube can’t (like China and K-12 schools). 
                </p>
            </div>
            <div class="wdn-col mh-featured">
                <a href="<?php echo $baseUrl ?>search/">
                    <div class="mh-featured-icon centered mh-green">
                        <object type="image/svg+xml" data="<?php echo $baseUrl; ?>/templates/html/css/images/play-icon.svg"><img src="<?php echo $baseUrl; ?>/templates/html/css/images/play-icon-white.png" alt=""></object>
                    </div>
                    <h2 class="wdn-brand">Browse Media</h2>
                </a>
                <p>
                    Browse MediaHub and find what’s happening at the University of Nebraska – Lincoln. You’ll find documentaries, symphonies, and everything in between. 
                </p>
            </div>
            <div class="wdn-col mh-featured">
                <a href="<?php echo $baseUrl ?>channels/">
                    <div class="mh-featured-icon centered mh-blue">
                        <object type="image/svg+xml" data="<?php echo $baseUrl; ?>/templates/html/css/images/channel-icon.svg"><img src="<?php echo $baseUrl; ?>/templates/html/css/images/channel-icon-white.png" alt=""></object>
                    </div>
                    <h2 class="wdn-brand">Explore Channels</h2>
                </a>
                <p>
                    Channels are a great way to group your media. Make a channel to suite your needs be it a podcast or drafting class. Be sure to check out what other great channels have been collecting videos. 
                </p>
            </div>

        </div>
    </div>
</div>

<div class="wdn-band wdn-light-neutral-band">
    <div class="wdn-inner-wrapper">
        <h2 class="wdn-brand wdn-center">
            <span class="wdn-subhead">Latest Videos</span>
        </h2>
        <div class="bp2-wdn-grid-set-thirds">
            <?php foreach ($context->latest_media->items as $media): ?>
                <div class="wdn-col">
                    <?php echo $savvy->render($media, 'Media/teaser.tpl.php'); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">

    var vid = document.getElementById("video-player"); // run main video at half speed
    vid.playbackRate = 0.25;


</script>