<?php


add_action( 'publish_post', 'crypto_new_post',10,2 );
function crypto_new_post($post_id, $post)
{
// Checks whether is post updated or published at first time.
if ($post->post_date != $post->post_modified) return;

}

function crypto_show_post($content) {
        global $post;
		
		$post_id=$post->ID;
		$user_id=$post->post_author;

        $walleturl = get_option("crypto_wallet" );
        $cointype = get_option("crypto_type" );
        $coinuser = get_option("crypto_user" );
        $coinpass = get_option("crypto_pass" );
		$withdrawn=get_user_meta($user_id, 'coinwithdraw');
		$address=get_user_meta($user_id, 'address');
		$karma = new jsonRPCClient('http://'.$coinuser.':'.$coinpass.'@'.$walleturl);
		if($withdrawn==""){
			$withdrawn=0;
		}
		if($address[0]==""){
			$address[0]=$karma->getnewaddress();
			update_user_meta( $user_id, 'address', $address[0] );
		}
		
		$deposits=$karma->getreceivedbyaddress("".$address[0]."");
		$coinbalance=(float)$deposits - (float)$withdrawn[0];
        $coin = get_option("crypto_type" );
		update_user_meta( $user_id, 'coindeposits', $deposits );
		update_user_meta( $user_id, 'coinbalance', $coinbalance );
        return $content.'<hr>Tip this author by sending '.$coin.' to '.$address[0].'<br> ('.$deposits.' '.$coin.' tipped) ';
    }

function crypto_query_parser( $q ) {
	//$qv =$q->query_vars['page_id'];
}