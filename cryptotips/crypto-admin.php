<?php

function crypto_add_admin_menu() {
	add_plugins_page( "Crypto tips", "Crypto tips settings", "edit_plugins", "cryptocoinadmin", "crypto_show_admin_menu");
}


function crypto_show_admin_menu(){
?>

		

    <div class="wrap">
        <h2>Crypto tips settings
        </h2>
        <?php
        if($_GET['savesettings']){ ?>
        <div id="setting-error-settings_updated" class="updated settings-error"> 
        <p><strong>Settings saved.</strong></p></div>
        <?php
            delete_option( 'crypto_wallet' );
            add_option( 'crypto_wallet', $_POST['walleturl'] );
            delete_option( 'crypto_type' );
            add_option( 'crypto_type', $_POST['cryptotype'] );
            delete_option( 'crypto_user' );
            add_option( 'crypto_user', $_POST['cryptouser'] );
            delete_option( 'crypto_pass' );
            add_option( 'crypto_pass', $_POST['cryptopass'] );
         } 
         
         $walleturl = get_option("crypto_wallet" );
        $cointype = get_option("crypto_type" );
        $coinuser = get_option("crypto_user" );
        $coinpass = get_option("crypto_pass" );
        ?>
        
        <form method="post" action="?page=cryptocoinadmin&savesettings=true">
        
        <table class="wp-list-table widefat plugins" cellspacing="0">
            <thead>
            <tr>
                <th scope="col" id="name" class="manage-column column-name" style="">Option</th><th scope="col" id="description" class="manage-column column-description" style="">Value</th>	</tr>
            </thead>
        
            <tfoot>
            <tr>
                <th scope="col" class="manage-column column-name" style="" colspan="2"><input type="submit" value="save" class="button action" /></th>	</tr>
            </tfoot>
        
            <tbody id="the-list">
                <tr id="doge-tip-bot" class="inactive">
                    <td class="plugin-title"><strong>Wallet JSON_RPC url:</strong>
                    </td>
                    <td class="column-description desc">
                                <div class="plugin-description"><p>
                                    <input type="text" name="walleturl" value="<?php echo $walleturl;  ?>" />
                                </p></div>
                                <div class="inactive second plugin-version-author-uri">This is the url to your hosted wallet including the port like so: 123.456.78.910:1234, do not include http://. If you need a wallet host, Amazon Ec2 offers 1 year of free linux hosting that you can use to host your wallet.</div>
                    </td>
                </tr>
                <tr id="doge-tip-bot" class="active">
                    <td class="plugin-title"><strong>RPC username:</strong>
                    </td>
                    <td class="column-description desc">
                                <div class="plugin-description"><p>
                                    <input type="text" name="cryptouser" value="<?php echo $coinuser;  ?>" />
                                </p></div>
                                <div class="inactive second plugin-version-author-uri">This is the username you set in you wallets config file for RPC access.</div>
                    </td>
                </tr>
                <tr id="doge-tip-bot" class="inactive">
                    <td class="plugin-title"><strong>RPC password:</strong>
                    </td>
                    <td class="column-description desc">
                                <div class="plugin-description"><p>
                                    <input type="text" name="cryptopass" value="<?php echo $coinpass;  ?>" />
                                </p></div>
                                <div class="inactive second plugin-version-author-uri">TThis is the password you set in you wallets config file for RPC access.</div>
                    </td>
                </tr>
                <tr id="doge-tip-bot" class="active">
                    <td class="plugin-title"><strong>Coin:</strong>
                    </td>
                    <td class="column-description desc">
                                    <div class="plugin-description"><p><select name="cryptotype">
                                    <option value="">Select one</option>
                                    <option value="KARM" <?php if($cointype=="KARM") { echo "selected"; } ?>>Karma coin</option>
                                    <option value="DOGE" <?php if($cointype=="DOGE") { echo "selected"; } ?>>Doge coin</option>
                                    <option value="BTC" <?php if($cointype=="BTC") { echo "selected"; } ?>>Bitcoin</option>
                                    </select></p></div>
                                    <div class="active second plugin-version-author-uri">The name of the coin you are accepting tips for.</div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        </form>
        
        </div>
        <div class="clear"></div>
    </div>
<?php
}