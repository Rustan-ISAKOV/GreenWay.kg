"use strict";
jQuery(document).ready(function(){
    var confirmDeactivationLink = jQuery(".hugeit-deactivate-plugin"),
        cancelDeactivationLink = jQuery(".hugeit-cancel-deactivation"),
        deactivationURL;


    jQuery('body').on('click','#the-list tr[data-slug='+hugeitGalleryVideoL10n.slug+'] .deactivate a',function(e){
        e.preventDefault();

        hugeitModal.show(hugeitGalleryVideoL10n.slug+'-deactivation-feedback');
        deactivationURL = jQuery(this).attr('href');

        return false;
    });

    confirmDeactivationLink.on('click',function(e){
        e.preventDefault();

        var checkedOption = jQuery('input[name='+hugeitGalleryVideoL10n.slug+'-deactivation-reason]:checked'),
            comment = jQuery('textarea[name='+hugeitGalleryVideoL10n.slug+'-deactivation-comment]').val(),
            nonce = jQuery('#hugeit-gallery-video-deactivation-nonce').val();
        if(checkedOption.length || comment.length){
            hugeitModal.hide(hugeitGalleryVideoL10n.slug+'-deactivation-feedback');
            sendDeactivationFeedback(checkedOption.val(),comment,nonce);
            setTimeout(function(){
                window.location.replace(deactivationURL);
            },0);
        }else{
            hugeitModal.hide(hugeitGalleryVideoL10n.slug+'-deactivation-feedback');
            window.location.replace(deactivationURL);
        }

        return false;
    });

    cancelDeactivationLink.on('click',function(e){
        e.preventDefault();

        hugeitModal.hide(hugeitGalleryVideoL10n.slug+'-deactivation-feedback');

        return false;
    });

    function sendDeactivationFeedback(v,c,n){
        jQuery.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'hugeit_video_gallery_deactivation_feedback',
                value:v,
                comment:c,
                nonce:n
            }
        });
    }
});