<ul class="mega-menu">
    <?php $elements = $args['elements']; ?>
    <?php foreach ($elements as $el): ?>
        <li class="mega-menu__item <?= ($el['sous_menu']) ? 'mega-menu__item__toggle' : ''; ?>">
            <a href="<?= $el['lien']['url']; ?>" class="mega-menu__item__link lien">
                <?= $el['lien']['title']; ?>
                <?php if ($el['sous_menu']): ?>
                    <div class="icon type--outline">
                        <?php
                        $url = get_template_directory_uri() . '/assets/icons/chevron-down.svg';
                        $size = array('24', '24');
                        bfw_echo_svg($url, $size, ''); ?>
                    </div>
                <?php endif; ?>
            </a>

            <?php if ($el['sous_menu']): ?>
                <div class="mega-menu__dropdown">
                    <?php foreach ($el['elements'] as $menu):
                        ?>
                        <div class="mega-menu__dropdown__col">
                            <div class="fx-col mega-menu__dropdown__header">
                                <?php
                                if ($menu['titre']): ?>
                                    <div class="mega-menu__dropdown__col__title color-gray font-xxs fw-500"><?= $menu['titre']; ?></div>
                                <?php endif; ?>
                                <?php
                                if ($menu['tout_voir']): ?>
                                    <a class="lien size--S has-icon pos-right" href="<?= $menu['tout_voir']['url']; ?>">
                                        <div class="fx al-center">
                                            <span><?= $menu['tout_voir']['title']; ?></span>
                                            <div class="icon type--fill">
                                                <?php
                                                $url = get_template_directory_uri() . '/assets/icons/arrow-forward.svg';
                                                $size = array('24', '24');
                                                bfw_echo_svg($url, $size, ''); ?>
                                            </div>
                                        </div>

                                    </a>
                                <?php endif; ?>
                            </div>
                            <ul class="mega-menu__dropdown__items">
                                <?php foreach ($menu['liens'] as $lien):
                                    if ($lien['image']):
                                        $icone = array('image' => $lien['image'], 'position' => 'left', 'type' => 'fill');
                                        $size = 'M-alt';
                                    else:
                                        $icone = array();
                                        $size = 'S';
                                    endif; ?>

                                    <li
                                        class="mega-menu__dropdown__lien <?= ($lien['image']) ? 'mega-menu__dropdown__lien__large' : ''; ?>">
                                        <?php $lienArray = array('lien' => $lien['lien'], 'style' => 'gray-xlight', 'icone' => $icone, 'size' => $size, 'contenu' => $lien['contenu'], 'classe' => sanitize_title($lien['lien']['title'])); ?>
                                        <?php bfw_echo_button($lienArray); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </li>




    <?php endforeach; ?>
</ul>