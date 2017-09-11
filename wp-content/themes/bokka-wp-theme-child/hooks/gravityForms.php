<?php


add_filter('gform_notification_38', 'add_attachment_pdf', 10, 3); //target form id 2, change to your form id
function add_attachment_pdf($notification, $form, $entry)
{
    //There is no concept of user notifications anymore, so we will need to target notifications based on other criteria,
    //such as name or subject
    if ($notification['name'] == 'User Notification') {
        //get upload root for WordPress

        if (isset($entry[7])) {
            $file = get_field('pdf', $entry[7]);

            $path = get_attached_file($file);

            if (file_exists($path)) {
                error_log(print_r($path, true));
                $notification['attachments']   = rgar($notification, 'attachments', array());
                $notification['attachments'][] = $path;
                GFCommon::log_debug(__METHOD__ . '(): file added to attachments list: ' . print_r($notification['attachments'], 1));
            } else {
                GFCommon::log_debug(__METHOD__ . '(): not attaching; file does not exist.');
            }
        }
    }
    //return altered notification object
    return $notification;
}
