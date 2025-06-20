<?php
include("Net/SSH2.php");

$connection = ssh2_connect('10.0.91.4', 22, array('hostkey'=>'ssh-rsa'));

if (ssh2_auth_pubkey_file($connection, 'root',
                          '/root/id_rsa.pub',
                          '/root/.ssh/id_rsa')) {
  echo "Public Key Authentication Successful\n";
} else {
  die('Public Key Authentication Failed');
}
?>
