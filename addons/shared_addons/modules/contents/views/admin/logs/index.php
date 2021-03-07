<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>
<section class="title">
    <h4>Logs</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <?php foreach ($tags as $key => $tag): ?>
                    <li>
                        <a href="#<?php echo $tag['name'] ?>" title="<?php printf(lang('settings:section_title'), $tag['name']) ?>">
                            <span><?php echo 'Crawl ' . $tag['name'] ?></span>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
            <?php foreach ($tags as $key => $tag): ?>
                <div class="form_inputs" id="<?php echo $tag['name']; ?>">
                    <fieldset>
                        <ul>
                            <li>
                                <?php $this->load->view('admin/tables/' . $tag['name'] . '_logs') ?>
                            </li>
                        </ul>
                    </fieldset>
                </div>
            <?php endforeach ?>
        </div>
        <?php $this->load->view('admin/logs/portBox') ?>
    </div>
</section>
