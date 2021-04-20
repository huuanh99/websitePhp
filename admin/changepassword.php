<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/adminlogin.php';
$ad=new adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $changepassword = $ad->change_password($_POST);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">
        <?php
            if(isset($changepassword)){
                echo $changepassword;
            }
        ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..." name="oldpass" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>