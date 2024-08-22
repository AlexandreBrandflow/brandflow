<div class="menu-mobile modal">
    <div class="menu-mobile__inner">

        <div class="menu-mobile__content fx-col pb-3">

            <div class="menu-mobile__content__header menu-mobile__header">
                <div class="container-inner fx just-between">
                    <?php $logo = $args['logo']; ?>
                    <a class="menu-mobile__logo" href="<?= get_site_url(); ?>">
                        <?php bfw_echo_svg($logo, array('148', '48'), '', ''); ?>
                    </a>
                    <a class="close display-none-sm" data-mytoggle="menu">Fermer
                        <button class="hamburger hamburger--spring bfw-hamburger is-active" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </a>
                </div>
            </div>


            <?php $elements = $args['elements']['elements']; ?>

            <div class="menu-mobile__main fx-col gap-35 container-inner">

                <?php foreach ($elements as $el):
                    if ($el['hide_mobile'] == true)
                        continue; ?>


                    <?php if (!($el['sous_menu'])): ?>
                        <li class="menu-mobile__main__item">
                            <a href="<?= $el['lien']['url']; ?>" class="menu-mobile__main__item__link">
                                <?= $el['lien']['title']; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($el['sous_menu']): ?>

                        <?php foreach ($el['elements'] as $menu):
                            ?>
                            <li class="menu-mobile__main__item fx-col gap-2">
                                <div class="menu-mobile__main__item__header">
                                    <?php
                                    if ($menu['titre']): ?>
                                        <div class="menu-mobile__main__title color-gray fw-500">
                                            <?= $menu['titre']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <ul class="menu-mobile__main__col fx-col gap-1">
                                    <?php foreach ($menu['liens'] as $lien):

                                        ?>
                                        <li class="">
                                            <a href="<?= $lien['lien']['url']; ?>" class="menu-mobile__main__item__link lien --blue-marine">
                                                <?= $lien['lien']['title']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="menu-mobile__secondary fx-col gap-35 container-inner">
                <div class="menu-mobile__secondary__cta">
                    <?php $menu_mobile = $args['menu_mobile']; ?>
                    <?php //var_dump($menu_mobile) ; ?>
                    <?php foreach ($menu_mobile['cta_liens'] as $lien):
                        bfw_echo_button($lien);
                    endforeach;
                    ?>
                </div>
                <div class="menu-mobile__secondary__autres fx gap-25">
                    <?php $menu_mobile = $args['menu_mobile']; ?>
                    <?php //var_dump($menu_mobile) ; ?>
                    <?php foreach ($menu_mobile['autres_liens'] as $lien): ?>
                        <a href="<?= $lien['lien']['url']; ?>" class="lien --blue-marine">
                            <?= $lien['lien']['title']; ?>
                        </a>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>

        </div>
        <div class="menu-mobile__img">
            <div class="menu-mobile__header ">
                <div class="container-inner fx just-end">
                    <a class="close" data-mytoggle="menu">Fermer
                        <button class="hamburger hamburger--spring bfw-hamburger is-active" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </a>
                </div>

            </div>
            <?php if ($menu_mobile['background']): ?>
                <div class="img img--cover img--absolute">
                    <?php bfw_echo_image($menu_mobile['background'], array('1200', '2400')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>