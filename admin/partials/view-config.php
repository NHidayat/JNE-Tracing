<?php 

    global $wpdb;

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}jne_tracing_api");

    if ($_POST['submit'] == 'submit') {
        $formData = [
            'api_key' => $_POST['api_key'],
            'username' => $_POST['username'],
            'iat' => current_time('mysql')
        ];
        $wpdb->insert($wpdb->prefix . 'jne_tracing_api', $formData);
        $status = 1;
    }

    if ($_POST['submit'] == 'update') {
        $formData = [
            'api_key' => $_POST['api_key'],
            'username' => $_POST['username'],
        ];
        $wpdb->update($wpdb->prefix . 'jne_tracing_api', $formData, ['api_id' => $result[0]->api_id]);
        $status = 1;
    }

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}jne_tracing_api");
    $data = count($result) > 0 ? $result[0] : null;

?>


<div class="wrap">
    <h1 class="page-title">Configuration</h1>
    <div class="main-content">
        <div class="box box-center">
            <div class="box-header">
                <h3 class="box-title">Set API Key</h3>
            </div>
            <div class="box-body">
                <?php if ($status): ?>
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>
                <div class="alert alert-success" role="alert" style="margin-bottom: 1rem;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>Your data has been saved</div>
                </div>  
                <?php endif; ?>              
                <div class="jne-form">
                    <form action="<?= site_url('/wp-admin/admin.php?page=jne-tracing-config'); ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?= $data ? $data->username : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="api">API Key</label>
                            <input type="text" name="api_key" id="api"  value="<?= $data ? $data->api_key : ''; ?>" required>
                            <input type="hidden" name="success" value="success">
                        </div>
                        <div>
                            <button class="button button-primary" name="submit" value="<?= $data ? 'update' : 'submit'; ?>" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
