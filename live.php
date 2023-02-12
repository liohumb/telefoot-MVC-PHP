<?php include_once 'templates/header.php' ?>
<?php
include_once './controllers/Lives.php';

$liveController = new Lives();
$data = $liveController->getData();
?>

<?php if (isset($_SESSION['username'])) { ?>
<section class="live">
    <div class="live__container">
        <?php foreach ($data as $tableName => $tableData) { ?>
                <?php if ($tableName === 'clubs') { continue; } ?>
            <div class="live__content live__content-<?= $tableName ?>">
                <h1 class="live__content-title"><?= $tableName === 'channels' ? 'chaines' : $tableName ?></h1>
                <div class="live__content-cards">
                    <?php foreach ($tableData as $item) { ?>
                        <div class="live__content-card">
                            <img src="assets/images/<?= $tableName ?>/<?= $item['image'] ?>"
                                 alt="<?= $item['name'] ?>" class="live__content-card--image">
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php foreach ($data['clubs'] as $category => $clubs) { ?>
            <div class="live__content">
                <h1 class="live__content-title"><?= $category ?></h1>
                <div class="live__content-cards live__content-cards--<?= str_replace(' ', '-', $category) ?>">
                    <?php foreach ($clubs as $club) { ?>
                        <div class="live__content-card">
                            <img src="assets/images/clubs/<?= $club['image'] ?>"
                                 alt="<?= $club['name'] ?>" class="live__content-card--image">
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?php } else { header('location: connexion.php'); } ?>

<?php include 'templates/footer.php' ?>