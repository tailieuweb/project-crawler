<div class="one_full">
    <div id="total_crawl">
        <section class="title">
            <h4>Statistic</h4>
        </section>
        <section class="item">
            <div class="content">
                <div class="tabs">
                    <ul class="tab-menu">
                        <?php foreach ($tags as $key => $tag): ?>
                            <li>
                                <a href="#<?php echo $tag ?>" title="<?php printf(lang('settings:section_title'), $tag) ?>">
                                    <span><?php echo $tag ?></span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                    <?php foreach ($tags as $key => $tag): ?>
                        <div class="form_inputs" id="<?php echo $tag; ?>">
                            <fieldset>
                                <ul>
                                    <li>
                                        <?php if (!empty($all_sites)) : ?>
                                            <?php echo form_open('admin/contents/statistic') ?>
                                            <?php echo $this->load->view('admin/tables/statistic_'. strtolower($tag)) ?>
                                            <?php echo form_close() ?>
                                        <?php else : ?>
                                            <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </fieldset>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    </div>            
</div>