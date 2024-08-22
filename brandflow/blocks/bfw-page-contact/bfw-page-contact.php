<?php
/**
 * bfw-page-contact Block Template.
 */

// Support custom "anchor" values.
$ancre = get_field('ancre') ? get_field('ancre') : '';

$bloc_size = array('1800', '');

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'block-bfw-page-contact';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values

$args = array();

$acf = bfw_get_fields($args);

?>


<div id="<?= sanitize_title($ancre); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="container-large pt-4 pb-5 py-sm-8 py-lg-11">

        <div class="container-inner fx-col gap-8 content">
            <div class="fx-col gap-35 w-sm-70">

                <h1 class="">
                    <?= $acf['titre']; ?>
                </h1>

                <?php if ($acf['contenu']): ?>
                    <div class="fw-500 font-md">
                        <?= $acf['contenu']; ?>
                    </div>

                <?php endif; ?>
            </div>



            <?php $elements = $acf['elements']; ?>

            <?php
            if (!empty($elements)): ?>

                <div class="contacts fx-col">
                    <?php
                    $c = 0;
                    foreach ($elements as $el): ?>
                        <div class="contacts__item">
                            <div class="contacts__item__grid bfw-grid al-center">
                                <h2 class="contacts__item__title col-md-5 font-large bfw-grid__item"><?= $el['titre']; ?></h2>
                                <div class="contacts__item__content col-md-4 bfw-grid__item"><?= $el['contenu']; ?></div>
                                <?php $liens = $el['liens']; ?>
                                <?php if (!empty($liens)): ?>
                                    <div class="fx gap-2 contacts__item__liens bfw-grid__item col-md-3 fx just-md-end">
                                        <?php foreach ($liens as $lien): ?>
                                            <?php bfw_echo_button($lien); ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        $c++;
                    endforeach; ?>
                    <div
                        class="contacts__item contacts__item--form fx-col gap-sm-5 mt-sm-35 bfw-form bfw-form--large w-md-50">
                        <h2 class="contacts__item__title font-large"><?= get_field('titre_section_formulaire'); ?></h2>
                        <script>
                            hbspt.forms.create({
                                region: "eu1",
                                portalId: "26716988",
                                formId: "e5d03b4d-5826-4e88-9230-f3476ad2026c"
                            });
                        </script>
                    </div>
                </div>


            <?php endif; ?>

        </div>



        <div class="img img--cover img--absolute h-100 w-100">
            <?php bfw_echo_image($acf['background'], array('2000', '2000')); ?>
        </div>

        <?php if ($acf['vecteurs']):
            $size = 'full';
            $url = $acf['vecteurs'][0]['image'];
            $class = 'w-100 just-end';
            ?>
            <div class="vecteurs">

                <?php bfw_echo_svg($url, $size, $class); ?>
            </div>
        <?php endif; ?>


    </div>
</div>