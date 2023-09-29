<?php
require_once ("session.php");
function generate_nav_links() {
$nav_links = [];
    if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
    $nav_links = [
    ['link' => 'home.php', 'text' => 'Home'],
    ['link' => 'day_details_edit.php', 'text' => 'Edit Day Details'],
    ['link' => 'contact_manage.php', 'text' => 'Contact Manage'],
    ['link' => 'logout.php', 'text' => 'Logout']
    ];
    } else {
    $nav_links = [
    ['link' => 'home.php', 'text' => 'Home'],
    ['link' => 'day_details.php', 'text' => 'Day details'],
    ['link' => 'contact.php', 'text' => 'Contact'],
    ['link' => 'logout.php', 'text' => 'Logout']
    ];
    }
    } else {
    $nav_links = [
    ['link' => 'home.php', 'text' => 'Home'],
    ['link' => 'login.php', 'text' => 'Login']
    ];
    }
    return $nav_links;
    }
?>
        <!-- Navigation -->
 <nav class="navbar navbar-expand-lg bg-body-tertiary">
 <div class="container-fluid">
    <a class="navbar-brand link-dark" href="home.php">
      <img src="images/daycare.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Cubs Daycare
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <?php foreach (generate_nav_links() as $link) { ?>
        <li class="nav-item">
          <a class="nav-link active link-success" aria-current="page" href="<?php echo $link['link']; ?>"><?php echo $link['text']; ?></a>
        </li>
        <?php } ?>
        </ul>
        </div>
            <ul >
</div>
</nav> 
  
  