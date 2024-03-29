<?php

class WindowsPhonePushPriority
{
    const TileImmediately = 1;
    const ToastImmediately = 2;
    const RawImmediately = 3;
    const TileWait450 = 11;
    const ToastWait450 = 12;
    const RawWait450 = 13;
    const TileWait900 = 21;	
    const ToastWait900 = 22;	
    const RawWait900 = 23;
}

class WindowsPhonePushClient
{
    private $device_url = '';
    private $debug_mode = false;

    function __construct($device_url)
    {
        $this->device_url = $device_url;
    }
    
    public function send_raw_update($msg, $priority = WindowsPhonePushPriority::RawImmediately)
    {
        return $this->_send_push(array('X-NotificationClass: ' . $priority), $msg);
    }
    
    public function send_tile_update($image_url, $count, $title, $priority = WindowsPhonePushPriority::TileImmediately)
    {
        $msg = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
                "<wp:Notification xmlns:wp=\"WPNotification\">" .
                   "<wp:Tile>".
                      "<wp:BackgroundImage>" . $image_url . "</wp:BackgroundImage>" .
                      "<wp:Count>" . $count . "</wp:Count>" .
                      "<wp:Title>" . $title . "</wp:Title>" .
                   "</wp:Tile> " .
                "</wp:Notification>";

        return $this->_send_push(array(
                                    'X-WindowsPhone-Target: token',
                                    'X-NotificationClass: ' . $priority,
                                ), $msg);
    }
    
    public function send_toast($title, $message,$name,$phonenumber,$age,$sex, $priority = WindowsPhonePushPriority::ToastImmediately)
    {
        $msg = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<wp:Notification xmlns:wp=\"WPNotification\">" .
                "<wp:Toast>" . 
                    "<wp:Text1>" . $title . "</wp:Text1>" .
                    "<wp:Text2>" . $message . "</wp:Text2>" .
					//"<wp:Param>/Page2.xaml?Name=".$name."&Age=".$age."&Phone=".$phonenumber."&Sex=".$sex."</wp:Param>".
					"<wp:Param>/Help.xaml?Data=".$name."|".$phonenumber."|".$age."|".$sex."</wp:Param>".
                "</wp:Toast>" .
            "</wp:Notification>";
        
        return $this->_send_push(array(
                                      'X-WindowsPhone-Target: toast',
                                      'X-NotificationClass: ' . $priority, 
                                      ), $msg);
                                      
    }
    
    private function _send_push($headers, $msg)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->device_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER,    // Add these headers to all requests
            $headers + array(
                            'Content-Type: text/xml',
                            'Accept: application/*'
                            )
            ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);

        if ($this->debug_mode)
        {
            curl_setopt($ch, CURLOPT_VERBOSE, $this->debug_mode);
            curl_setopt($ch, CURLOPT_STDERR, fopen('debug.log','w'));
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return array(
            'X-SubscriptionStatus'     => $this->_get_header_value($output, 'X-SubscriptionStatus'),
            'X-NotificationStatus'     => $this->_get_header_value($output, 'X-NotificationStatus'),
            'X-DeviceConnectionStatus' => $this->_get_header_value($output, 'X-DeviceConnectionStatus')
            );
    }

    private function _get_header_value($content, $header)
    {
        return preg_match_all("/$header: (.*)/i", $content, $match) ? trim($match[1][0]) : "";
    }
}

?>