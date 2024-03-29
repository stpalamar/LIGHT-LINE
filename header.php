<?php
    @session_start();
    $languageArray = array("en", "uk", "ru");
    if (isset($_COOKIE['currentLang'])) {
        $defaultLang = $_COOKIE['currentLang'];
    } else {
        $defaultLang = "uk";
    }

    if(@$_SESSION['currentLang']) {
        if(!in_array($_SESSION['currentLang'], $languageArray)) {
            $_SESSION['currentLang'] = $defaultLang;
        }
    }
    else {
        $_SESSION['currentLang'] = $defaultLang;
    }
    $language = addslashes($_GET['lang']);
    if($language) {
        if(!in_array($language, $languageArray)) {
            $_SESSION['currentLang'] = $defaultLang;
        }
        else {
            $_SESSION['currentLang'] = $language;
        }
    }
    $currentLang = addslashes($_SESSION['currentLang']);
    include_once ("lang/lang.".$currentLang.".php");
?>

<div id="header">
    <img src="images/logo.png" class="logo">
    <table class="nav-table">
        <tr>
            <td><a href="index.php"><?php echo $lang['Main']?></a></td>
            <td><a href="subscriptions.php"><?php echo $lang['Subs']?></a></td>
            <td><a href="gallery.php"><?php echo $lang['Gallery']?></a></td>
            <td><a href="news.php"><?php echo $lang['News']?></a></td>
            <td><a href="trainees.php"><?php echo $lang['Trainers']?></a></td>
            <td><a href="JavaScript: alert('err')"><?php echo $lang['Schedule']?></a></td>
        </tr>
        <tr>
            <td colspan="5">
                <ul class="social-links">
                    <li><a class="icon-twitter" href="https://twitter.com" title="..." target="_blank" rel="noopener"></a></li>
                    <li><a class="icon-facebook" href="https://facebook.com" title="..." target="_blank" rel="noopener"></a></li>
                    <li><a class="icon-instagram" href="https://instagram.com" title="..." target="_blank" rel="noopener"></a></li>
                    <li><a class="icon-pinterest" href="https://pinterest.com" title="" target="_blank" rel="noopener"></a></li>
                </ul>
            </td>
        </tr>
    </table>
    <?php
    if(!isset($_SESSION["user"])){
      $dashboard_display = 'hidden';

    } else {
      $auth_display = 'hidden';
    }
    ?>
    <div id="auth-form" style="visibility: <?=$auth_display?>">
        <form action="login.php" method="post">
            <h3><?php echo $lang['Auth']?></h3>
            <input type="text" name="login" placeholder="<?php echo $lang['Login']?>">
            <input type="password" name="pass" placeholder="<?php echo $lang['PWord']?>"><br>
            <input type="submit" value="<?php echo $lang['SignIn']?>">
        </form>
    <input id="sign-up" type="submit" value="<?php echo $lang['SignUp']?>" onclick="location.href='sign-up.php'">
    </div>
    <div id="dashboard" style="visibility: <?=$dashboard_display?>">
        <div>
            <h3><?=$lang['YourLogin']?>: <?=$_SESSION["user"]?></h3>
            <?php if($_SESSION["admin"] == true) {
              echo $lang['YouAdmin'];?><br>
              <?php
              echo "<a href='dashboard.php'>Dashboard</a><br>";
              echo "<a href='users.php'>Users</a><br>";
            }?>
            <button onclick="window.location.href='/logout.php'">Вийти</button>
        </div>
    </div>
</div>