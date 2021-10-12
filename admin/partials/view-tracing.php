<?php

/**
 * JNE View: Tracing
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/NHidayat/
 * @since      1.0.0
 *
 * @package    Jne_Tracing
 * @subpackage Jne_Tracing/admin/partials
 */
?>


<?php 
    if (isset($_POST['submit'])) {
        
        global $wpdb;
        $db = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}jne_tracing_api");
        $apiData = $db[0];

        $data = [
            'username' => $apiData->username,
            'api_key' => $apiData->api_key
        ];
        
        $payload = http_build_query($data);
        
        $ch = curl_init('http://apiv2.jne.co.id:10102/tracing/api/list/v1/cnote/'.$_POST['awb']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
            'User-Agent: '
            ]
        );

        
        $result = curl_exec($ch);
        $result = json_decode($result, 1);
        if (count($db) < 1) $result = [
            'error' => 'Please set your API key first. Open the <a href="'.site_url('/wp-admin/admin.php?page=jne-tracing-config').'">configuration</a> menu'
        ];
        
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        curl_close($ch);
    }
?>

<div class="wrap">
    <h1 class="page-title">JNE Tracing</h1>   
    <div class="package-info box">
        <div class="box-header">
            <div class="logo">
                <img src="<?php echo plugin_dir_url(__FILE__) . '../img/logo.png'; ?>" alt="jne logo" width="100px">
            </div>
            <div class="main-form">
                <form method="POST" action="<?php echo site_url('/wp-admin/admin.php?page=jne-tracing'); ?>">
                    <input type="text" placeholder="Enter the note number" name="awb" value="4808012000000159" class="form-control"/>
                    <button name="submit" value="submit" class="button button-primary">Search</button>
                </form>
            </div>
        </div>
        
        <div class="box-body">
        <?php
        if(!empty($result['cnote'])): 
            $cnote = $result['detail'][0];
        ?>
            <div class="package-header">
            <h3>Detail</h3>
                <div class="package-detail">
                    <div>
                        <h3><?php echo $cnote['cnote_no']; ?></h3>
                        <span><i class="bx bx-calendar"></i> <?php echo $cnote['cnote_date']; ?></span>
                        <span><i class="bx bx-box"></i> <?php echo $cnote['cnote_weight']; ?> Kg</span>
                    </div>
                    <div>
                        <strong>From</strong>
                        <span><?php echo $cnote['cnote_shipper_name']; ?></span>
                        <span><?php echo $cnote['cnote_shipper_addr1']; ?></span>
                        <span><?php echo $cnote['cnote_shipper_addr2']; ?></span>
                        <span><?php echo $cnote['cnote_shipper_addr3']; ?></span>
                        <span><?php echo $cnote['cnote_shipper_city']; ?></span>
                    </div>
                    <div>
                        <strong>To</strong>
                        <span><?php echo $cnote['cnote_receiver_name']; ?></span>
                        <span><?php echo $cnote['cnote_receiver_addr1']; ?></span>
                        <span><?php echo $cnote['cnote_receiver_addr2']; ?></span>
                        <span><?php echo $cnote['cnote_receiver_addr3']; ?></span>
                        <span><?php echo $cnote['cnote_receiver_city']; ?></span>
                    </div>
                </div>
            </div>
            <div class="package-body">
                <h3>History</h3>
                <div class="history-list">
                    <?php foreach(array_reverse($result['history']) as $history): ?>
                        <div class="history-item">
                            <span class="date"><?php echo $history['date']; ?></span>
                            <span><?php echo $history['desc']; ?>.</span>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>    
            <?php endif; ?>
            <?php if(!empty($result['error'])): ?>
                <div class="image-section">
                    <div class="image-wrap">
                        <img src="<?php echo plugin_dir_url(__FILE__) . '../img/error.jpg'; ?>" alt="">
                    </div>
                    <div class="msg">
                        <?php echo $result['error']; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
