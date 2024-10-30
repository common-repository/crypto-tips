<?php

function crypto_add_extra_profile_fields($user ) {
	$cryptobalance=get_user_meta($user->ID, 'coinbalance', true);
        $cointype = get_option("crypto_type" );
		if($cryptobalance==""){
			$cryptobalance=0;	
		}
	?>
    <h3>Crypto Tips</h3>
    <table class="form-table">
		<tbody>
        	<tr id="xkey-guid">
                <th>
                	<?php echo $cointype; ?> balance
                </th>
                <td>
                    <div class="social-accounts">
                        <?php echo $cryptobalance." ".$cointype; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    Withdraw:
                </th>
                <td>
                    <div class="social-accounts">
                       Address: <input type='text' name='coinaddy'> Amount <input type="number" name="coinamount" max="<?php echo $cryptobalance; ?>">
                    <p class="description" style="max-width: 450px;">Once your ready to withdraw click update profile to process the withdrawal.
                    </div>
                </td>
            </tr>
            </tr>
		</tbody>
	</table>
<?php
}

function crypto_save_custom_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ){
		return FALSE;
	}

	$walleturl = get_option("crypto_wallet" );
	$cointype = get_option("crypto_type" );
	$coinuser = get_option("crypto_user" );
	$coinpass = get_option("crypto_pass" );
	
	$amount=$_POST['coinamount'];

	$sendto=$_POST['coinaddy'];
	$withdrawn=get_user_meta($user_id, 'coinwithdraw',true);
	$balance=get_user_meta($user_id, 'coinbalance',true);
	$address=get_user_meta($user_id, 'address');
	if($amount<=$balance){
		if(strlen($sendto)<35 && strlen($sendto)>26){
		$newbalance=(float)$balance - (float) $amount;
		$totwithdrawn=(float)$withdrawn + (float) $amount;
		$karma = new jsonRPCClient('http://'.$coinuser.':'.$coinpass.'@'.$walleturl);
		$sendmany=$karma->sendtoaddress(''.$sendto.'',(float) $amount);

		update_usermeta( $user_id, 'coinbalance', $newbalance );
		update_usermeta( $user_id, 'coinwithdraw', $totwithdrawn );
		}else{
			?>
	        <div id="setting-error-settings_updated" class="updated settings-error"> 
        <p><strong>You don't have enough funds for this withdrawal</strong></p></div>
        <?php
		}
	}else{
    if($amount>0 ){
		 ?>
	        <div id="setting-error-settings_updated" class="updated settings-error"> 
        <p><strong>You don't have enough funds for this withdrawal</strong></p></div>
	<?php
	}
	}

}