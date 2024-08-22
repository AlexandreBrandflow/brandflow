<?php

/* Méthode de display du dashboard des bfw theme settings */
function bfw_admin_page_mode_display() {

    $bfwSiteMode = new bfwSiteMode();

    $tasks = [];
    $nextMode = $bfwSiteMode->getNextMode();
    $nextModeText = $bfwSiteMode->getSiteModeText($nextMode);
    $isNextModeOk = $bfwSiteMode->isModeOk($nextMode, $tasks);

	?>

	<div class="bfw_admin_page bfw_admin_page_detail">
		<div class="bfw_admin_page_header">
			<h2>bfw - Mode du site</h2>
		</div>
		<div class="bfw_admin_page_content">
			<div class="bfw_admin_page_content_wrapper">

                <div class="dashboard_indicator <?php echo $isNextModeOk ? 'dashboard_indicator_positive' : 'dashboard_indicator_negative'; ?>">
                    <div class="dashboard_indicator_wrapper">
                        <h3>
                            <?php echo $nextModeText; ?>
                        </h3>
                        <?php if (!$isNextModeOk) { ?>

                            <p>Les planètes ne sont pas alignées, il reste un peu de travail avant de pouvoir passer en pré-production... &#128549;</p>
                            <ul>
                                <?php foreach ($tasks as $task) { ?>
                                    <li>
                                        <a href="<?php echo $task->link; ?>" target="_blank">
                                            <?php echo $task->message; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>

                        <?php } else { ?>

                            <p>
                                Les planètes sont alignées ! <span class="emoji">🌍🪐</span> <br>
                                Le site peux passer en <?php echo $nextModeText; ?> ! <br>
                                C'est fluide ! &#128521;
                            </p>

                        <?php } ?>

                        <div class="dashboard_indicator_actions">
                            <?php if ($isNextModeOk) { ?>

                                <a href="<?= admin_url('admin-post.php?action=go_to_next_mode') ?>" class="dashboard_indicator_action" onclick="return confirm('Vous êtes sur le point de changer le mode du site. Confirmez-vous cette action ?')">
                                    <?php if ($bfwSiteMode->isModeDev()) { ?>
                                        Passer en pré-production
                                    <?php } elseif ($bfwSiteMode->isModePreprod()) { ?>
                                        Passer en production
                                    <?php } ?>
                                </a>

                            <?php } ?>
                        </div>

                    </div>
                </div>

			</div>
		</div>
	</div>

	<?php

}

function bfw_admin_go_to_next_mode() {

    $bfwSiteMode = new bfwSiteMode();

    $nextMode = $bfwSiteMode->getNextMode();
    $isNextModeOk = $bfwSiteMode->isModeOk($nextMode, $tasks);

    if ($isNextModeOk && $bfwSiteMode->isModeDev()) {
        $bfwSiteMode->setSiteModePreprod();
    }
    elseif ($isNextModeOk && $bfwSiteMode->isModePreprod()) {
        $bfwSiteMode->setSiteModeProd();
    }

    wp_redirect(admin_url('admin.php?page=bfw_admin_page'));
}
add_action('admin_post_go_to_next_mode', 'bfw_admin_go_to_next_mode');