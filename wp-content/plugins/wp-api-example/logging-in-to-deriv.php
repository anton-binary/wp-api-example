<?php

function loggingIn_content() {
    $content = "";
    if(is_page('logging-in-to-deriv')) {
        $content = <<<content
        <p><strong>1. Log in to Deriv.</strong></p>
        <pre>https://oauth.deriv.com/oauth2/authorize?app_id=30782 <input type="button" onclick="login()" style="width: 50px; height: 25px" value="Log in"></pre> 
        <p><strong>2. Select an account to authorize.</strong></p>
        <div id="accounts" class="accounts">
            <table>
            <tr>
                <th>Account</th>
                <th>User info</th>
            </th>
            <tr>
                <td>
                    <form id="user_accounts">&nbsp;</form>
                </td>
                <td>
                    <div id="account_info">&nbsp;</div>
                </td>
            </tr>
            </table>
        </div>
        content;
    }
    return $content;
}

function loggingIn_js_head() {
    $plugins_dir = plugins_url();
    if(is_page('logging-in-to-deriv')) { 
    ?>
        <script src="https://unpkg.com/@deriv/deriv-api@1.0.9/dist/DerivAPIBasic.js"></script>
        <script src="/wp-api-example/wp-content/plugins/wp-api-example/js/logging-in-to-deriv.js"></script>
        <link rel="stylesheet" href="<?=$plugins_dir?>/wp-api-example/css/logging-in-to-deriv.css" type="text/css" media="all">
    <?php
    }
}

function loggingIn_js_footer() {
    if(is_page('logging-in-to-deriv')) { 
        ?>
            <script>
                parseQueryString();
            </script>
        <?php
    }
}