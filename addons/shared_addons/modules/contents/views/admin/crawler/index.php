<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>
<section class="title">
    <h4><?php echo lang('contents:title_crawler') ?></h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <?php foreach ($tags as $key => $tag): ?>
                    <li>
                        <a href="#<?php echo $key ?>" title="<?php printf(lang('settings:section_title'), $key) ?>">
                            <span><?php echo $tag ?></span>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
            <?php foreach ($tags as $key => $tag): ?>
                <div class="form_inputs" id="<?php echo $key; ?>">
                    <fieldset>
                        <ul>
                            <?php $this->load->view('admin/crawler/tables/' . $key) ?>
                        </ul>
                    </fieldset>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
