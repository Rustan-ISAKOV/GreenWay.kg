<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$license = array(
    array(
        "title" => "Load More And Pagination",
        "text" => "This feature will allow to demonstrate only a part of your created videos, hiding the rest of them under “load more” button, 
or dividing all your projects into several pages.",
        "icon" => "-250px -465px"
    ),
    array(
        "title" => "Custom URL For Each Video",
        "text" => "When adding a Video to gallery, you can add a clickable link from it to a specific page or URL.",
        "icon" => "-335px -465px"
    ),
    array(
        "title" => "Advanced View Customization",
        "text" => "Unlock all the settings of gallery views, allowing to edit and customize the views, size, effects, buttons, navigation tools, colors and more.",
        "icon" => "-26px -290px"
    ),
    array(
        "title" => "Full Video Configuration",
        "text" => "Unlock the advanced configuration settings, so that you could use the plugin fully, configure all the corners of videos to your taste.",
        "icon" => "-132px -295px"
    ),
    array(
        "title" => "Video Resizer Settings",
        "text" => "Unlock the options allowing to play around videos, thumbs and edit all the corners of media using advanced resizer settings",
        "icon" => "-229px -286px"
    ),
    array(
        "title" => "Color and Text Styling",
        "text" => "Unlock more options allowing to edit, add or customize every text and color of the plugin with multiple solutions",
        "icon" => "-315px -286px"
    ),
    array(
        "title" => "YouTube Videos",
        "text" => "Video Gallery can be used with the most popular video site -YouTube, Simply copy the link and add it to the Video Gallery gallery will bring the video in it.",
        "icon" => "-25px -386px"
    ),
    array(
        "title" => "Lightbox Views Library",
        "text" => "Some view types of our wonderful Gallery uses quite new designed Lightbox/Popup tool and additional 6 Styles for it",
        "icon" => "-141px -383px"
    ),
    array(
        "title" => "Advanced Lightbox Options",
        "text" => "2 Type of Lightbox with tons of social sharing options, zooming, framing, navigation and sliding effects will make users love the plugin.",
        "icon" => "-243px -394px"
    ),
    array(
        "title" => "Video slideshow",
        "text" => "Showcase Videos in Stunning Slideshows with advanced options, styles and effects",
        "icon" => "-335px -387px"
    ),
    array(
        "title" => "vimeo Videos",
        "text" => "The other source of adding videos in Video Gallery- Vimeo. Turn your gallery into Vimeo Gallery using your collection of vimeo videos.",
        "icon" => "-411px -320px"
    )
);
?>


<div class="responsive grid">
    <?php foreach ($license as $key => $val) { ?>
        <div class="col column_1_of_3">
            <div class="header">
                <div class="col-icon" style="background-position: <?php echo $val["icon"]; ?>; ">
                </div>
                <?php echo $val["title"]; ?>
            </div>
            <p><?php echo $val["text"]; ?></p>
            <div class="col-footer">
                <a href="http://huge-it.com/wordpress-video-gallery/" class="a-upgrate">Upgrade</a>
            </div>
        </div>
    <?php } ?>
</div>


<div class="license-footer">
    <p class="footer-text">
        You are using the Lite version of the Video Gallery Plugin for WordPress. If you want to get more awesome
        options,
        advanced features, settings to customize every area of the plugin, then check out the Full License plugin.
        The full version of the plugin is available in 3 different packages of one-time payment.
    </p>
    <p class="this-steps max-width">
        After the purchasing the commercial version follow this steps
    </p>
    <ul class="steps">
        <li>Deactivate Huge IT Video Gallery Plugin</li>
        <li>Delete Huge IT Video Gallery</li>
        <li>Install the downloaded commercial version of the plugin</li>
    </ul>
    <a href="http://huge-it.com/wordpress-video-gallery/" target="_blank">Purchase a License</a>
</div>
