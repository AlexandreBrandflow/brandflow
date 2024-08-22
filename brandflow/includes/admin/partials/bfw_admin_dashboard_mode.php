<?php

$bfwSiteMode = new bfwSiteMode();

$tasks = [];
$nextMode = $bfwSiteMode->getNextMode();
$nextModeText = $bfwSiteMode->getSiteModeText($nextMode);
$isNextModeOk = $bfwSiteMode->isModeOk($nextMode, $tasks);

?>

<div class="dashboard_indicator <?php echo $isNextModeOk ? 'dashboard_indicator_positive' : 'dashboard_indicator_negative'; ?>">
    <div class="dashboard_indicator_wrapper">
        <h3>Mode <?php echo $bfwSiteMode->getSiteModeText(); ?></h3>
        <?php if ($isNextModeOk) { ?>
            <p>
                Les planètes sont alignées ! <span class="emoji">🌍🪐</span>
                Le site peux passer en <?php echo $nextModeText; ?> !
                C'est fluide !
            </p>
        <?php } else { ?>
            <p>
                Les planètes ne sont pas alignées ! <span class="emoji">🌍🪐</span> <br>
                Il reste  <?php echo count($tasks); ?> tâches avant la <?php echo $nextModeText; ?> ! <br>
                Mais je suis pas inquiet, tu vas gérer ça ! &#128521;
            </p>
        <?php } ?>
        <div class="dashboard_indicator_actions">
                <?php if ($isNextModeOk) { ?>
                    <a href="<?= admin_url('admin-post.php?action=go_to_next_mode') ?>" class="dashboard_indicator_action" onclick="return confirm('Vous êtes sur le point de changer le mode du site. Confirmez-vous cette action ?')">
                            Passer en <?php echo $nextModeText; ?>
                    </a>
                <?php } else { ?>
                    <a href="<?php menu_page_url( 'bfw_admin_page_mode', true ); ?>" class="dashboard_indicator_action">
                        Voir les tâches
                    </a>
                <?php } ?>

        </div>
    </div>
</div>